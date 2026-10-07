<?php

namespace Tests\Feature;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MahasiswaLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_mahasiswa_can_login_with_default_password_and_access_dashboard(): void
    {
        $user = User::create([
            'role' => 'mahasiswa',
            'password' => Hash::make('unismajayadanberjaya'),
        ]);

        $mahasiswa = Mahasiswa::create([
            'no' => 12,
            'nim' => '22001101022',
            'nama' => 'Rizka Imelda Ryannisa',
            'jk' => 'P',
            'tanggal_lahir' => '2002-05-05',
            'prodi' => 'S1 Kedokteran',
            'angkatan' => 20251,
            'status' => 'AKTIF',
            'user_id' => $user->id,
        ]);

        $response = $this->post(route('mahasiswa.login'), [
            'nim' => $mahasiswa->nim,
            'password' => 'unismajayadanberjaya',
        ]);

        $response->assertRedirect(route('mahasiswa.dashboard'));
        $this->assertAuthenticated('mahasiswa', $user);
        $this->assertSame($user->id, auth('mahasiswa')->user()->id);

        $dashboard = $this->get(route('mahasiswa.dashboard'));
        $dashboard->assertOk();
        $dashboard->assertSee($mahasiswa->nama);
        $dashboard->assertSee($mahasiswa->nim);
    }

    public function test_mahasiswa_cannot_login_with_wrong_password(): void
    {
        $user = User::create([
            'role' => 'mahasiswa',
            'password' => Hash::make('unismajayadanberjaya'),
        ]);

        Mahasiswa::create([
            'no' => 12,
            'nim' => '22001101022',
            'nama' => 'Rizka Imelda Ryannisa',
            'jk' => 'P',
            'tanggal_lahir' => '2002-05-05',
            'prodi' => 'S1 Kedokteran',
            'angkatan' => 20251,
            'status' => 'AKTIF',
            'user_id' => $user->id,
        ]);

        $response = $this->post(route('mahasiswa.login'), [
            'nim' => '22001101022',
            'password' => 'salah',
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('password');
        $this->assertGuest('mahasiswa');
    }
}
