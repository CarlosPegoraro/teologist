<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Core\AuthorController;
use App\Http\Controllers\Core\BlogController;
use App\Http\Controllers\Core\CategoryController;
use App\Http\Controllers\Core\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Aqui ficam todas as rotas para o painel administrativo.
| Elas são automaticamente agrupadas com o prefixo '/admin'
| e o middleware de autenticação e cargo.
|
*/

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Gerenciamento de Artigos (Blogs)
Route::resource('blogs', BlogController::class)->except(['show']);

// Gerenciamento de Posts do Fórum (apenas ações de supervisão)
Route::delete('posts/{post}', [PostController::class, 'destroy'])
    ->name('posts.destroy')
    ->middleware('role:admin|supervisor');

// Rotas que apenas Admins podem acessar
Route::middleware('role:admin')->group(function () {
    Route::resource('authors', AuthorController::class)->except(['show']);
    Route::resource('categories', CategoryController::class)->except(['show']);

    Route::get('users', [\App\Http\Controllers\Admin\UserManagementController::class, 'index'])->name('users.index');
    Route::put('users/{user}', [\App\Http\Controllers\Admin\UserManagementController::class, 'update'])->name('users.update');
});
