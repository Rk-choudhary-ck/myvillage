@extends('layouts.app')
@section('title','Photo Gallery — Chanan Khera')
@section('content')
<section style="padding:140px 0 60px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Visual Stories</div>
    <h1 class="section-title light" style="margin-top:8px">Photo <em>Gallery</em></h1>
  </div>
</section>
<section style="padding:60px 0;background:#0a1f04">
  <div class="container">
    <div style="display:flex;gap:8px;flex-wrap:wrap;justify-content:center;margin-bottom:40px">
      <a href="{{ route('gallery.index') }}" class="cta-btn" style="padding:7px 18px;font-size:11px">All</a>
      @foreach($categories as $cat)
      <a href="{{ route('gallery.index', ['category'=>$cat]) }}" class="cta-btn" style="padding:7px 18px;font-size:11px;background:var(--sage)">{{ $cat }}</a>
      @endforeach
    </div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:10px">
      @forelse($images as $img)
      <div style="position:relative;overflow:hidden;border-radius:10px;cursor:zoom-in" onclick="openLightbox('{{ Storage::url($img->image_path) }}','{{ $img->title }}')">
        <img src="{{ Storage::url($img->image_path) }}" alt="{{ $img->title }}" loading="lazy"
             style="width:100%;aspect-ratio:4/3;object-fit:cover;transition:transform 0.5s;display:block"
             onmouseover="this.style.transform='scale(1.06)'" onmouseout="this.style.transform='scale(1)'">
        <div style="position:absolute;inset:0;background:rgba(10,31,4,0.7);opacity:0;transition:0.3s;display:flex;align-items:center;justify-content:center;color:white;flex-direction:column;gap:8px"
             onmouseover="this.style.opacity=1" onmouseout="this.style.opacity=0">
          <span style="font-size:28px">🔍</span>
          <span style="font-size:13px;font-weight:600">{{ $img->title }}</span>
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:80px;color:rgba(255,255,255,0.5)">
        <div style="font-size:60px;margin-bottom:16px">📸</div>
        <p>No photos yet. Check back soon!</p>
      </div>
      @endforelse
    </div>
    <div style="margin-top:40px;text-align:center">{{ $images->links() }}</div>
  </div>
</section>

<!-- Lightbox -->
<div id="lightbox" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.95);z-index:9999;align-items:center;justify-content:center;flex-direction:column">
  <button onclick="closeLightbox()" style="position:absolute;top:20px;right:24px;background:none;border:none;color:white;font-size:32px;cursor:pointer">✕</button>
  <img id="lbImg" style="max-width:90vw;max-height:85vh;border-radius:8px;object-fit:contain">
  <p id="lbCaption" style="color:rgba(255,255,255,0.7);margin-top:12px;font-size:14px"></p>
</div>
<script>
function openLightbox(src, title) {
  document.getElementById('lbImg').src = src;
  document.getElementById('lbCaption').textContent = title;
  const lb = document.getElementById('lightbox');
  lb.style.display = 'flex';
}
function closeLightbox() { document.getElementById('lightbox').style.display = 'none'; }
document.getElementById('lightbox').addEventListener('click', function(e) { if (e.target === this) closeLightbox(); });
</script>
@endsection
