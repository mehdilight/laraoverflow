<?php

use App\Livewire\Pages\Users\Index as UsersIndexComponent;
use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/', UsersIndexComponent::class)
            ->name('index');
    });
