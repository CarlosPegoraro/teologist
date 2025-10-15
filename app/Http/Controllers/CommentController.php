<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;

class CommentController extends Controller
{
    public function store(CommentRequest $request, Post $post): RedirectResponse
    {
        $post->comments()->create($request->validated());

        return redirect()->route('posts.show', $post)
            ->with('success', 'Comment added successfully.');
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
