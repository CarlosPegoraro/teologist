<?php

use App\Http\Controllers\BlogController;
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

    Route::resource('authors', \App\Http\Controllers\AuthorController::class);
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);
    Route::resource('blogs', \App\Http\Controllers\BlogController::class);
    Route::resource('posts', \App\Http\Controllers\PostController::class);

    Route::post('posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'store'])->name('posts.comments.store');
    Route::put('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update'])->name('comments.update');
    Route::patch('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'update']);
    Route::delete('comments/{comment}', [\App\Http\Controllers\CommentController::class, 'destroy'])->name('comments.destroy');

});

Route::post('logout', App\Livewire\Actions\Logout::class)
    ->name('logout');
