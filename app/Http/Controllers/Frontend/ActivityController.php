<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::active()->orderBy('sort_order')->get();
        $grouped    = $activities->groupBy('category');

        return view('frontend.activities.index', compact('activities', 'grouped'));
    }

    public function benefits()
    {
        return view('frontend.activities.benefits');
    }
}
