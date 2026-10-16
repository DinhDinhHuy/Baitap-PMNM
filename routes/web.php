<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LopHocController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\SinhVienController;
use App\Http\Middleware\CheckGioHanhChinh;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.post');
});
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'role:admin,lecturer'])->group(function () {
    Route::resource('lophoc', LopHocController::class)->middleware(CheckGioHanhChinh::class);
    Route::get('/sinhvien/add', [SinhVienController::class, 'create'])->name('sinhvien.add');
    Route::resource('sinhvien', SinhVienController::class)->except('create');

    Route::get('/account', [AccountController::class, 'editOwn'])->name('account.edit');
    Route::put('/account', [AccountController::class, 'updateOwn'])->name('account.update');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('menu', MenuController::class)->except('show');
    Route::resource('users', AccountController::class)->except(['show', 'edit', 'update']);
    Route::get('/users/{user}/edit', [AccountController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AccountController::class, 'update'])->name('users.update');
});
