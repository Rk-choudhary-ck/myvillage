<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryAdminController extends Controller
{
    public function index()
    {
        $images     = Gallery::latest()->paginate(24);
        $categories = Gallery::distinct()->pluck('category');
        return view('admin.gallery.index', compact('images', 'categories'));
    }

    public function create()
    {
        return view('admin.gallery.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'images'    => 'required',
            'images.*'  => 'image|max:5120',
            'category'  => 'required',
            'title'     => 'nullable|max:255',
        ]);

        $category = $request->category;
        $count    = 0;

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                Gallery::create([
                    'title'      => $request->title ?: 'Village Photo',
                    'image_path' => $file->store('gallery', 'public'),
                    'category'   => $category,
                    'caption'    => $request->caption,
                    'is_active'  => true,
                ]);
                $count++;
            }
        }

        return redirect()->route('admin.gallery.index')
                         ->with('success', "{$count} image(s) uploaded successfully!");
    }

    public function show(Gallery $gallery)
    {
        return view('admin.gallery.show', compact('gallery'));
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.form', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $data = $request->validate([
            'title'    => 'required|max:255',
            'category' => 'required',
            'caption'  => 'nullable',
            'image'    => 'nullable|image|max:5120',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($gallery->image_path);
            $data['image_path'] = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Image updated!');
    }

    public function destroy(Gallery $gallery)
    {
        Storage::disk('public')->delete($gallery->image_path);
        $gallery->delete();
        return back()->with('success', 'Image deleted!');
    }

    public function bulkDelete(Request $request)
    {
        $ids = $request->ids ?? [];
        $images = Gallery::whereIn('id', $ids)->get();
        foreach ($images as $img) {
            Storage::disk('public')->delete($img->image_path);
            $img->delete();
        }
        return back()->with('success', count($ids) . ' image(s) deleted!');
    }

    public function bulkUpload(Request $request)
    {
        return $this->store($request);
    }
}
