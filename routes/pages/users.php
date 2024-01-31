<?php

use App\Livewire\Pages\Users\UsersIndex;
use App\Livewire\Pages\Users\ProfileShow;
use App\Livewire\Pages\Users\PasswordEdit;
use App\Livewire\Pages\Users\BookmarkIndex;
use Illuminate\Support\Facades\Route;

Route::prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('/', UsersIndex::class)
            ->name('index');
        Route::get('/{user}/profile', ProfileShow::class)
            ->name('profile.show');
        Route::get('/{user}/password/edit', PasswordEdit::class)
            ->name('password.edit');
        Route::get('/{user}/bookmark', BookmarkIndex::class)
            ->name('bookmark.index');
    });
