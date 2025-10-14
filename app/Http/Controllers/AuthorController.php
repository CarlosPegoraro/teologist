<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\JsonResponse;

class AuthorController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(Author::paginate(15));
    }

    public function store(AuthorRequest $request): JsonResponse
    {
        $author = Author::create($request->validated());
        return response()->json($author, 201);
    }

    public function show(Author $author): JsonResponse
    {
        return response()->json($author);
    }

    public function update(AuthorRequest $request, Author $author): JsonResponse
    {
        $author->update($request->validated());
        return response()->json($author);
    }

    public function destroy(Author $author): JsonResponse
    {
        $author->delete();
        return response()->json(null, 204);
    }
}
