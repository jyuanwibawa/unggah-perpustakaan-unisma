<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class StaffVerificationTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_can_review_submission_and_download_its_private_document_without_session(): void
    {
        Storage::fake('local');

        $user = User::create([
            'role' => 'mahasiswa',
            'password' => Hash::make('secret'),
        ]);
        $mahasiswa = Mahasiswa::create([
            'no' => 1,
            'nim' => '22001101027',
            'nama' => 'Mahasiswa Antrean',
            'jk' => 'P',
            'tanggal_lahir' => '2002-05-05',
            'prodi' => 'S1 Kedokteran',
            'angkatan' => 2022,
            'status' => 'AKTIF',
            'user_id' => $user->id,
        ]);
        $submissionId = DB::table('pengajuan_bebas_pustaka')->insertGetId([
            'nomor_pengajuan' => 'BP-2026-VERIFY',
            'nim' => $mahasiswa->nim,
            'user_id' => $user->id,
            'judul_karya' => 'Penelitian untuk Verifikasi',
            'jenis_karya' => 'skripsi',
            'tahun_lulus' => 2026,
            'abstrak' => 'Abstrak verifikasi.',
            'kata_kunci' => 'verifikasi, staff',
            'dosen_pembimbing_id' => null,
            'dosen_pembimbing_2_id' => null,
            'akses_naskah' => 'open',
            'status' => 'menunggu_review',
            'tanggal_diajukan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $documentPath = "pengajuan-bebas-pustaka/{$submissionId}/naskah.pdf";
        Storage::disk('local')->put($documentPath, '%PDF-1.4 naskah verifikasi');
        $documentId = DB::table('pengajuan_bebas_pustaka_dokumen')->insertGetId([
            'pengajuan_id' => $submissionId,
            'jenis_dokumen' => 'naskah',
            'nama_asli' => 'naskah.pdf',
            'path' => $documentPath,
            'mime_type' => 'application/pdf',
            'ukuran_bytes' => 27,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->get(route('staff.verifikasi.index'))
            ->assertOk()
            ->assertSee('Mahasiswa Antrean')
            ->assertSee('Penelitian untuk Verifikasi')
            ->assertSee('Naskah lengkap');

        $this->assertGuest('mahasiswa');

        $this->get(route('staff.verifikasi.document', ['documentId' => $documentId]))
            ->assertOk();

        $this->post(route('staff.verifikasi.update', ['submissionId' => $submissionId]), [
            'status' => 'menunggu_koreksi',
            'catatan' => 'Mohon lengkapi lembar pengesahan.',
        ])
            ->assertRedirect(route('staff.verifikasi.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('pengajuan_bebas_pustaka', [
            'id' => $submissionId,
            'status' => 'menunggu_koreksi',
            'status_keterangan' => 'Mohon lengkapi lembar pengesahan.',
        ]);

        $this->post(route('staff.verifikasi.update', ['submissionId' => $submissionId]), [
            'status' => 'disetujui',
            'catatan' => 'Berkas lengkap.',
        ])->assertRedirect(route('staff.verifikasi.index'));

        $this->assertDatabaseHas('pengajuan_bebas_pustaka', [
            'id' => $submissionId,
            'status' => 'disetujui',
            'tanggal_disetujui' => now(),
        ]);
    }
}
