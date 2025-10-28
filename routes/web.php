<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\PersilController;

Route::get('/', function () {
    return view('guest.home');
});

Route::resource('auth', AuthController::class);

Route::resource('users', UserController::class);

Route::resource('persil', PersilController::class);

Route::get('/tentang', [GuestController::class, 'about'])->name('guest.about');

Route::get('/layanan', [GuestController::class, 'services'])->name('guest.services');

Route::get('/kontak', [GuestController::class, 'contact'])->name('guest.contact');

Route::post('/kontak', [GuestController::class, 'sendContact'])->name('guest.contact.send');

