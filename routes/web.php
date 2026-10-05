<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect('/lophoc');
});


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('lophoc', LopHocController::class);

Route::middleware('auth')->group(function () {
    Route::get('/sinhvien', [SinhVienController::class, 'index'])->name('sinhvien.index');
    Route::get('/sinhvien/add', [SinhVienController::class, 'add'])->name('sinhvien.add');
    Route::post('/sinhvien/store', [SinhVienController::class, 'store'])->name('sinhvien.store');
});
