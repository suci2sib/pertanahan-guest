<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JenisPenggunaanController;

// =============================
// PUBLIC ROUTES (TANPA LOGIN)
// =============================
Route::get('/', [DashboardController::class, 'index'])->name('home');

// AUTH ROUTES
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')->name('auth.index');
    Route::get('/register', 'create')->name('auth.create');
    Route::post('/login', 'store')->name('auth.store');
});

// =============================
// PROTECTED ROUTES (HARUS LOGIN)
// =============================
Route::middleware(['checkislogin'])->group(function () {
    
    // LOGOUT
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.destroy');

    // DASHBOARD - Bisa diakses semua role (Super Admin, Admin, User)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // PROFILE - Bisa diakses semua role
    Route::controller(ProfileController::class)->prefix('profile')->name('profile.')->group(function () {
        Route::get('/', 'show')->name('show');
        Route::get('/edit', 'edit')->name('edit');
        Route::put('/', 'update')->name('update');
        // PERBAIKAN PENTING: Nama route disesuaikan dengan View (updatePassword)
        Route::put('/password', 'updatePassword')->name('updatePassword'); 
    });
    
    // ==================== KHUSUS SUPER ADMIN ====================
    Route::middleware(['checkrole:Super Admin'])->group(function () {
        // Hanya Super Admin yang boleh kelola User (Tambah/Hapus Akun)
        Route::resource('user', UserController::class);
    });
    
    // ==================== ADMIN & SUPER ADMIN ====================
    // Logika Middleware kamu: Super Admin lolos di semua check. 
    // Jadi route di bawah ini bisa diakses Admin DAN Super Admin.
    Route::middleware(['checkrole:Admin'])->group(function () {
        
        Route::resource('warga', WargaController::class);
        Route::resource('jenispenggunaan', JenisPenggunaanController::class);
        
        // Persil & Media
        Route::resource('persil', PersilController::class);
        Route::delete('/persil/media/{id}', [PersilController::class, 'deleteMedia'])->name('persil.deleteMedia');
    });

    // ==================== REDIRECTS / FALLBACK ====================
    // Redirect /my-profile ke profile
    Route::get('/my-profile', function () {
        return redirect()->route('profile.show');
    });
});

// Global Fallback (404)
Route::fallback(function () {
    return redirect()->route('dashboard.index')->with('error', 'Halaman tidak ditemukan!');
});