<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthorController extends Controller
{
    public function index(): View
    {
        $authors = Author::withCount('blogs')->latest()->paginate(12);
        return view('authors.index', compact('authors'));
    }

    public function create(): View
    {
        return view('authors.create');
    }

    public function store(AuthorRequest $request): RedirectResponse
    {
        $author = Author::create($request->validated());
        return redirect()->route('authors.show', $author)
            ->with('success', 'Author created successfully.');
    }

    public function show(Author $author): View
    {
        $blogs = $author->blogs()
            ->with('categories')
            ->latest()
            ->paginate(9);

        return view('authors.show', compact('author', 'blogs'));
    }

    public function edit(Author $author): View
    {
        return view('authors.edit', compact('author'));
    }

    public function update(AuthorRequest $request, Author $author): RedirectResponse
    {
        $author->update($request->validated());
        return redirect()->route('authors.show', $author)
            ->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author): RedirectResponse
    {
        $author->delete();
        return redirect()->route('authors.index')
            ->with('success', 'Author deleted successfully.');
    }
}
