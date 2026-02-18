<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogAdminController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(15);
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|max:255',
            'excerpt'          => 'required',
            'content'          => 'required',
            'category'         => 'required',
            'author'           => 'nullable|max:100',
            'tags'             => 'nullable|max:255',
            'meta_description' => 'nullable|max:160',
            'slug'             => 'nullable|max:255',
            'thumbnail'        => 'nullable|image|max:5120',
        ]);

        $data['slug']         = $request->slug ? Str::slug($request->slug) : Str::slug($data['title']);
        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured']  = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        // Ensure slug is unique
        $originalSlug = $data['slug'];
        $count = 1;
        while (Blog::where('slug', $data['slug'])->exists()) {
            $data['slug'] = $originalSlug . '-' . $count++;
        }

        Blog::create($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post created successfully!');
    }

    public function show(Blog $blog)
    {
        return view('admin.blogs.show', compact('blog'));
    }

    public function edit(Blog $blog)
    {
        return view('admin.blogs.form', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title'            => 'required|max:255',
            'excerpt'          => 'required',
            'content'          => 'required',
            'category'         => 'required',
            'author'           => 'nullable|max:100',
            'tags'             => 'nullable|max:255',
            'meta_description' => 'nullable|max:160',
            'thumbnail'        => 'nullable|image|max:5120',
        ]);

        $data['is_published'] = $request->boolean('is_published');
        $data['is_featured']  = $request->boolean('is_featured');

        if ($request->hasFile('thumbnail')) {
            if ($blog->thumbnail) Storage::disk('public')->delete($blog->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('blogs', 'public');
        }

        $blog->update($data);
        return redirect()->route('admin.blogs.index')->with('success', 'Blog post updated successfully!');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->thumbnail) Storage::disk('public')->delete($blog->thumbnail);
        $blog->delete();
        return back()->with('success', 'Blog post deleted!');
    }

    public function togglePublish(Blog $blog)
    {
        $blog->update(['is_published' => !$blog->is_published]);
        $status = $blog->is_published ? 'published' : 'unpublished';
        return back()->with('success', "Blog post {$status}!");
    }

    public function toggleFeatured(Blog $blog)
    {
        $blog->update(['is_featured' => !$blog->is_featured]);
        return back()->with('success', 'Featured status updated!');
    }
}
