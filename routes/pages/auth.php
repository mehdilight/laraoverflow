<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->as('auth.')
    ->group(function () {
        Route::get('/login', [LoginController::class, 'create'])
            ->name('login.create');
        Route::post('/login', [LoginController::class, 'store'])
            ->name('login.store');;

        Route::get('/register', [RegisterController::class, 'create'])
            ->name('register.create');;
        Route::post('/register', [RegisterController::class, 'store'])
            ->name('register.store');
    });
