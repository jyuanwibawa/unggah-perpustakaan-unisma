<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/staff-login', function () {
    return view('auth.staff-login');
});

Route::get('/staff/login', function () {
    return view('auth.staff-login');
});

Route::get('/beranda', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/dashboard', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/mahasiswa/dashboard', function () {
    return view('mahasiswa.dashboard');
});

Route::get('/mahasiswa/ajukan', function () {
    return view('mahasiswa.ajukan');
});

Route::get('/mahasiswa/riwayat', function () {
    return view('mahasiswa.riwayat');
});

Route::get('/mahasiswa/panduan', function () {
    return view('mahasiswa.panduan');
});


