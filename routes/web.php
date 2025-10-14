<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::apiResource('authors', \App\Http\Controllers\AuthorController::class)->only(['index', 'show']);
Route::apiResource('categories', \App\Http\Controllers\CategoryController::class)->only(['index', 'show']);
Route::apiResource('blogs', \App\Http\Controllers\BlogController::class)->only(['index', 'show']);
Route::apiResource('posts', \App\Http\Controllers\PostController::class)->only(['index', 'show']);
Route::get('posts/{post}/comments', [\App\Http\Controllers\CommentController::class, 'index']);

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('profile.edit');
    Volt::route('settings/password', 'settings.password')->name('password.edit');
    Volt::route('settings/appearance', 'settings.appearance')->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            ),
        )
        ->name('two-factor.show');
});

require __DIR__.'/auth.php';
