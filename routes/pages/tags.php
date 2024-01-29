<?php

use App\Http\Controllers\Tags\TagsController;
use Illuminate\Support\Facades\Route;

Route::prefix('tags')
    ->as('tags.')
    ->group(function () {
        Route::get('/', [TagsController::class, 'index'])
            ->name('index');
    });
