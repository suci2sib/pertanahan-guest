<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;

// =============================
// HALAMAN UTAMA
// =============================
Route::get('/', [DashboardController::class, 'index'])->name('home');

// =============================
// AUTH (LOGIN / LOGOUT)
// =============================

// Gunakan resource tapi batasi hanya fungsi yang dipakai
Route::resource('auth', AuthController::class)->only(['index', 'store','create']);

// Logout selalu POST
Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.destroy');

// =============================
// DASHBOARD
// =============================
Route::resource('dashboard', DashboardController::class)->only(['index']);

Route::middleware(['checkislogin', 'checkrole:Pengunjung'])->group(function () {
    Route::resource('persil', PersilController::class)->only([
        'index', 'show', 'create', 'store'
    ]);
    Route::resource('warga', WargaController::class)->only([
        'index', 'show', 'create', 'store'
    ]);
    Route::resource('user', UserController::class)->only([
        'index', 'show', 'create', 'store'
    ]);
    Route::resource('jenispenggunaan', JenisPenggunaanController::class)->only([
        'index', 'show', 'create', 'store'
    ]);
});
// =============================
// ROUTE YANG BUTUH LOGIN
// =============================
// Hanya yang sudah login
Route::middleware(['checkislogin'])->group(function () {
    // ADMIN SAJA (USER, WARGA, JENIS PENGGUNAAN)
    // Middleware 'checkrole:Admin' telah dihapus di sini.

    Route::resource('user', UserController::class);
    Route::resource('warga', WargaController::class);
    Route::delete('/persil/media/{id}', [PersilController::class, 'deleteMedia'])->name('persil.deleteMedia');
    Route::resource('persil', PersilController::class); // Pastikan tanda kurung tutup ada di sini
    Route::resource('jenispenggunaan', JenisPenggunaanController::class);
});


