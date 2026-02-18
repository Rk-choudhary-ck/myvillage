@extends('layouts.admin')
@section('title', isset($activity) ? 'Edit Activity' : 'Add Activity')
@section('breadcrumb') / <a href="{{ route('admin.activities.index') }}">Activities</a> / {{ isset($activity) ? 'Edit' : 'Add' }} @endsection
@section('content')
<div class="page-header">
  <h1 class="page-title">{{ isset($activity) ? 'Edit Activity' : 'Add Activity' }}</h1>
  <a href="{{ route('admin.activities.index') }}" class="admin-btn admin-btn-ghost">← Back</a>
</div>
<form method="POST" action="{{ isset($activity) ? route('admin.activities.update',$activity) : route('admin.activities.store') }}" enctype="multipart/form-data">
  @csrf @if(isset($activity)) @method('PUT') @endif
  <div class="form-two-col">
    <div class="form-main-col">
      <div class="admin-card">
        <div class="admin-card-header">Details</div>
        <div class="admin-card-body">
          <div class="form-group"><label class="form-label">Activity Name *</label><input type="text" name="name" class="admin-input" value="{{ old('name', $activity->name ?? '') }}" required></div>
          <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:16px">
            <div class="form-group"><label class="form-label">Icon (Emoji)</label><input type="text" name="icon" class="admin-input" style="font-size:22px" value="{{ old('icon', $activity->icon ?? '🎯') }}"></div>
            <div class="form-group"><label class="form-label">Category</label>
              <select name="category" class="admin-input">
                @foreach(['Sport','Farming','Tour','Festival','Water','Art','Music'] as $c)
                <option value="{{ $c }}" {{ old('category', $activity->category ?? '') == $c ? 'selected' : '' }}>{{ $c }}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group"><label class="form-label">Season</label>
              <select name="season" class="admin-input">
                @foreach(['All Year','Summer','Winter','Monsoon','Spring','Harvest'] as $s)
                <option value="{{ $s }}" {{ old('season', $activity->season ?? 'All Year') == $s ? 'selected' : '' }}>{{ $s }}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group"><label class="form-label">Description *</label><textarea name="description" rows="4" class="admin-input" required>{{ old('description', $activity->description ?? '') }}</textarea></div>
        </div>
      </div>
    </div>
    <div class="form-side-col">
      <div class="admin-card">
        <div class="admin-card-header">Settings</div>
        <div class="admin-card-body">
          <div class="toggle-group"><label class="toggle-label">Active</label><label class="toggle-switch"><input type="checkbox" name="is_active" value="1" {{ old('is_active', $activity->is_active ?? true) ? 'checked' : '' }}><span class="toggle-slider"></span></label></div>
          <div class="form-group" style="margin-top:14px"><label class="form-label">Sort Order</label><input type="number" name="sort_order" class="admin-input" value="{{ old('sort_order', $activity->sort_order ?? 0) }}"></div>
          <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;margin-top:14px">{{ isset($activity) ? '💾 Update' : '+ Add Activity' }}</button>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection
