<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoAdminController extends Controller
{
    public function index()
    {
        $videos = Video::latest()->paginate(12);
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'video_type'  => 'required|in:youtube,upload',
            'video_url'   => 'nullable|url',
            'category'    => 'required',
            'duration'    => 'nullable|max:20',
            'thumbnail'   => 'nullable|image|max:5120',
            'video_file'  => 'nullable|file|mimes:mp4,mov,avi,webm|max:204800',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbs', 'public');
        }
        if ($request->hasFile('video_file')) {
            $data['video_path'] = $request->file('video_file')->store('videos/files', 'public');
        }

        Video::create($data);
        return redirect()->route('admin.videos.index')->with('success', 'Video added!');
    }

    public function show(Video $video)
    {
        return view('admin.videos.show', compact('video'));
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $request->validate([
            'title'       => 'required|max:255',
            'description' => 'nullable',
            'video_type'  => 'required|in:youtube,upload',
            'video_url'   => 'nullable|url',
            'category'    => 'required',
            'duration'    => 'nullable|max:20',
            'thumbnail'   => 'nullable|image|max:5120',
        ]);

        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active']   = $request->boolean('is_active', true);

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) Storage::disk('public')->delete($video->thumbnail);
            $data['thumbnail'] = $request->file('thumbnail')->store('videos/thumbs', 'public');
        }

        $video->update($data);
        return redirect()->route('admin.videos.index')->with('success', 'Video updated!');
    }

    public function destroy(Video $video)
    {
        if ($video->thumbnail) Storage::disk('public')->delete($video->thumbnail);
        if ($video->video_path) Storage::disk('public')->delete($video->video_path);
        $video->delete();
        return back()->with('success', 'Video deleted!');
    }

    public function toggleFeatured(Video $video)
    {
        $video->update(['is_featured' => !$video->is_featured]);
        return back()->with('success', 'Featured status updated!');
    }
}
