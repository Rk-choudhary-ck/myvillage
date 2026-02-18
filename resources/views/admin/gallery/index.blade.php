@extends('layouts.admin')
@section('title','Gallery')
@section('breadcrumb') / Gallery @endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Photo Gallery</h1>
    <p class="page-sub">{{ $images->total() }} images</p>
  </div>
  <a href="{{ route('admin.gallery.create') }}" class="admin-btn admin-btn-primary">+ Upload Photos</a>
</div>

<!-- Filters -->
<div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap">
  <a href="{{ route('admin.gallery.index') }}" class="admin-btn {{ !request('category') ? 'admin-btn-primary' : 'admin-btn-ghost' }}">All</a>
  @foreach($categories as $cat)
  <a href="{{ route('admin.gallery.index', ['category'=>$cat]) }}" class="admin-btn {{ request('category')==$cat ? 'admin-btn-primary' : 'admin-btn-ghost' }}">{{ $cat }}</a>
  @endforeach
</div>

<!-- Gallery Grid -->
<div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:12px">
  @forelse($images as $img)
  <div style="position:relative;border-radius:10px;overflow:hidden;background:#f3f4f6;aspect-ratio:1;" class="gallery-admin-item">
    <img src="{{ Storage::url($img->image_path) }}" alt="{{ $img->title }}"
         style="width:100%;height:100%;object-fit:cover;transition:transform 0.3s">
    <div style="position:absolute;inset:0;background:rgba(0,0,0,0.6);opacity:0;transition:0.3s;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:8px"
         class="img-overlay">
      <span style="color:white;font-size:12px;font-weight:600;text-align:center;padding:0 8px">{{ Str::limit($img->title, 20) }}</span>
      <span style="color:rgba(255,255,255,0.7);font-size:11px">{{ $img->category }}</span>
      <div style="display:flex;gap:6px">
        <a href="{{ route('admin.gallery.edit', $img) }}" style="padding:4px 10px;background:white;color:#333;border-radius:4px;font-size:11px;font-weight:500">Edit</a>
        <form method="POST" action="{{ route('admin.gallery.destroy', $img) }}" style="display:inline">
          @csrf @method('DELETE')
          <button onclick="return confirm('Delete?')" style="padding:4px 10px;background:#ef4444;color:white;border:none;border-radius:4px;font-size:11px;font-weight:500;cursor:pointer">Del</button>
        </form>
      </div>
    </div>
  </div>
  @empty
  <div style="grid-column:1/-1;text-align:center;padding:60px;color:#9ca3af">
    <div style="font-size:60px;margin-bottom:16px">📸</div>
    <p>No images uploaded yet.</p>
    <a href="{{ route('admin.gallery.create') }}" style="color:#1a5c10;font-weight:500">Upload first photos →</a>
  </div>
  @endforelse
</div>

<div style="margin-top:24px">{{ $images->links() }}</div>

<style>
.gallery-admin-item:hover img { transform: scale(1.05); }
.gallery-admin-item:hover .img-overlay { opacity: 1 !important; }
</style>
@endsection
