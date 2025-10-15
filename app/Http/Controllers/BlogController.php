<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::with(['author', 'categories'])->latest()->paginate(9);
        return view('blogs.index', compact('blogs'));
    }

    public function create(): View
    {
        return view('blogs.create');
    }

    public function store(BlogRequest $request): RedirectResponse
    {
        $blog = Blog::create($request->validated());
        return redirect()->route('blogs.show', $blog)
            ->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog): View
    {
        $blog->load(['author', 'categories', 'contents' => function ($query) {
            $query->orderBy('order', 'asc');
        }]);

        return view('blogs.show', compact('blog'));
    }

    public function edit(Blog $blog): View
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(BlogRequest $request, Blog $blog): RedirectResponse
    {
        $blog->update($request->validated());
        return redirect()->route('blogs.show', $blog)
            ->with('success', 'Blog updated successfully.');
    }

    public function destroy(Blog $blog): RedirectResponse
    {
        $blog->delete();
        return redirect()->route('blogs.index')
            ->with('success', 'Blog deleted successfully.');
    }
}
