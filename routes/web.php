<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('sinhvien-dashboard');
});

Route::get('/sinhvien/dashboard', function () {
    return view('sinhvien-dashboard');
});
