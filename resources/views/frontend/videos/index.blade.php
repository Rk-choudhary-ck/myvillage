@extends('layouts.app')
@section('title','Videos — Chanan Khera')
@section('content')
<section style="padding:140px 0 60px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Watch & Experience</div>
    <h1 class="section-title light" style="margin-top:8px">Village <em>Videos</em></h1>
  </div>
</section>
<section style="padding:60px 0;background:var(--cream)">
  <div class="container">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(340px,1fr));gap:28px">
      @forelse($videos as $video)
      <div style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 4px 20px rgba(0,0,0,0.06);cursor:pointer"
           onclick="playVideo('{{ $video->embed_url }}')">
        <div style="position:relative;aspect-ratio:16/9;overflow:hidden">
          @if($video->thumbnail)
          <img src="{{ Storage::url($video->thumbnail) }}" style="width:100%;height:100%;object-fit:cover">
          @else
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#0a2a05,#2d8a1a);display:flex;align-items:center;justify-content:center;font-size:60px;opacity:0.5">🎬</div>
          @endif
          <div style="position:absolute;inset:0;background:rgba(0,0,0,0.3);display:flex;align-items:center;justify-content:center">
            <div style="width:60px;height:60px;background:var(--gold);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:22px;color:var(--green-deep)">▶</div>
          </div>
          @if($video->duration)<span style="position:absolute;bottom:10px;right:10px;background:rgba(0,0,0,0.7);color:white;padding:3px 10px;border-radius:4px;font-size:12px">{{ $video->duration }}</span>@endif
          @if($video->is_featured)<span style="position:absolute;top:10px;left:10px;background:var(--gold);color:var(--green-deep);padding:3px 10px;border-radius:4px;font-size:10px;font-weight:700">⭐ Featured</span>@endif
        </div>
        <div style="padding:20px">
          <span style="font-size:9px;letter-spacing:2px;text-transform:uppercase;color:var(--sage);display:block;margin-bottom:6px">{{ $video->category }}</span>
          <h3 style="font-family:'Yeseva One',serif;font-size:18px;color:var(--green-deep)">{{ $video->title }}</h3>
          @if($video->description)<p style="font-size:13px;color:var(--text-muted);margin-top:8px;line-height:1.6">{{ Str::limit($video->description, 80) }}</p>@endif
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:80px;color:var(--text-muted)">
        <div style="font-size:60px;margin-bottom:16px">🎬</div>
        <p>No videos yet. Check back soon!</p>
      </div>
      @endforelse
    </div>
    <div style="margin-top:40px;text-align:center">{{ $videos->links() }}</div>
  </div>
</section>
<!-- Video Modal -->
<div class="video-modal" id="videoModal">
  <div class="vm-backdrop" onclick="closeVideo()"></div>
  <div class="vm-container">
    <button class="vm-close" onclick="closeVideo()">✕</button>
    <div class="vm-frame" id="vmFrame"></div>
  </div>
</div>
<script>
function playVideo(url) {
  if (!url) return;
  document.getElementById('vmFrame').innerHTML = `<iframe src="${url}?autoplay=1" frameborder="0" allowfullscreen style="width:100%;aspect-ratio:16/9;border-radius:12px"></iframe>`;
  document.getElementById('videoModal').classList.add('active');
}
function closeVideo() {
  document.getElementById('videoModal').classList.remove('active');
  document.getElementById('vmFrame').innerHTML = '';
}
</script>
@endsection
