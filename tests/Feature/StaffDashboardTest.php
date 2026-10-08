<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StaffDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_staff_dashboard_shows_live_submission_metrics_and_recent_rows(): void
    {
        $user = User::create([
            'role' => 'mahasiswa',
            'password' => Hash::make('secret'),
        ]);
        $mahasiswa = Mahasiswa::create([
            'no' => 1,
            'nim' => '22001101026',
            'nama' => 'Mahasiswa Dashboard Test',
            'jk' => 'P',
            'tanggal_lahir' => '2002-05-05',
            'prodi' => 'S1 Kedokteran',
            'angkatan' => 2022,
            'status' => 'AKTIF',
            'user_id' => $user->id,
        ]);

        foreach ([
            ['BP-2026-STAFF-1', 'Pengajuan Menunggu', 'menunggu_review', now()->subDay()],
            ['BP-2026-STAFF-2', 'Pengajuan Selesai', 'selesai', now()],
        ] as [$number, $title, $status, $submittedAt]) {
            DB::table('pengajuan_bebas_pustaka')->insert([
                'nomor_pengajuan' => $number,
                'nim' => $mahasiswa->nim,
                'user_id' => $user->id,
                'judul_karya' => $title,
                'jenis_karya' => 'skripsi',
                'tahun_lulus' => 2026,
                'abstrak' => 'Abstrak test dashboard.',
                'kata_kunci' => 'test, dashboard',
                'dosen_pembimbing_id' => null,
                'dosen_pembimbing_2_id' => null,
                'akses_naskah' => 'open',
                'status' => $status,
                'tanggal_diajukan' => $submittedAt,
                'created_at' => $submittedAt,
                'updated_at' => $submittedAt,
            ]);
        }

        $response = $this->get(route('staff.dashboard'));

        $response->assertOk()
            ->assertViewHas('totalCount', 2)
            ->assertViewHas('waitingCount', 1)
            ->assertViewHas('approvedCount', 1)
            ->assertViewHas('revisionCount', 0)
            ->assertSee('Mahasiswa Dashboard Test')
            ->assertSee('Pengajuan Menunggu')
            ->assertSee('Pengajuan Selesai')
            ->assertSee('22001101026');

        $this->assertGuest('mahasiswa');
    }
}
