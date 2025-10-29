<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Author;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    public function index(): View
    {
        $blogs = Blog::with(['author', 'categories'])->latest()->paginate(9);
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('blogs.create', compact('authors', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'author_id' => 'required|exists:users,id',
            'contents' => 'array',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);


        $blogData = [
            'title' => $validatedData['title'],
            'subtitle' => $validatedData['subtitle'],
            'author_id' => $validatedData['author_id'],
            'about' => \Illuminate\Support\Str::limit($validatedData['contents'][0], 150),
        ];

        if ($request->hasFile('thumbnail')) {
            $path = $request->file('thumbnail')->store('thumbnails', 'public');
            $blogData['thumbnail'] = $path;
        }

        $blog = Blog::create($blogData);

        foreach ($validatedData['contents'] as $key => $content) {
            $blog->contents()->create([
                'content' => $content,
                'order' => $key,
            ]);
        }

        if ($request->has('categories')) {
            $blog->categories()->sync($request->input('categories'));
        }

        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
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
