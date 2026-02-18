<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Culture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CultureAdminController extends Controller
{
    public function index()
    {
        $cultures = Culture::orderBy('sort_order')->paginate(15);
        return view('admin.culture.index', compact('cultures'));
    }

    public function create()
    {
        return view('admin.culture.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => 'required|max:255',
            'icon'             => 'nullable|max:10',
            'category'         => 'required',
            'description'      => 'required',
            'full_description' => 'nullable',
            'sort_order'       => 'nullable|integer',
            'thumbnail'        => 'nullable|image|max:5120',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('culture', 'public');
        }

        Culture::create($data);
        return redirect()->route('admin.culture.index')->with('success', 'Culture item added!');
    }

    public function show(Culture $culture)
    {
        return view('admin.culture.show', compact('culture'));
    }

    public function edit(Culture $culture)
    {
        return view('admin.culture.form', compact('culture'));
    }

    public function update(Request $request, Culture $culture)
    {
        $data = $request->validate([
            'title'            => 'required|max:255',
            'icon'             => 'nullable|max:10',
            'category'         => 'required',
            'description'      => 'required',
            'full_description' => 'nullable',
            'sort_order'       => 'nullable|integer',
            'thumbnail'        => 'nullable|image|max:5120',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            if ($culture->thumbnail) Storage::disk('public')->delete($culture->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('culture', 'public');
        }

        $culture->update($data);
        return redirect()->route('admin.culture.index')->with('success', 'Culture item updated!');
    }

    public function destroy(Culture $culture)
    {
        if ($culture->thumbnail) Storage::disk('public')->delete($culture->thumbnail);
        $culture->delete();
        return back()->with('success', 'Culture item deleted!');
    }

    public function toggleActive(Culture $culture)
    {
        $culture->update(['is_active' => !$culture->is_active]);
        return back()->with('success', 'Status updated!');
    }
}
