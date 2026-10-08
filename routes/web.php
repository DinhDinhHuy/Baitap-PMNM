<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Middleware\CheckGioHanhChinh;

Route::get('/', function () {
    return redirect('/lophoc');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('menu', MenuController::class)->except('show');
Route::resource('lophoc', LopHocController::class)->middleware(CheckGioHanhChinh::class);

Route::middleware('auth')->group(function () {
    Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
    Route::get('/sinhvien/add', [SinhVienController::class, 'add'])->name('sinhvien.add');
    Route::get('/sinhvien/show/{id}', [SinhVienController::class, 'show'])->name('sinhvien.show');
    Route::post('/sinhvien/store', [SinhVienController::class, 'store'])->name('sinhvien.store');
    Route::resource('menu', MenuController::class)->except('show');
});
