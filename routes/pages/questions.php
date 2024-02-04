<?php

use App\Http\Controllers\Bookmark\BookmarkQuestionsController;
use App\Http\Controllers\Questions\Answers\AcceptAnswersController;
use App\Http\Controllers\Questions\Answers\AnswerDownvotesController;
use App\Http\Controllers\Questions\Answers\AnswerUpvotesController;
use App\Http\Controllers\Questions\Answers\Bookmarks\BookmarkAnswersController;
use App\Http\Controllers\Questions\Answers\Comments\AnswerCommentsController;
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

        // to be moved to the bottom
        Route::post('/{question}/comments', [QuestionCommentsController::class, 'store'])
            ->middleware('auth')
            ->name('comments.store');

        Route::post('/{question}/answers', [QuestionAnswersController::class, 'store'])
            ->middleware('auth')
            ->name('answers.store');

        // comments
        Route::post('/{question}/answers/{answer}/comments', [AnswerCommentsController::class, 'store'])
            ->middleware('auth')
            ->name('answers.comments.store');

        // answers book mark bookmark
        Route::post('/{question}/answers/{answer}/bookmark', [BookmarkAnswersController::class, 'store'])
            ->middleware('auth')
            ->name('answers.bookmark.store');

        Route::delete('/{question}/answers/{answer}/bookmark', [BookmarkAnswersController::class, 'destroy'])
            ->middleware('auth')
            ->name('answers.bookmark.destroy');

        // voting
        Route::post('/{question}/answers/{answer}/upvote', [AnswerUpvotesController::class, 'store'])
            ->middleware('auth')
            ->name('answers.upvote.store');
        Route::post('/{question}/answers/{answer}/downvote', [AnswerDownvotesController::class, 'store'])
            ->middleware('auth')
            ->name('answers.downvote.store');

        // accepted answer
        Route::post('/{question}/answers/{answerId}/accept', [AcceptAnswersController::class, 'store'])
            ->middleware('auth')
            ->name('answers.accept.store');

        // question actions
        Route::get('/{question}/{slug}', [QuestionsController::class, 'show'])
            ->name('show');
        Route::post('/{question}/{slug}/upvote', [QuestionUpvotesController::class, 'store'])
            ->middleware('auth')
            ->name('upvote.store');
        Route::post('/{question}/{slug}/downvote', [QuestionDownvotesController::class, 'store'])
            ->middleware('auth')
            ->name('downvote.store');

        Route::post('/{question}/{slug}/bookmark', [BookmarkQuestionsController::class, 'store'])
            ->middleware('auth')
            ->name('bookmark.store');

        Route::delete('/{question}/{slug}/bookmark', [BookmarkQuestionsController::class, 'destroy'])
            ->middleware('auth')
            ->name('bookmark.destroy');
    });
