<?php

use App\Http\Controllers\MahasiswaLoginController;
use App\Http\Middleware\AuthenticateMahasiswa;
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

Route::get('/beranda', function () {
    return view('mahasiswa.dashboard');
})->middleware(AuthenticateMahasiswa::class);

Route::get('/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware(AuthenticateMahasiswa::class);

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
})->middleware(AuthenticateMahasiswa::class)->name('mahasiswa.dashboard');

Route::get('/mahasiswa/ajukan', function () {
    return view('mahasiswa.ajukan');
});

Route::get('/mahasiswa/riwayat', function () {
    return view('mahasiswa.riwayat');
});

Route::get('/mahasiswa/panduan', function () {
    return view('mahasiswa.panduan');
});
