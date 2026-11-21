<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GiangVien\DashboardController as GiangVienDashboardController;
use App\Http\Controllers\GiangVien\LopHocPhanController as GiangVienLopHocPhanController;
use App\Http\Controllers\GiangVien\ThoiKhoaBieuController as GiangVienThoiKhoaBieuController;
use App\Http\Controllers\GiangVien\DiemController as GiangVienDiemController;
use App\Http\Controllers\GiangVien\ThongBaoController as GiangVienThongBaoController;
use App\Http\Controllers\GiangVien\HoSoController as GiangVienHoSoController;

Route::get('/', function () {
    return redirect('/giang-vien/dashboard');
});

// --- LUỒNG GIẢNG VIÊN ---
Route::prefix('giang-vien')->name('giangvien.')->group(function () {
    Route::get('/dashboard', [GiangVienDashboardController::class, 'index'])->name('dashboard');
    Route::get('/lop-hoc-phan', [GiangVienLopHocPhanController::class, 'index'])->name('lophocphan');
    Route::get('/thoi-khoa-bieu', [GiangVienThoiKhoaBieuController::class, 'index'])->name('thoikhoabieu');
    Route::get('/nhap-diem', [GiangVienDiemController::class, 'index'])->name('nhapdiem');
    Route::post('/nhap-diem', [GiangVienDiemController::class, 'store'])->name('nhapdiem.store');
    Route::get('/thong-bao', [GiangVienThongBaoController::class, 'index'])->name('thongbao');
    Route::post('/thong-bao/doc/{id}', [GiangVienThongBaoController::class, 'markRead'])->name('thongbao.read');
    Route::post('/thong-bao/doc-tat-ca', [GiangVienThongBaoController::class, 'markAllRead'])->name('thongbao.readall');
    Route::get('/ho-so', [GiangVienHoSoController::class, 'index'])->name('hoso');
    Route::post('/ho-so/cap-nhat-lien-he', [GiangVienHoSoController::class, 'updateContact'])->name('hoso.update');
});

// Sinh viên demo route
Route::get('/sinhvien/dashboard', function () {
    return view('sinhvien-dashboard');
});
