@extends('layouts.admin')
@section('title', isset($culture) ? 'Edit Culture Item' : 'Add Culture Item')
@section('breadcrumb') / <a href="{{ route('admin.culture.index') }}">Culture</a> / {{ isset($culture) ? 'Edit' : 'Add' }} @endsection
@section('content')
<div class="page-header">
  <h1 class="page-title">{{ isset($culture) ? 'Edit Culture Item' : 'Add Culture Item' }}</h1>
  <a href="{{ route('admin.culture.index') }}" class="admin-btn admin-btn-ghost">← Back</a>
</div>
<form method="POST" action="{{ isset($culture) ? route('admin.culture.update',$culture) : route('admin.culture.store') }}" enctype="multipart/form-data">
  @csrf @if(isset($culture)) @method('PUT') @endif
  <div class="form-two-col">
    <div class="form-main-col">
      <div class="admin-card">
        <div class="admin-card-header">Details</div>
        <div class="admin-card-body">
          <div class="form-group"><label class="form-label">Title *</label><input type="text" name="title" class="admin-input" value="{{ old('title', $culture->title ?? '') }}" required></div>
          <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
            <div class="form-group"><label class="form-label">Icon (Emoji)</label><input type="text" name="icon" class="admin-input" style="font-size:22px" value="{{ old('icon', $culture->icon ?? '🎭') }}"></div>
            <div class="form-group"><label class="form-label">Category *</label>
              <select name="category" class="admin-input" required>
                @foreach(['festival','music','food','craft','tradition','art'] as $c)
                <option value="{{ $c }}" {{ old('category', $culture->category ?? '') == $c ? 'selected' : '' }}>{{ ucfirst($c) }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group"><label class="form-label">Short Description *</label><textarea name="description" rows="3" class="admin-input" required>{{ old('description', $culture->description ?? '') }}</textarea></div>
          <div class="form-group"><label class="form-label">Full Description</label><textarea name="full_description" rows="6" class="admin-input">{{ old('full_description', $culture->full_description ?? '') }}</textarea></div>
        </div>
      </div>
    </div>
    <div class="form-side-col">
      <div class="admin-card">
        <div class="admin-card-header">Settings</div>
        <div class="admin-card-body">
          <div class="toggle-group"><label class="toggle-label">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $culture->is_active ?? true) ? 'checked' : '' }}><span class="toggle-slider"></span></label></div>
          <div class="form-group" style="margin-top:14px"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="admin-input" value="{{ old('sort_order', $culture->sort_order ?? 0) }}"></div>
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;margin-top:14px">{{ isset($culture) ? '💾 Update' : '+ Add Item' }}</button>
        </div>
      </div>
      <div class="admin-card">
        <div class="admin-card-header">Thumbnail</div>
        <div class="admin-card-body">
          <div class="image-preview-box" onclick="document.getElementById('thumbnail').click()">
            @if(isset($culture) && $culture->thumbnail)<img src="{{ Storage::url($culture->thumbnail) }}" id="thumbPreview" style="width:100%;height:100%;object-fit:cover">@else<div id="thumbPlaceholder" style="text-align:center;color:#a0aec0"><span style="font-size:32px;display:block">🎭</span><p>Upload image</p></div>@endif
          </div>
          <input type="file" name="thumbnail" id="thumbnail" accept="image/*" style="display:none" onchange="previewImage(this,'thumbPreview','thumbPlaceholder')">
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
