<?php

use App\Http\Controllers\AnswerCommentsController;
use App\Http\Controllers\Questions\Answers\AnswerDownvotesController;
use App\Http\Controllers\Questions\Answers\AnswerUpvotesController;
use App\Http\Controllers\Questions\Answers\QuestionAnswersController;
use App\Http\Controllers\Questions\Comments\QuestionCommentsController;
use App\Http\Controllers\Questions\QuestionDownvotesController;
use App\Http\Controllers\Questions\QuestionsController;
use App\Http\Controllers\Questions\QuestionsTaggedController;
use App\Http\Controllers\Questions\QuestionUpvotesController;
use Illuminate\Support\Facades\Route;


Route::prefix('questions')
    ->as('questions.')
    ->group(function () {
        Route::get('/', [QuestionsController::class, 'index'])
            ->name('index');
        Route::post('/', [QuestionsController::class, 'store'])
            ->middleware('auth')
            ->name('store');
        Route::get('/ask', [QuestionsController::class, 'create'])
            ->middleware('auth')
            ->name('create');

        Route::get('/tagged/{tag}', [QuestionsTaggedController::class, 'index'])
            ->name('tagged.index');

        Route::post('/{question}/comments', [QuestionCommentsController::class, 'store'])
            ->middleware('auth')
            ->name('comments.store');

        Route::post('/{question}/answers', [QuestionAnswersController::class, 'store'])
            ->middleware('auth')
            ->name('answers.store');

        Route::post('/{question}/answers/{answer}/comments', [AnswerCommentsController::class, 'store'])
            ->middleware('auth')
            ->name('answers.comments.store');
        Route::post('/{question}/answers/{answer}/upvote', [AnswerUpvotesController::class, 'store'])
            ->middleware('auth')
            ->name('answers.upvote.store');
        Route::post('/{question}/answers/{answer}/downvote', [AnswerDownvotesController::class, 'store'])
            ->middleware('auth')
            ->name('answers.downvote.store');

        Route::get('/{question}/{slug}', [QuestionsController::class, 'show'])
            ->name('show');
        Route::post('/{question}/{slug}/upvote', [QuestionUpvotesController::class, 'store'])
            ->middleware('auth')
            ->name('upvote');
        Route::post('/{question}/{slug}/downvote', [QuestionDownvotesController::class, 'store'])
            ->middleware('auth')
            ->name('downvote');
    });
