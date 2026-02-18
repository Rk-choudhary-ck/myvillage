<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Culture;

class CultureController extends Controller
{
    public function index()
    {
        $cultures   = Culture::active()->orderBy('sort_order')->get();
        $grouped    = $cultures->groupBy('category');

        return view('frontend.culture.index', compact('cultures', 'grouped'));
    }
}
