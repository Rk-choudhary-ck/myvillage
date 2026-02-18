@extends('layouts.admin')
@section('title', isset($place) ? 'Edit Place' : 'Add Place')
@section('breadcrumb') / <a href="{{ route('admin.places.index') }}">Places</a> / {{ isset($place) ? 'Edit' : 'Add' }} @endsection

@section('content')
<div class="page-header">
  <h1 class="page-title">{{ isset($place) ? 'Edit: '.$place->name : 'Add Famous Place' }}</h1>
  <a href="{{ route('admin.places.index') }}" class="admin-btn admin-btn-ghost">← Back</a>
</div>

<form method="POST"
      action="{{ isset($place) ? route('admin.places.update', $place) : route('admin.places.store') }}"
      enctype="multipart/form-data">
  @csrf
  @if(isset($place)) @method('PUT') @endif

  <div class="form-two-col">
    <div class="form-main-col">
      <div class="admin-card">
        <div class="admin-card-header">Place Details</div>
        <div class="admin-card-body">
          <div class="form-group">
            <label class="form-label">Place Name *</label>
            <input type="text" name="name" class="admin-input @error('name') is-invalid @enderror"
                   value="{{ old('name', $place->name ?? '') }}" required>
            @error('name')<div class="form-error">{{ $message }}</div>@enderror
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="form-group">
              <label class="form-label">Category *</label>
              <select name="category" class="admin-input" required>
                @foreach(['Sacred Site','Water Body','Nature','Heritage','Agriculture','Market','Landmark','Temple','Gurdwara','Park'] as $cat)
                <option value="{{ $cat }}" {{ old('category', $place->category ?? '') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Icon (Emoji)</label>
              <input type="text" name="icon" class="admin-input" style="font-size:24px"
                     value="{{ old('icon', $place->icon ?? '📍') }}" placeholder="📍">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Short Description *</label>
            <textarea name="description" rows="3" class="admin-input" required>{{ old('description', $place->description ?? '') }}</textarea>
          </div>
          <div class="form-group">
            <label class="form-label">Full Description</label>
            <textarea name="full_description" rows="6" class="admin-input">{{ old('full_description', $place->full_description ?? '') }}</textarea>
          </div>
          <div class="form-group">
            <label class="form-label">Best Time to Visit</label>
            <input type="text" name="best_time_to_visit" class="admin-input"
                   value="{{ old('best_time_to_visit', $place->best_time_to_visit ?? '') }}"
                   placeholder="e.g., October to March">
          </div>
          <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px">
            <div class="form-group">
              <label class="form-label">Location Name</label>
              <input type="text" name="location_name" class="admin-input" value="{{ old('location_name', $place->location_name ?? '') }}">
            </div>
            <div class="form-group">
              <label class="form-label">Latitude</label>
              <input type="text" name="latitude" class="admin-input" value="{{ old('latitude', $place->latitude ?? '') }}" placeholder="30.7333">
            </div>
            <div class="form-group">
              <label class="form-label">Longitude</label>
              <input type="text" name="longitude" class="admin-input" value="{{ old('longitude', $place->longitude ?? '') }}" placeholder="76.7794">
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
            <label class="toggle-label">Active (Visible)</label>
            <label class="toggle-switch">
              <input type="checkbox" name="is_active" value="1" {{ old('is_active', $place->is_active ?? true) ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
          </div>
          <div class="toggle-group">
            <label class="toggle-label">Featured on Homepage</label>
            <label class="toggle-switch">
              <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $place->is_featured ?? false) ? 'checked' : '' }}>
              <span class="toggle-slider"></span>
            </label>
          </div>
          <div class="form-group" style="margin-top:16px">
            <label class="form-label">Sort Order</label>
            <input type="number" name="sort_order" class="admin-input" value="{{ old('sort_order', $place->sort_order ?? 0) }}" min="0">
          </div>
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;margin-top:16px">
            {{ isset($place) ? '💾 Update Place' : '📍 Add Place' }}
          </button>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-header">Thumbnail Image</div>
        <div class="admin-card-body">
          <div class="image-preview-box" onclick="document.getElementById('thumbnail').click()">
            @if(isset($place) && $place->thumbnail)
            <img src="{{ Storage::url($place->thumbnail) }}" id="thumbPreview" style="width:100%;height:100%;object-fit:cover">
            @else
            <div class="placeholder" id="thumbPlaceholder" style="text-align:center;color:#a0aec0">
              <span style="font-size:40px;display:block;margin-bottom:8px">🖼</span>
              <p>Click to upload</p>
            </div>
            @endif
          </div>
          <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none"
                 onchange="previewImage(this,'thumbPreview','thumbPlaceholder')">
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-header">Gallery Images</div>
        <div class="admin-card-body">
          <label class="form-label">Upload Multiple Images</label>
          <input type="file" name="gallery_images[]" class="admin-input" accept="image/*" multiple>
          <small class="form-help">Hold Ctrl/Cmd to select multiple images</small>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
