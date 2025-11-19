<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Jkn\JknSuratkontrolController;
use App\Http\Controllers\Master\PasienController;
use App\Http\Controllers\Master\DokterController;
use App\Http\Controllers\Master\PoliklinikController;
use App\Http\Controllers\Master\ReferensiController;
use App\Http\Controllers\Registrasi\RegistrasiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/auth', action: [ Auth::class,'index']);

Route::post('/login', action: [AuthController::class, 'login']);
Route::post('/auth/check-username', action: [AuthController::class, 'checkUsername']);
Route::post('/check', action: [AuthController::class, 'check']);
Route::get('/auth/login-data', action: [AuthController::class, 'loginData']);

Route::middleware(['api_token'])->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('/user', 'index');
    });

    Route::prefix('jkn')->group(function () {
        Route::controller(JknSuratkontrolController::class)->group(function () {
            Route::post('/surkon/getdata', 'getdata');
        });
    });

    Route::prefix('registrasi')->group(function () {
        Route::controller(RegistrasiController::class)->group(function () {
            Route::post('/post', 'post');
        });
    });

    Route::controller(ReferensiController::class)->group(function () {
        Route::get('/ref/penjab', 'penjab');
        Route::post('/ref/kelurahan', 'kelurahan');
        Route::post('/ref/kecamatan', 'kecamatan');
        Route::post('/ref/kabupaten', 'kabupaten');
        Route::get('/ref/perusahaan-pasien', 'perusahaanpasien');
        Route::get('/ref/suku-bangsa', 'sukubangsa');
        Route::get('/ref/bahasa-pasien', 'bahasapasien');
        Route::get('/ref/cacat-fisik', 'cacatfisik');
        Route::get('/ref/propinsi', 'propinsi');
    });

    Route::get('/master/poliklinik', action: [PoliklinikController::class, 'index']);
    Route::post('/master/poliklinik', action: [PoliklinikController::class, 'store']);
    Route::get('/master/dokter', action: [DokterController::class, 'index']);
    Route::post('/master/dokter', action: [DokterController::class, 'store']);
});
