<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Post::with('user')->paginate(15));
    }

    public function store(PostRequest $request): JsonResponse
    {
        $post = $request->user()->posts()->create($request->validated());
        return response()->json($post, 201);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json($post->load('user', 'comments.user'));
    }

    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());
        return response()->json($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        // Adicionar uma Policy para garantir que apenas o autor possa deletar
        // if ($request->user()->cannot('delete', $post)) {
        //     abort(403);
        // }
        $post->delete();
        return response()->json(null, 204);
    }
}
