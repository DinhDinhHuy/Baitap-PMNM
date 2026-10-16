<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\LopHocApiController;
use App\Http\Controllers\Api\SinhVienApiController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthApiController::class, 'login'])->middleware('throttle:10,1');

Route::name('api.')->middleware(['api.token', 'role:admin,lecturer'])->group(function () {
    Route::post('/logout', [AuthApiController::class, 'logout'])->name('logout');
    Route::apiResource('lophoc', LopHocApiController::class);
    Route::apiResource('sinhvien', SinhVienApiController::class);
});
