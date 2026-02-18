<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PlaceAdminController extends Controller
{
    public function index()
    {
        $places = Place::orderBy('sort_order')->paginate(15);
        return view('admin.places.index', compact('places'));
    }

    public function create()
    {
        return view('admin.places.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'               => 'required|max:255',
            'category'           => 'required',
            'icon'               => 'nullable|max:10',
            'description'        => 'required',
            'full_description'   => 'nullable',
            'location_name'      => 'nullable|max:255',
            'latitude'           => 'nullable|numeric',
            'longitude'          => 'nullable|numeric',
            'best_time_to_visit' => 'nullable|max:255',
            'sort_order'         => 'nullable|integer',
            'thumbnail'          => 'nullable|image|max:5120',
        ]);

        $data['slug']        = Str::slug($data['name']);
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('places', 'public');
        }

        // Handle multiple gallery images
        if ($request->hasFile('gallery_images')) {
            $gallery = [];
            foreach ($request->file('gallery_images') as $img) {
                $gallery[] = $img->store('places/gallery', 'public');
            }
            $data['gallery_images'] = $gallery;
        }

        Place::create($data);
        return redirect()->route('admin.places.index')->with('success', 'Place added successfully!');
    }

    public function show(Place $place)
    {
        return view('admin.places.show', compact('place'));
    }

    public function edit(Place $place)
    {
        return view('admin.places.form', compact('place'));
    }

    public function update(Request $request, Place $place)
    {
        $data = $request->validate([
            'name'               => 'required|max:255',
            'category'           => 'required',
            'icon'               => 'nullable|max:10',
            'description'        => 'required',
            'full_description'   => 'nullable',
            'location_name'      => 'nullable|max:255',
            'latitude'           => 'nullable|numeric',
            'longitude'          => 'nullable|numeric',
            'best_time_to_visit' => 'nullable|max:255',
            'sort_order'         => 'nullable|integer',
            'thumbnail'          => 'nullable|image|max:5120',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            if ($place->thumbnail) Storage::disk('public')->delete($place->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('places', 'public');
        }

        $place->update($data);
        return redirect()->route('admin.places.index')->with('success', 'Place updated!');
    }

    public function destroy(Place $place)
    {
        if ($place->thumbnail) Storage::disk('public')->delete($place->thumbnail);
        $place->delete();
        return back()->with('success', 'Place deleted!');
    }

    public function toggleActive(Place $place)
    {
        $place->update(['is_active' => !$place->is_active]);
        return back()->with('success', 'Status updated!');
    }

    public function toggleFeatured(Place $place)
    {
        $place->update(['is_featured' => !$place->is_featured]);
        return back()->with('success', 'Featured status updated!');
    }
}
