<?php

use App\Http\Controllers\Api\AbsensiController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\AktivitasController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\KandangController;
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
    
    Route::get('/produksi-susu', [ProduksiSusuController::class, 'index']);
    Route::get('/pengeluaran-susu', [PengeluaranSusuController::class, 'index']);
    Route::get('/activity', [ActivityController::class, 'index']);
    
    Route::prefix('ternak')->controller(TernakController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{id}', 'show');
    });
    
    Route::prefix('kandang')->controller(KandangController::class)->group(function () {
        Route::get('/', 'index');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
    
    Route::prefix('absen')->controller(AbsensiController::class)->group(function () {
        Route::post('/masuk', 'presensiMasuk');
        Route::post('/keluar', 'presensiKeluar');
        Route::post('/mulai-lembur', 'mulaiLembur');
        Route::post('/selesai-lembur', 'selesaiLembur');
        Route::get('/histori', 'histori');
    });
    
    Route::prefix('aktivitas')->controller(AktivitasController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::put('/{id}', 'update');
        Route::delete('/{id}', 'destroy');
    });
    
    Route::get('/list-stakeholders', function () {
        $stakeholders = User::role('stakeholder')->select('id', 'name')->get();
        return response()->json($stakeholders, 200);
    });

    Route::middleware('permission:akses menu input data')->group(function () {
        Route::post('/ternak', [TernakController::class, 'store']);
        Route::post('/produksi-susu', [ProduksiSusuController::class, 'store']);
        Route::post('/perawatan-ternak', [PerawatanTernakController::class, 'store']);
        Route::post('/pengeluaran-susu', [PengeluaranSusuController::class, 'store']);
        Route::post('/perpindahan-ternak', [PerpindahanTernakController::class, 'store']);
        Route::post('/kandang', [KandangController::class, 'store']);
    });

    Route::middleware('permission:akses menu user management')->group(function () {
        Route::get('/users', [UserController::class, 'index']);
        Route::post('/users', [UserController::class, 'store']);
        Route::put('/users/{id}', [UserController::class, 'update']);
    });

});