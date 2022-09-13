<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Standard logged user group
Route::middleware(['auth'])->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/poll-list', [App\Http\Controllers\HomeController::class, 'pollList']); // List of polls
    Route::get('/poll/{poll:URLslug}', [App\Http\Controllers\HomeController::class, 'viewPoll']); // View poll
    Route::post('/poll/{poll:URLslug}/store-answers', [App\Http\Controllers\HomeController::class, 'storeAnswers']); // View poll
});

// Admin group
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminHomeController::class, 'adminHome']); // Admin dashboard
    Route::get('/admin/last', [App\Http\Controllers\AdminHomeController::class, 'adminLastFilled']); // Last filled polls
    Route::get('/admin/last/{poll:URLslug}/{entry_id}', [App\Http\Controllers\AdminHomeController::class, 'viewPollEntry']); // View poll entry
    Route::get('/admin/last/{poll:URLslug}/{entry_id}/delete', [App\Http\Controllers\AdminHomeController::class, 'deletePollEntry']); // Delete poll entry

    // Polls
    Route::post('/store-new-poll', [App\Http\Controllers\PollController::class, 'storeNewPoll']); // Storing a poll in database (Ajax)
    Route::get('/poll/{poll:URLslug}/delete', [App\Http\Controllers\PollController::class, 'deletePoll']); // Deleting a poll from database (Ajax)
    Route::get('/poll/{poll:URLslug}/edit', [App\Http\Controllers\PollController::class, 'editPoll']); // Editing a poll view
    Route::post('/poll/{poll:URLslug}/edit/change-order', [App\Http\Controllers\PollController::class, 'changeOrder']); // Change order function (Ajax)
    Route::patch('/poll/{poll:URLslug}/update', [App\Http\Controllers\PollController::class, 'updatePoll']); // Editing a poll (Ajax)
    Route::patch('/poll/{poll:URLslug}/visibility', [App\Http\Controllers\PollController::class, 'visibilityPoll']); // Change visibility of a poll (Ajax)
    Route::get('/poll/{poll:URLslug}/summary', [App\Http\Controllers\PollController::class, 'summaryPoll']); // View with poll summary

    // Questions
    Route::post('/poll/{poll:URLslug}/questions', [App\Http\Controllers\QuestionController::class, 'storeQuestion']); // Storing a question in database (Ajax)
    Route::get('/poll/{poll:URLslug}/question/{question}/delete', [App\Http\Controllers\QuestionController::class, 'deleteQuestion']); // Deleting a question from database (Ajax)
    Route::get('/poll/{poll:URLslug}/question/{question}/edit', [App\Http\Controllers\QuestionController::class, 'editQuestion']); // Editing a question view
    Route::patch('/poll/{poll:URLslug}/question/{question}/update', [App\Http\Controllers\QuestionController::class, 'updateQuestion']); // Editing a question
});