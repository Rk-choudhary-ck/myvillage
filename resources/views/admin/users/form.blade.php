@extends('layouts.admin')
@section('title', isset($user) ? 'Edit User' : 'Add Admin User')
@section('breadcrumb') / <a href="{{ route('admin.users.index') }}">Users</a> / {{ isset($user) ? 'Edit' : 'Add' }} @endsection

@section('content')
<div class="page-header">
  <h1 class="page-title">{{ isset($user) ? 'Edit: '.$user->name : 'Add Admin User' }}</h1>
  <a href="{{ route('admin.users.index') }}" class="admin-btn admin-btn-ghost">← Back</a>
</div>

<div style="max-width:600px">
  <form method="POST"
        action="{{ isset($user) ? route('admin.users.update', $user) : route('admin.users.store') }}"
        enctype="multipart/form-data">
    @csrf
    @if(isset($user)) @method('PUT') @endif

    <div class="admin-card">
      <div class="admin-card-header">User Details</div>
      <div class="admin-card-body">
        <div class="form-group">
          <label class="form-label">Full Name *</label>
          <input type="text" name="name" class="admin-input @error('name') is-invalid @enderror"
                 value="{{ old('name', $user->name ?? '') }}" required>
          @error('name')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Email Address *</label>
          <input type="email" name="email" class="admin-input @error('email') is-invalid @enderror"
                 value="{{ old('email', $user->email ?? '') }}" required>
          @error('email')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Role *</label>
          <select name="role" class="admin-input" required>
            <option value="editor" {{ old('role', $user->role ?? '') == 'editor' ? 'selected' : '' }}>Editor — Blogs & Media only</option>
            <option value="admin" {{ old('role', $user->role ?? '') == 'admin' ? 'selected' : '' }}>Admin — All content</option>
            <option value="super_admin" {{ old('role', $user->role ?? '') == 'super_admin' ? 'selected' : '' }}>Super Admin — Full access</option>
          </select>
        </div>
        <div class="form-group">
          <label class="form-label">Password {{ isset($user) ? '(leave blank to keep)' : '*' }}</label>
          <input type="password" name="password" class="admin-input @error('password') is-invalid @enderror"
                 {{ !isset($user) ? 'required' : '' }} placeholder="Min 8 characters">
          @error('password')<div class="form-error">{{ $message }}</div>@enderror
        </div>
        <div class="form-group">
          <label class="form-label">Confirm Password</label>
          <input type="password" name="password_confirmation" class="admin-input" placeholder="Repeat password">
        </div>
        <div class="toggle-group">
          <label class="toggle-label">Account Active</label>
          <label class="toggle-switch">
            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $user->is_active ?? true) ? 'checked' : '' }}>
            <span class="toggle-slider"></span>
          </label>
        </div>
        <button type="submit" class="admin-btn admin-btn-primary" style="width:100%;margin-top:20px">
          {{ isset($user) ? '💾 Update User' : '👤 Create User' }}
        </button>
      </div>
    </div>
  </form>
</div>
@endsection
