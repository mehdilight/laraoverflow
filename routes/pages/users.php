<?php

use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/', function () {
            return view('pages.users.index');
        })->name('index');
    });
