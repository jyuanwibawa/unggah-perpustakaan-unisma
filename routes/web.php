<?php

use App\Http\Controllers\MahasiswaLoginController;
use App\Http\Controllers\MahasiswaPengajuanController;
use App\Http\Middleware\AuthenticateMahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', [MahasiswaLoginController::class, 'show']);
Route::get('/login', [MahasiswaLoginController::class, 'show']);
Route::post('/login', [MahasiswaLoginController::class, 'login'])->name('mahasiswa.login');
Route::post('/logout', [MahasiswaLoginController::class, 'logout'])->middleware(AuthenticateMahasiswa::class)->name('mahasiswa.logout');

Route::get('/staff-login', function () {
    return view('auth.staff-login');
});

Route::get('/staff/login', function () {
    return view('auth.staff-login');
});

Route::get('/beranda', [MahasiswaPengajuanController::class, 'dashboard'])
    ->middleware(AuthenticateMahasiswa::class);

Route::get('/dashboard', [MahasiswaPengajuanController::class, 'dashboard'])
    ->middleware(AuthenticateMahasiswa::class);

Route::get('/mahasiswa/dashboard', [MahasiswaPengajuanController::class, 'dashboard'])
    ->middleware(AuthenticateMahasiswa::class)
    ->name('mahasiswa.dashboard');

Route::get('/mahasiswa/ajukan', [MahasiswaPengajuanController::class, 'create'])
    ->middleware(AuthenticateMahasiswa::class)
    ->name('mahasiswa.ajukan');
Route::post('/mahasiswa/ajukan', [MahasiswaPengajuanController::class, 'store'])
    ->middleware(AuthenticateMahasiswa::class)
    ->name('mahasiswa.ajukan.store');

Route::get('/mahasiswa/dosen/suggestions', function (Request $request) {
    $query = trim($request->query('q', ''));

    if (mb_strlen($query) < 2) {
        return response()->json([]);
    }

    return DB::table('dosen')
        ->select('id_dosen', 'nama_dosen', 'inisial')
        ->where(function ($builder) use ($query) {
            $builder->where('nama_dosen', 'like', "%{$query}%")
                ->orWhere('inisial', 'like', "%{$query}%");
        })
        ->orderBy('nama_dosen')
        ->limit(10)
        ->get();
})->middleware(AuthenticateMahasiswa::class)->name('mahasiswa.dosen.suggestions');

Route::get('/mahasiswa/riwayat', [MahasiswaPengajuanController::class, 'history'])
    ->middleware(AuthenticateMahasiswa::class)
    ->name('mahasiswa.riwayat');
Route::get('/mahasiswa/riwayat/dokumen/{documentId}', [MahasiswaPengajuanController::class, 'downloadDocument'])
    ->middleware(AuthenticateMahasiswa::class)
    ->name('mahasiswa.riwayat.document');

Route::get('/mahasiswa/panduan', function () {
    $alurPengajuan = DB::table('alur_pengajuan')
        ->where('is_active', true)
        ->orderBy('urutan')
        ->get();
    $pertanyaanUmum = DB::table('pertanyaan_umum')
        ->where('is_active', true)
        ->orderBy('urutan')
        ->get();

    return view('mahasiswa.panduan', compact('alurPengajuan', 'pertanyaanUmum'));
});
