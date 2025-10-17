<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post): RedirectResponse
    {
        $validated = $request->validate();

        $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Seu comentário foi publicado!');
    }

    public function update(CommentRequest $request, Comment $comment): RedirectResponse
    {
        $comment->update($request->validated());

        return redirect()->route('posts.show', $comment->post)
            ->with('success', 'Comment updated successfully.');
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        $post = $comment->post;
        $comment->delete();

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment deleted successfully.');
    }
}
