<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Place;
use App\Models\Gallery;
use App\Models\Video;
use App\Models\Culture;
use App\Models\Activity;
use App\Models\AdminUser;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'stats' => [
                'blogs'           => Blog::count(),
                'published_blogs' => Blog::where('is_published', true)->count(),
                'places'          => Place::count(),
                'gallery'         => Gallery::count(),
                'videos'          => Video::count(),
                'cultures'        => Culture::count(),
                'activities'      => Activity::count(),
                'views'           => Blog::sum('views'),
                'admin_users'     => AdminUser::count(),
            ],
            'recentBlogs'   => Blog::latest()->take(8)->get(),
            'recentPlaces'  => Place::orderBy('sort_order')->take(6)->get(),
            'recentGallery' => Gallery::latest()->take(6)->get(),
        ]);
    }
}
