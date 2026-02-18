{{-- resources/views/admin/videos/index.blade.php --}}
@extends('layouts.admin')
@section('title','Videos')
@section('breadcrumb') / Videos @endsection
@section('content')
<div class="page-header">
  <div><h1 class="page-title">Videos</h1><p class="page-sub">{{ $videos->total() }} videos</p></div>
  <a href="{{ route('admin.videos.create') }}" class="admin-btn admin-btn-primary">+ Add Video</a>
</div>
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:16px">
  @forelse($videos as $video)
  <div style="background:white;border-radius:12px;overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,0.08)">
    <div style="position:relative;aspect-ratio:16/9;background:linear-gradient(135deg,#0a2a05,#2d8a1a);display:flex;align-items:center;justify-content:center;font-size:40px;opacity:0.5">
      @if($video->thumbnail)<img src="{{ Storage::url($video->thumbnail) }}" style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;opacity:1">@endif
      🎬
      @if($video->is_featured)<span style="position:absolute;top:8px;left:8px;background:var(--gold);color:#000;font-size:9px;font-weight:700;padding:3px 8px;border-radius:4px">⭐ Featured</span>@endif
    </div>
    <div style="padding:14px">
      <div style="font-size:10px;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;margin-bottom:4px">{{ $video->category }} · {{ strtoupper($video->video_type) }}</div>
      <h3 style="font-size:14px;font-weight:600;margin-bottom:10px;line-height:1.3">{{ Str::limit($video->title, 50) }}</h3>
      <div class="table-actions">
        <a href="{{ route('admin.videos.edit', $video) }}" class="ta-btn ta-edit">Edit</a>
        <form method="POST" action="{{ route('admin.videos.toggle-featured', $video) }}" style="display:inline">@csrf<button class="ta-btn" style="background:#fef3c7;color:#d97706">{{ $video->is_featured ? 'Unfeature' : 'Feature' }}</button></form>
        <form method="POST" action="{{ route('admin.videos.destroy', $video) }}" style="display:inline">@csrf @method('DELETE')<button class="ta-btn ta-del" onclick="return confirm('Delete?')">Del</button></form>
      </div>
    </div>
  </div>
  @empty
  <div style="grid-column:1/-1;text-align:center;padding:60px;color:#9ca3af">
    <div style="font-size:48px;margin-bottom:12px">🎬</div>
    <p>No videos yet. <a href="{{ route('admin.videos.create') }}" style="color:#1a5c10">Add first video →</a></p>
  </div>
  @endforelse
</div>
<div style="margin-top:24px">{{ $videos->links() }}</div>
@endsection
