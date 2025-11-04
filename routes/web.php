<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::resource('auth', AuthController::class);

Route::resource('users', UserController::class);

Route::resource('persil', PersilController::class);

Route::resource('dashboard', DashboardController::class);

Route::get('/tentang', [GuestController::class, 'about'])->name('guest.about');

Route::get('/layanan', [GuestController::class, 'services'])->name('guest.services');

Route::get('/kontak', [GuestController::class, 'contact'])->name('guest.contact');

Route::post('/kontak', [GuestController::class, 'sendContact'])->name('guest.contact.send');
