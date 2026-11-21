<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('sinhvien-dashboard');
});

Route::get('/sinhvien/dashboard', function () {
    return view('sinhvien-dashboard');
});

Route::get('/sinhvien/dang-ky', function () {
    return view('sinhvien-dangky');
});

Route::get('/sinhvien/thoi-khoa-bieu', function () {
    return view('sinhvien-thoikhoabieu');
});

Route::get('/sinhvien/thong-bao', function () {
    return view('sinhvien-thongbao');
});

Route::get('/sinhvien/ho-so', function () {
    return view('sinhvien-hoso');
});

Route::get('/sinhvien/ket-qua', function () {
    return view('sinhvien-ketqua');
});
