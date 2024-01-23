<?php

use App\Http\Controllers\AnswerCommentsController;
use App\Http\Controllers\AnswerDownvotesController;
use App\Http\Controllers\AnswerUpvotesController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\QuestionAnswersController;
use App\Http\Controllers\QuestionDownvotesController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\QuestionsTaggedController;
use App\Http\Controllers\QuestionUpvotesController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

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


Route::prefix('tags')
    ->as('tags.')
    ->group(function () {
        Route::get('/', [TagsController::class, 'index'])
            ->name('index');
    });

Route::prefix('questions')
    ->as('questions.')
    ->group(function () {
        Route::get('/', [QuestionsController::class, 'index'])
            ->name('index');
        Route::post('/', [QuestionsController::class, 'store'])
            ->name('store');
        Route::get('/create', [QuestionsController::class, 'create'])
            ->name('create');

        Route::get('/tagged/{tag}', [QuestionsTaggedController::class, 'index'])
            ->name('tagged.index');

        Route::post('/{question}/answers', [QuestionAnswersController::class, 'store'])
            ->name('answers.store');
        Route::post('/{question}/answers/comments', [AnswerCommentsController::class, 'store'])
            ->name('answers.comments.store');
        Route::post('/{question}/answers/{answer}/upvote', [AnswerUpvotesController::class, 'store'])
            ->name('answers.upvote.store');
        Route::post('/{question}/answers/{answer}/downvote', [AnswerDownvotesController::class, 'store'])
            ->name('answers.downvote.store');

        Route::get('/{question}/{?slug}', [QuestionsController::class, 'show'])
            ->name('show');
        Route::post('/{question}/{slug}/upvote', [QuestionUpvotesController::class, 'show'])
            ->name('upvote');
        Route::post('/{question}/{slug}/downvote', [QuestionDownvotesController::class, 'show'])
            ->name('downvote');
    });
