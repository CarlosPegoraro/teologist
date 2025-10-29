<?php

use App\Http\Controllers\Core\AuthorController;
use App\Http\Controllers\Core\BlogController;
use App\Http\Controllers\Core\CategoryController;
use App\Http\Controllers\Core\CommentController;
use App\Http\Controllers\Core\PostController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;

// --- ROTAS PÚBLICAS ---
Route::get('/', function () {
    return view('home.index');
})->name('home');

// Rotas públicas para visualização de conteúdo
Route::resource('blogs', BlogController::class)->only(['index', 'show']);
Route::resource('authors', AuthorController::class)->only(['index', 'show']);
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('posts', PostController::class)->only(['index', 'show']);
Route::get('posts/{post}/comments', [CommentController::class, 'index'])->name('posts.comments.index');


// --- ROTAS PARA USUÁRIOS AUTENTICADOS ---
Route::middleware(['auth'])->group(function () {
    // Fórum: criar, comentar e gerenciar próprios posts/comentários
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::patch('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // A Policy cuidará da permissão

    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::patch('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // A Policy cuidará da permissão

    // Configurações do usuário
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

Route::middleware(['role:author', 'role:admin'])->group(function () {
    Route::resource('blogs', BlogController::class)->only(['create', 'store', 'edit', 'update']);
});

require __DIR__.'/auth.php';
