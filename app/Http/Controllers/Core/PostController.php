<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PostController extends Controller
{
    public function index(): View
    {
        $posts = Post::with('user')
            ->withCount('comments')
            ->latest()
            ->paginate(15);

        return view('posts.index', compact('posts'));
    }

    public function create(): View
    {
        return view('posts.create');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $post = Auth::user()->posts()->create($request->validated());

        return redirect()->route('posts.show', $post)
            ->with('success', 'Sua discussão foi iniciada com sucesso!');
    }

    public function like(Post $post): RedirectResponse
    {
        // Incrementa o contador de likes
        $post->increment('likes');

        // Redireciona de volta para a página do post
        return redirect()->route('posts.show', $post);
    }

    public function show(Post $post): View
    {
        $post->load(['user', 'comments' => function ($query) {
            $query->with('user')->latest();
        }]);

        return view('posts.show', compact('post'));
    }

    public function edit(Post $post): View
    {
        return view('posts.edit', compact('post'));
    }

    public function update(PostRequest $request, Post $post): RedirectResponse
    {
        $post->update($request->validated());
        return redirect()->route('posts.show', $post)
            ->with('success', 'Post updated successfully.');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('posts.index')
            ->with('success', 'Post deleted successfully.');
    }
}
