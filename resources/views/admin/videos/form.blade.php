@extends('layouts.admin')
@section('title', isset($video) ? 'Edit Video' : 'Add Video')
@section('breadcrumb') / <a href="{{ route('admin.videos.index') }}">Videos</a> / {{ isset($video) ? 'Edit' : 'Add' }} @endsection
@section('content')
<div class="page-header">
  <h1 class="page-title">{{ isset($video) ? 'Edit Video' : 'Add Video' }}</h1>
  <a href="{{ route('admin.videos.index') }}" class="admin-btn admin-btn-ghost">← Back</a>
</div>
<form method="POST" action="{{ isset($video) ? route('admin.videos.update',$video) : route('admin.videos.store') }}" enctype="multipart/form-data">
  @csrf @if(isset($video)) @method('PUT') @endif
  <div class="form-two-col">
    <div class="form-main-col">
      <div class="admin-card">
        <div class="admin-card-header">Video Details</div>
        <div class="admin-card-body">
          <div class="form-group">
            <label class="form-label">Title *</label>
            <input type="text" name="title" class="admin-input" value="{{ old('title', $video->title ?? '') }}" required>
          </div>
          <div class="form-group">
            <label class="form-label">Video Type</label>
            <select name="video_type" id="videoType" class="admin-input" onchange="toggleVideoType()">
              <option value="youtube" {{ old('video_type', $video->video_type ?? '') == 'youtube' ? 'selected' : '' }}>YouTube Link</option>
              <option value="upload" {{ old('video_type', $video->video_type ?? '') == 'upload' ? 'selected' : '' }}>Upload Video File</option>
            </select>
          </div>
          <div class="form-group" id="youtubeField">
            <label class="form-label">YouTube URL</label>
            <input type="url" name="video_url" class="admin-input" value="{{ old('video_url', $video->video_url ?? '') }}" placeholder="https://www.youtube.com/watch?v=...">
          </div>
          <div class="form-group" id="uploadField" style="display:none">
            <label class="form-label">Video File (MP4, max 200MB)</label>
            <input type="file" name="video_file" class="admin-input" accept="video/*">
          </div>
          <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4" class="admin-input">{{ old('description', $video->description ?? '') }}</textarea>
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="form-group">
              <label class="form-label">Category</label>
              <select name="category" class="admin-input">
                @foreach(['General','Festival','Nature','Culture','Activities','Farming','Heritage'] as $c)
                <option value="{{ $c }}" {{ old('category', $video->category ?? '') == $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Duration (e.g. 3:45)</label>
              <input type="text" name="duration" class="admin-input" value="{{ old('duration', $video->duration ?? '') }}" placeholder="3:45">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-side-col">
      <div class="admin-card">
        <div class="admin-card-header">Settings</div>
        <div class="admin-card-body">
          <div class="toggle-group">
            <label class="toggle-label">Active</label>
            <label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $video->is_active ?? true) ? 'checked' : '' }}><span class="toggle-slider"></span></label>
          </div>
          <div class="toggle-group">
            <label class="toggle-label">Featured</label>
            <label class="toggle-switch"><input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $video->is_featured ?? false) ? 'checked' : '' }}><span class="toggle-slider"></span></label>
          </div>
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;margin-top:16px">{{ isset($video) ? '💾 Update' : '🎬 Add Video' }}</button>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-header">Thumbnail</div>
        <div class="admin-card-body">
          <div class="image-preview-box" onclick="document.getElementById('thumbnail').click()">
            @if(isset($video) && $video->thumbnail)
            <img src="{{ Storage::url($video->thumbnail) }}" id="thumbPreview" style="width:100%;height:100%;object-fit:cover">
            @else
            <div id="thumbPlaceholder" style="text-align:center;color:#a0aec0"><span style="font-size:36px;display:block">🎬</span><p>Click to upload</p></div>
            @endif
          </div>
          <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none" onchange="previewImage(this,'thumbPreview','thumbPlaceholder')">
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
@section('scripts')
<script>
function toggleVideoType() {
  const t = document.getElementById('videoType').value;
  document.getElementById('youtubeField').style.display = t === 'youtube' ? 'block' : 'none';
  document.getElementById('uploadField').style.display = t === 'upload' ? 'block' : 'none';
}
toggleVideoType();
</script>
@endsection
