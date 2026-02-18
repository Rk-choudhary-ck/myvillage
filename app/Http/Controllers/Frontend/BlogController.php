<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        $query = Blog::published()->latest();

        if ($request->category) {
            $query->where('category', $request->category);
        }
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', "%{$request->search}%")
                  ->orWhere('excerpt', 'like', "%{$request->search}%");
            });
        }

        $blogs      = $query->paginate(9)->withQueryString();
        $categories = Blog::published()->distinct()->pluck('category');
        $featured   = Blog::published()->featured()->latest()->first();

        return view('frontend.blog.index', compact('blogs', 'categories', 'featured'));
    }

    public function show(Blog $blog)
    {
        abort_if(!$blog->is_published, 404);
        $blog->incrementViews();

        $related = Blog::published()
            ->where('id', '!=', $blog->id)
            ->where('category', $blog->category)
            ->latest()->take(3)->get();

        return view('frontend.blog.show', compact('blog', 'related'));
    }

    public function byCategory(string $category)
    {
        $blogs      = Blog::published()->byCategory($category)->latest()->paginate(9);
        $categories = Blog::published()->distinct()->pluck('category');

        return view('frontend.blog.index', compact('blogs', 'categories'))->with('activeCategory', $category);
    }
}
