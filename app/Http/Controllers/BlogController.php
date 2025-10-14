<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Blog::with(['author', 'categories'])->paginate(15));
    }

    public function store(BlogRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $blog = DB::transaction(function () use ($validated) {
            $blog = Blog::create($validated);
            $blog->contents()->createMany($validated['contents']);
            if (isset($validated['categories'])) {
                $blog->categories()->sync($validated['categories']);
            }
            return $blog;
        });

        return response()->json($blog->load(['author', 'categories', 'contents']), 201);
    }

    public function show(Blog $blog): JsonResponse
    {
        return response()->json($blog->load(['author', 'categories', 'contents']));
    }

    public function update(BlogRequest $request, Blog $blog): JsonResponse
    {
        $validated = $request->validated();
        $blog = DB::transaction(function () use ($validated, $blog) {
            $blog->update($validated);
            if (isset($validated['contents'])) {
                $blog->contents()->delete();
                $blog->contents()->createMany($validated['contents']);
            }
            if (isset($validated['categories'])) {
                $blog->categories()->sync($validated['categories']);
            }
            return $blog;
        });

        return response()->json($blog->load(['author', 'categories', 'contents']));
    }

    public function destroy(Blog $blog): JsonResponse
    {
        $blog->delete();
        return response()->json(null, 204);
    }
}
