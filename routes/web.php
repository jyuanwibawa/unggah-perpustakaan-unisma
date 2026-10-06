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

