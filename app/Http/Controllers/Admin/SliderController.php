<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('sort_order')->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|max:255',
            'subtitle'     => 'nullable|max:500',
            'gradient'     => 'nullable|max:255',
            'button_text'  => 'nullable|max:100',
            'button_url'   => 'nullable|max:255',
            'button2_text' => 'nullable|max:100',
            'button2_url'  => 'nullable|max:255',
            'sort_order'   => 'nullable|integer',
            'image'        => 'nullable|image|max:5120',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slider', 'public');
        }

        Slider::create($data);
        return redirect()->route('admin.slider.index')->with('success', 'Slide added!');
    }

    public function show(Slider $slider)
    {
        return view('admin.slider.show', compact('slider'));
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.form', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'        => 'required|max:255',
            'subtitle'     => 'nullable|max:500',
            'gradient'     => 'nullable|max:255',
            'button_text'  => 'nullable|max:100',
            'button_url'   => 'nullable|max:255',
            'button2_text' => 'nullable|max:100',
            'button2_url'  => 'nullable|max:255',
            'sort_order'   => 'nullable|integer',
            'image'        => 'nullable|image|max:5120',
        ]);

        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('image')) {
            if ($slider->image) Storage::disk('public')->delete($slider->image);
            $data['image'] = $request->file('image')->store('slider', 'public');
        }

        $slider->update($data);
        return redirect()->route('admin.slider.index')->with('success', 'Slide updated!');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image) Storage::disk('public')->delete($slider->image);
        $slider->delete();
        return back()->with('success', 'Slide deleted!');
    }
}
