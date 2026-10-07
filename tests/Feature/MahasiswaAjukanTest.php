<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Database\Seeders\PertanyaanUmumSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class MahasiswaAjukanTest extends TestCase
{
    use RefreshDatabase;

    public function test_dosen_suggestions_return_matching_records_from_dosen_table(): void
    {
        $user = User::create([
            'role' => 'mahasiswa',
            'password' => Hash::make('secret'),
        ]);
        $this->actingAs($user, 'mahasiswa');

        DB::table('dosen')->insert([
            'no' => 1,
            'inisial' => 'TST',
            'nama_dosen' => 'Dr. Uji Sugesti',
            'npp' => 'TEST-001',
            'nidn' => null,
            'unit_kerja' => 'Pengujian',
            'status_kepegawaian' => 'Dosen Tetap',
        ]);

        $this->getJson(route('mahasiswa.dosen.suggestions', ['q' => 'uji']))
            ->assertOk()
            ->assertJsonPath('0.id_dosen', 1)
            ->assertJsonPath('0.nama_dosen', 'Dr. Uji Sugesti')
            ->assertJsonPath('0.inisial', 'TST');

        $this->getJson(route('mahasiswa.dosen.suggestions', ['q' => 'u']))
            ->assertOk()
            ->assertExactJson([]);
    }

    public function test_pengajuan_table_has_a_second_dosen_advisor_column(): void
    {
        $this->assertTrue(Schema::hasColumn('pengajuan_bebas_pustaka', 'dosen_pembimbing_2_id'));
    }

    public function test_mahasiswa_can_submit_pengajuan_with_three_private_documents(): void
    {
        Storage::fake('local');

        DB::table('dosen')->insert([
            [
                'no' => 1,
                'inisial' => 'D01',
                'nama_dosen' => 'Dosen Satu',
                'npp' => 'DOSEN-001',
                'nidn' => null,
                'unit_kerja' => 'Pengujian',
                'status_kepegawaian' => 'Dosen Tetap',
            ],
            [
                'no' => 2,
                'inisial' => 'D02',
                'nama_dosen' => 'Dosen Dua',
                'npp' => 'DOSEN-002',
                'nidn' => null,
                'unit_kerja' => 'Pengujian',
                'status_kepegawaian' => 'Dosen Tetap',
            ],
        ]);

        $user = User::create([
            'role' => 'mahasiswa',
            'password' => Hash::make('secret'),
        ]);
        $mahasiswa = Mahasiswa::create([
            'no' => 1,
            'nim' => '22001101022',
            'nama' => 'Mahasiswa Uji',
            'jk' => 'P',
            'tanggal_lahir' => '2002-05-05',
            'prodi' => 'S1 Kedokteran',
            'angkatan' => 2022,
            'status' => 'AKTIF',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user, 'mahasiswa')->post(route('mahasiswa.ajukan.store'), [
            'judul_karya' => 'Penelitian Contoh',
            'jenis_karya' => 'skripsi',
            'tahun_lulus' => 2026,
            'abstrak' => 'Abstrak penelitian contoh.',
            'kata_kunci' => 'penelitian, contoh',
            'dosen_pembimbing_id' => 1,
            'dosen_pembimbing_2_id' => 2,
            'akses_naskah' => 'open',
            'file_naskah' => UploadedFile::fake()->createWithContent('naskah.pdf', "%PDF-1.4\nNaskah\n%%EOF"),
            'file_pengesahan' => UploadedFile::fake()->createWithContent('pengesahan.pdf', "%PDF-1.4\nPengesahan\n%%EOF"),
            'file_orisinalitas' => UploadedFile::fake()->createWithContent('orisinalitas.pdf', "%PDF-1.4\nOrisinalitas\n%%EOF"),
        ]);

        $response->assertRedirect(route('mahasiswa.ajukan'));
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('pengajuan_bebas_pustaka', [
            'nim' => $mahasiswa->nim,
            'user_id' => $user->id,
            'judul_karya' => 'Penelitian Contoh',
            'dosen_pembimbing_id' => 1,
            'dosen_pembimbing_2_id' => 2,
        ]);
        $this->assertDatabaseCount('pengajuan_bebas_pustaka_dokumen', 3);

        foreach (DB::table('pengajuan_bebas_pustaka_dokumen')->get() as $document) {
            Storage::disk('local')->assertExists($document->path);
        }
    }

    public function test_guest_cannot_submit_pengajuan(): void
    {
        $this->post(route('mahasiswa.ajukan.store'))
            ->assertRedirect(route('mahasiswa.login'));
    }

    public function test_history_shows_only_owned_submissions_and_protects_document_downloads(): void
    {
        Storage::fake('local');

        $createStudent = function (string $nim, string $name): array {
            $user = User::create([
                'role' => 'mahasiswa',
                'password' => Hash::make('secret'),
            ]);
            $mahasiswa = Mahasiswa::create([
                'no' => 1,
                'nim' => $nim,
                'nama' => $name,
                'jk' => 'P',
                'tanggal_lahir' => '2002-05-05',
                'prodi' => 'S1 Kedokteran',
                'angkatan' => 2022,
                'status' => 'AKTIF',
                'user_id' => $user->id,
            ]);

            return compact('user', 'mahasiswa');
        };

        $insertSubmission = function (array $account, string $number, string $title): int {
            return DB::table('pengajuan_bebas_pustaka')->insertGetId([
                'nomor_pengajuan' => $number,
                'nim' => $account['mahasiswa']->nim,
                'user_id' => $account['user']->id,
                'judul_karya' => $title,
                'jenis_karya' => 'skripsi',
                'tahun_lulus' => 2026,
                'abstrak' => 'Abstrak contoh.',
                'kata_kunci' => 'contoh, riwayat',
                'dosen_pembimbing_id' => null,
                'dosen_pembimbing_2_id' => null,
                'akses_naskah' => 'open',
                'status' => 'menunggu_review',
                'tanggal_diajukan' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        };

        $owner = $createStudent('22001101022', 'Mahasiswa Pemilik');
        $other = $createStudent('22001101023', 'Mahasiswa Lain');
        $ownedSubmissionId = $insertSubmission($owner, 'BP-2026-OWNED', 'Judul Milik Saya');
        $insertSubmission($other, 'BP-2026-OTHER', 'Judul Milik Orang Lain');
        $path = "pengajuan-bebas-pustaka/{$ownedSubmissionId}/naskah.pdf";
        Storage::disk('local')->put($path, '%PDF-1.4 sample');

        $documentId = DB::table('pengajuan_bebas_pustaka_dokumen')->insertGetId([
            'pengajuan_id' => $ownedSubmissionId,
            'jenis_dokumen' => 'naskah',
            'nama_asli' => 'naskah.pdf',
            'path' => $path,
            'mime_type' => 'application/pdf',
            'ukuran_bytes' => 15,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->actingAs($owner['user'], 'mahasiswa')
            ->get(route('mahasiswa.riwayat'))
            ->assertOk()
            ->assertSee('Judul Milik Saya')
            ->assertDontSee('Judul Milik Orang Lain')
            ->assertSee(route('mahasiswa.riwayat.document', ['documentId' => $documentId]), false);

        $this->actingAs($owner['user'], 'mahasiswa')
            ->get(route('mahasiswa.riwayat.document', ['documentId' => $documentId]))
            ->assertOk();

        $this->actingAs($other['user'], 'mahasiswa')
            ->get(route('mahasiswa.riwayat.document', ['documentId' => $documentId]))
            ->assertNotFound();
    }

    public function test_dashboard_shows_real_submission_counts_for_the_logged_in_student(): void
    {
        $createStudent = function (string $nim, string $name): array {
            $user = User::create([
                'role' => 'mahasiswa',
                'password' => Hash::make('secret'),
            ]);
            $mahasiswa = Mahasiswa::create([
                'no' => 1,
                'nim' => $nim,
                'nama' => $name,
                'jk' => 'P',
                'tanggal_lahir' => '2002-05-05',
                'prodi' => 'S1 Kedokteran',
                'angkatan' => 2022,
                'status' => 'AKTIF',
                'user_id' => $user->id,
            ]);

            return compact('user', 'mahasiswa');
        };

        $insertSubmission = function (array $account, string $number, string $title, string $status, $date): void {
            DB::table('pengajuan_bebas_pustaka')->insert([
                'nomor_pengajuan' => $number,
                'nim' => $account['mahasiswa']->nim,
                'user_id' => $account['user']->id,
                'judul_karya' => $title,
                'jenis_karya' => 'skripsi',
                'tahun_lulus' => 2026,
                'abstrak' => 'Abstrak contoh.',
                'kata_kunci' => 'contoh, dashboard',
                'dosen_pembimbing_id' => null,
                'dosen_pembimbing_2_id' => null,
                'akses_naskah' => 'open',
                'status' => $status,
                'tanggal_diajukan' => $date,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        };

        $owner = $createStudent('22001101024', 'Mahasiswa Beranda');
        $other = $createStudent('22001101025', 'Mahasiswa Lain');
        $insertSubmission($owner, 'BP-2026-PROCESSING', 'Pengajuan Diproses', 'menunggu_review', now()->subDay());
        $insertSubmission($owner, 'BP-2026-APPROVED', 'Pengajuan Disetujui', 'disetujui', now());
        $insertSubmission($other, 'BP-2026-PRIVATE', 'Pengajuan Mahasiswa Lain', 'menunggu_review', now());

        $this->actingAs($owner['user'], 'mahasiswa')
            ->get(route('mahasiswa.dashboard'))
            ->assertOk()
            ->assertViewHas('submissionCount', 2)
            ->assertViewHas('processingCount', 1)
            ->assertViewHas('approvedCount', 1)
            ->assertViewHas('completedCount', 0)
            ->assertSee('Pengajuan Disetujui')
            ->assertDontSee('Pengajuan Mahasiswa Lain');
    }

    public function test_workflow_master_is_seeded_with_guidance_stages(): void
    {
        $this->assertDatabaseCount('alur_pengajuan', 6);
        $this->assertDatabaseHas('alur_pengajuan', [
            'kode_status' => 'menunggu_review',
            'nama_tahap' => 'Diperiksa petugas',
            'urutan' => 1,
            'is_active' => true,
        ]);
        $this->assertDatabaseHas('alur_pengajuan', [
            'kode_status' => 'selesai',
            'nama_tahap' => 'Surat siap',
            'urutan' => 4,
            'is_final' => true,
        ]);
    }

    public function test_guide_displays_active_faq_records_from_the_database(): void
    {
        $this->seed(PertanyaanUmumSeeder::class);
        $this->seed(PertanyaanUmumSeeder::class);
        DB::table('pertanyaan_umum')
            ->where('slug', 'pengajuan-perlu-revisi')
            ->update(['is_active' => false]);

        $this->get('/mahasiswa/panduan')
            ->assertOk()
            ->assertSee('Berkas apa saja yang harus diunggah?')
            ->assertDontSee('Pengajuan saya perlu revisi. Apa yang harus dilakukan?')
            ->assertSee('Open Access membuat naskah dapat dibaca publik.');

        $this->assertDatabaseCount('pertanyaan_umum', 5);
    }
}
