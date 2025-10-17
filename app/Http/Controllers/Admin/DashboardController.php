<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'blogs' => Blog::count(),
            'authors' => Author::count(),
            'posts' => Post::count(),
            'categories' => Category::count(),
        ];

        // Pega os 5 artigos mais recentes para a lista de "Atividade Recente"
        $recentBlogs = Blog::with('author')->latest()->take(5)->get();

        return view('dashboard', compact('stats', 'recentBlogs'));
    }
}
