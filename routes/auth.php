<?php

use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::middleware('guest')->group(function () {
    Volt::route('login', 'auth.login')
        ->name('login');

    Volt::route('register', 'auth.register')
        ->name('register');

    Volt::route('forgot-password', 'auth.forgot-password')
        ->name('password.request');

    Volt::route('reset-password/{token}', 'auth.reset-password')
        ->name('password.reset');

});

Route::middleware('auth')->group(function () {
    Volt::route('verify-email', 'auth.verify-email')
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::resource('/blog', 'App\Http\Controllers\BlogController')->names('blog');
    Route::resource('/forum', 'App\Http\Controllers\ForumController')->names('forum');
    Route::resource('/new', 'App\Http\Controllers\ForumController')->names('new');

    Route::apiResource('authors', \App\Http\Controllers\AuthorController::class)->except(['index', 'show']);
    Route::apiResource('categories', \App\Http\Controllers\CategoryController::class)->except(['index', 'show']);
    Route::apiResource('blogs', \App\Http\Controllers\BlogController::class)->except(['index', 'show']);
    Route::apiResource('posts', \App\Http\Controllers\PostController::class)->except(['index', 'show']);

    Route::post('posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'store']);
    Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update']);
    Route::patch('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update']);
    Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy']);

});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
