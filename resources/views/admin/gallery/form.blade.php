@extends('layouts.admin')
@section('title', isset($gallery) ? 'Edit Image' : 'Upload Photos')
@section('breadcrumb') / <a href="{{ route('admin.gallery.index') }}">Gallery</a> / {{ isset($gallery) ? 'Edit' : 'Upload' }} @endsection

@section('content')
<div class="page-header">
  <h1 class="page-title">{{ isset($gallery) ? 'Edit Image' : 'Upload Photos' }}</h1>
  <a href="{{ route('admin.gallery.index') }}" class="admin-btn admin-btn-ghost">← Back</a>
</div>

<form method="POST"
      action="{{ isset($gallery) ? route('admin.gallery.update', $gallery) : route('admin.gallery.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if(isset($gallery)) @method('PUT') @endif

  <div class="form-two-col">
    <div class="form-main-col">
      <div class="admin-card">
        <div class="admin-card-header">{{ isset($gallery) ? 'Image Details' : 'Upload Images' }}</div>
        <div class="admin-card-body">
          @if(!isset($gallery))
          <div class="form-group">
            <label class="form-label">Select Images * (Multiple Allowed)</label>
            <div style="border:2px dashed #cbd5e0;border-radius:10px;padding:40px;text-align:center;cursor:pointer;transition:0.3s"
                 id="dropZone" onclick="document.getElementById('images').click()">
              <div style="font-size:48px;margin-bottom:12px">📸</div>
              <p style="font-size:15px;font-weight:500;color:#4a5568">Click to select or drag & drop images</p>
              <p style="font-size:12px;color:#9ca3af;margin-top:6px">JPEG, PNG, WebP — Max 5MB each</p>
            </div>
            <input type="file" name="images[]" id="images" accept="image/*" multiple style="display:none"
                   onchange="previewMultiple(this)">
            <div id="multiPreview" style="display:grid;grid-template-columns:repeat(auto-fill,minmax(100px,1fr));gap:8px;margin-top:12px"></div>
          </div>
          @else
          <div class="form-group">
            <label class="form-label">Replace Image</label>
            <img src="{{ Storage::url($gallery->image_path) }}" style="width:100%;max-height:300px;object-fit:cover;border-radius:10px;margin-bottom:12px">
            <input type="file" name="image" class="admin-input" accept="image/*">
          </div>
          @endif

          <div class="form-group">
            <label class="form-label">Title / Caption</label>
            <input type="text" name="title" class="admin-input"
                   value="{{ old('title', $gallery->title ?? 'Village Photo') }}"
                   placeholder="e.g., Harvest Festival 2024">
          </div>
          <div class="form-group">
            <label class="form-label">Category *</label>
            <select name="category" class="admin-input" required>
              @foreach(['Nature','People','Festival','Places','Culture','Agriculture','Architecture','Food','Activities','General'] as $cat)
              <option value="{{ $cat }}" {{ old('category', $gallery->category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Caption/Description</label>
            <textarea name="caption" rows="2" class="admin-input" placeholder="Short description of the photo">{{ old('caption', $gallery->caption ?? '') }}</textarea>
          </div>
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%">
            {{ isset($gallery) ? '💾 Update' : '📸 Upload Photos' }}
          </button>
        </div>
      </div>
    </div>

    <div class="form-side-col">
      <div class="admin-card">
        <div class="admin-card-header">Tips</div>
        <div class="admin-card-body">
          <ul style="font-size:13px;color:#6b7280;line-height:2;list-style:none;padding:0">
            <li>✅ Upload multiple photos at once</li>
            <li>✅ Recommended: 1200×800px minimum</li>
            <li>✅ JPEG format for best quality</li>
            <li>✅ Max 5MB per image</li>
            <li>✅ All photos are stored securely</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('scripts')
<script>
function previewMultiple(input) {
  const preview = document.getElementById('multiPreview');
  preview.innerHTML = '';
  Array.from(input.files).forEach(file => {
    const reader = new FileReader();
    reader.onload = e => {
      const div = document.createElement('div');
      div.style.cssText = 'position:relative;border-radius:8px;overflow:hidden;aspect-ratio:1';
      div.innerHTML = `<img src="${e.target.result}" style="width:100%;height:100%;object-fit:cover">`;
      preview.appendChild(div);
    };
    reader.readAsDataURL(file);
  });
  document.getElementById('dropZone').querySelector('p').textContent = `${input.files.length} file(s) selected`;
}
const dz = document.getElementById('dropZone');
if (dz) {
  dz.addEventListener('dragover', e => { e.preventDefault(); dz.style.borderColor='#1a5c10'; });
  dz.addEventListener('dragleave', () => { dz.style.borderColor='#cbd5e0'; });
  dz.addEventListener('drop', e => {
    e.preventDefault();
    dz.style.borderColor='#cbd5e0';
    document.getElementById('images').files = e.dataTransfer.files;
    previewMultiple(document.getElementById('images'));
  });
}
</script>
@endsection
