<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::active()->orderBy('sort_order')->latest();

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $images     = $query->paginate(24)->withQueryString();
        $categories = Gallery::active()->distinct()->pluck('category');

        return view('frontend.gallery.index', compact('images', 'categories'));
    }
}
