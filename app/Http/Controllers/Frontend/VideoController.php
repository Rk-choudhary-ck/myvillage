<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Video::active()->latest();

        if ($request->category) {
            $query->where('category', $request->category);
        }

        $videos     = $query->paginate(12)->withQueryString();
        $featured   = Video::active()->featured()->first();
        $categories = Video::active()->distinct()->pluck('category');

        return view('frontend.videos.index', compact('videos', 'featured', 'categories'));
    }
}
