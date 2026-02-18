<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Place;

class PlaceController extends Controller
{
    public function index()
    {
        $places     = Place::active()->orderBy('sort_order')->paginate(12);
        $categories = Place::active()->distinct()->pluck('category');

        return view('frontend.places.index', compact('places', 'categories'));
    }

    public function show(Place $place)
    {
        abort_if(!$place->is_active, 404);

        $related = Place::active()
            ->where('id', '!=', $place->id)
            ->where('category', $place->category)
            ->take(3)->get();

        return view('frontend.places.show', compact('place', 'related'));
    }
}
