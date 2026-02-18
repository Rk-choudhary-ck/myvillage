<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityAdminController extends Controller
{
    public function index()
    {
        $activities = Activity::orderBy('sort_order')->paginate(15);
        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        return view('admin.activities.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|max:255',
            'icon'        => 'nullable|max:10',
            'category'    => 'required',
            'season'      => 'nullable|max:100',
            'description' => 'required',
            'sort_order'  => 'nullable|integer',
            'thumbnail'   => 'nullable|image|max:5120',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('activities', 'public');
        }

        Activity::create($data);
        return redirect()->route('admin.activities.index')->with('success', 'Activity added!');
    }

    public function show(Activity $activity)
    {
        return view('admin.activities.show', compact('activity'));
    }

    public function edit(Activity $activity)
    {
        return view('admin.activities.form', compact('activity'));
    }

    public function update(Request $request, Activity $activity)
    {
        $data = $request->validate([
            'name'        => 'required|max:255',
            'icon'        => 'nullable|max:10',
            'category'    => 'required',
            'season'      => 'nullable|max:100',
            'description' => 'required',
            'sort_order'  => 'nullable|integer',
            'thumbnail'   => 'nullable|image|max:5120',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            if ($activity->thumbnail) Storage::disk('public')->delete($activity->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('activities', 'public');
        }

        $activity->update($data);
        return redirect()->route('admin.activities.index')->with('success', 'Activity updated!');
    }

    public function destroy(Activity $activity)
    {
        if ($activity->thumbnail) Storage::disk('public')->delete($activity->thumbnail);
        $activity->delete();
        return back()->with('success', 'Activity deleted!');
    }
}
