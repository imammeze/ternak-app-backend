<?php

use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PengeluaranSusuController;
use App\Http\Controllers\Api\PerawatanTernakController;
use App\Http\Controllers\Api\PerpindahanTernakController;
use App\Http\Controllers\Api\ProduksiSusuController;
use App\Http\Controllers\Api\TernakController;
use App\Http\Controllers\Api\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);
    
    Route::middleware('permission:akses menu user management')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
    });

    Route::middleware('permission:akses menu input data')->group(function () {
        Route::get('/ternak', [TernakController::class, 'index']);
        Route::post('/ternak', [TernakController::class, 'store']);
        Route::get('/ternak/{id}', [TernakController::class, 'show']);

        Route::get('/produksi-susu', [ProduksiSusuController::class, 'index']);
        Route::post('/produksi-susu', [ProduksiSusuController::class, 'store']);

        Route::post('/perawatan-ternak', [PerawatanTernakController::class, 'store']);

        Route::get('/pengeluaran-susu', [PengeluaranSusuController::class, 'index']);
        Route::post('/pengeluaran-susu', [PengeluaranSusuController::class, 'store']);

        Route::post('/perpindahan-ternak', [PerpindahanTernakController::class, 'store']);
        
        Route::get('/list-stakeholders', function () {
            $stakeholders = User::role('stakeholder')->select('id', 'name')->get();
            return response()->json($stakeholders, 200);
        });
    });

    Route::get('/activity', [ActivityController::class, 'index']);
});