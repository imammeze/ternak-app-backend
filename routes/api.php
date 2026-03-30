<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProduksiSusuController;
use App\Http\Controllers\Api\TernakController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\PerawatanTernakController;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::middleware('permission:akses menu user management')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
    });

    Route::middleware('permission:akses menu input data')->group(function () {
        Route::get('/ternak', [TernakController::class, 'index']);
        Route::post('/ternak', [TernakController::class, 'store']);
        Route::get('/ternak/{id}', [TernakController::class, 'show']);

        Route::get('/produksi-susu', [ProduksiSusuController::class, 'index']);
        Route::post('/produksi-susu', [ProduksiSusuController::class, 'store']);

        Route::post('/perawatan-ternak', [PerawatanTernakController::class, 'store']);
    });
});