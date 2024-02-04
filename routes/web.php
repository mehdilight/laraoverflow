<?php


use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('questions.index');
});

require __DIR__ . '/pages/auth.php';
require __DIR__ . '/pages/questions.php';
require __DIR__ . '/pages/tags.php';
require __DIR__ . '/pages/users.php';
