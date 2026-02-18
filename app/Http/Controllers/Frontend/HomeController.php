<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Place;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home.index', [
            'featuredPlaces' => Place::active()->featured()->orderBy('sort_order')->take(5)->get(),
            'recentBlogs'    => Blog::published()->latest()->take(3)->get(),
            'galleryPreview' => Gallery::active()->latest()->take(8)->get(),
            'featuredVideo'  => Video::active()->featured()->first(),
            'recentVideos'   => Video::active()->latest()->take(3)->get(),
            'activities'     => Activity::active()->orderBy('sort_order')->get(),
        ]);
    }

    public function about()
    {
        return view('frontend.about', [
            'places' => Place::active()->orderBy('sort_order')->take(6)->get(),
        ]);
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:100',
            'email'   => 'required|email',
            'subject' => 'nullable|max:200',
            'message' => 'required|min:10',
        ]);

        // Optionally send email here via Mail::to(...)->send(...)
        // For now just flash success
        return back()->with('success', 'ਧੰਨਵਾਦ! Thank you for contacting us. We will reply soon.');
    }
}
