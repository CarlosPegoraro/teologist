<?php

use App\Http\Controllers\Core\AuthorController;
use App\Http\Controllers\Core\BlogController;
use App\Http\Controllers\Core\CategoryController;
use App\Http\Controllers\Core\CommentController;
use App\Http\Controllers\Core\NewsletterController;
use App\Http\Controllers\Core\PostController;
use App\Http\Controllers\Core\ScholeController;
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
Route::resource('newsletter', NewsletterController::class)->only(['index', 'show']);
Route::get('posts/{post}/comments', [CommentController::class, 'index'])->name('posts.comments.index');
Route::get('schole', [ScholeController::class, 'index'])->name('schole.index');
Route::get('schole/materiais/{material}/download', [ScholeController::class, 'downloadMaterial'])->name('schole.materials.download');


Route::middleware(['auth'])->group(function () {
    Route::get('posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::get('posts/{post}', [PostController::class, 'show'])
        ->whereNumber('post')->name('posts.show');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::put('posts/{post}', [PostController::class, 'update'])->name('posts.update');
    Route::patch('posts/{post}', [PostController::class, 'update']);
    Route::delete('posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy'); // A Policy cuidará da permissão

    Route::post('posts/{post}/like', [PostController::class, 'like'])->name('posts.like');

    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::patch('comments/{comment}', [CommentController::class, 'update']);
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy'); // A Policy cuidará da permissão

    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    Route::get('schole/criar-materia', [ScholeController::class, 'createSubject'])->name('schole.subjects.create');
    Route::post('schole', [ScholeController::class, 'storeSubject'])->name('schole.subjects.store');
    Route::get('schole/{subject}/materiais/criar', [ScholeController::class, 'createMaterial'])->name('schole.materials.create');
    Route::post('schole/{subject}/materiais', [ScholeController::class, 'storeMaterial'])->name('schole.materials.store');
});

Route::get('schole/{subject}', [ScholeController::class, 'show'])->name('schole.show');

Route::middleware(['role:admin|author'])->group(function () {
    Route::resource('blogs', BlogController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);
});

require __DIR__.'/auth.php';
