<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PersilController;
use App\Http\Controllers\UserController;



Route::resource('users', UserController::class);

Route::resource('persil', PersilController::class);
