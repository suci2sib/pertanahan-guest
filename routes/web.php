<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WargaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPenggunaanController;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::resource('auth', AuthController::class);

Route::resource('user', UserController::class);

Route::resource('warga', WargaController::class);

Route::resource('dashboard', DashboardController::class);

Route::resource('jenispenggunaan', JenisPenggunaanController::class);
