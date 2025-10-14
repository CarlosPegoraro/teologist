<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class CommentController extends Controller
{
    public function index(Post $post): JsonResponse
    {
        return response()->json($post->comments()->with('user')->paginate(15));
    }

    public function store(CommentRequest $request, Post $post): JsonResponse
    {
        $comment = $post->comments()->create(
            ['user_id' => $request->user()->id] + $request->validated()
        );
        return response()->json($comment->load('user'), 201);
    }

    public function update(CommentRequest $request, Comment $comment): JsonResponse
    {
        $comment->update($request->validated());
        return response()->json($comment);
    }

    public function destroy(Comment $comment): JsonResponse
    {
        $comment->delete();
        return response()->json(null, 204);
    }
}
