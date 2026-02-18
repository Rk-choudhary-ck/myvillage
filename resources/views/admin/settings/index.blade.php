@extends('layouts.admin')
@section('title','Site Settings')
@section('breadcrumb') / Settings @endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Site Settings</h1>
    <p class="page-sub">Manage village information and website content</p>
  </div>
  <form method="POST" action="{{ route('admin.settings.clear-cache') }}">
    @csrf
    <button class="admin-btn admin-btn-secondary">🔄 Clear Cache</button>
  </form>
</div>

<form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
  @csrf

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px">

    <!-- General Settings -->
    <div class="admin-card">
      <div class="admin-card-header">🏡 General Information</div>
      <div class="admin-card-body">
        @foreach([
          ['village_name','Village Name','text'],
          ['village_tagline','Tagline','text'],
          ['village_description','Village Description','textarea'],
        ] as [$key, $label, $type])
        <div class="form-group">
          <label class="form-label">{{ $label }}</label>
          @if($type === 'textarea')
          <textarea name="{{ $key }}" rows="3" class="admin-input">{{ $settings[$key]->value ?? '' }}</textarea>
          @else
          <input type="{{ $type }}" name="{{ $key }}" class="admin-input" value="{{ $settings[$key]->value ?? '' }}">
          @endif
        </div>
        @endforeach
      </div>
    </div>

    <!-- Contact Settings -->
    <div class="admin-card">
      <div class="admin-card-header">📞 Contact Information</div>
      <div class="admin-card-body">
        @foreach([
          ['contact_email','Email Address','email'],
          ['contact_phone','Phone Number','text'],
          ['contact_address','Village Address','text'],
        ] as [$key, $label, $type])
        <div class="form-group">
          <label class="form-label">{{ $label }}</label>
          <input type="{{ $type }}" name="{{ $key }}" class="admin-input" value="{{ $settings[$key]->value ?? '' }}">
        </div>
        @endforeach
      </div>
    </div>

    <!-- Social Links -->
    <div class="admin-card">
      <div class="admin-card-header">🌐 Social Media Links</div>
      <div class="admin-card-body">
        @foreach([
          ['facebook_url','Facebook URL'],
          ['instagram_url','Instagram URL'],
          ['youtube_url','YouTube URL'],
        ] as [$key, $label])
        <div class="form-group">
          <label class="form-label">{{ $label }}</label>
          <input type="url" name="{{ $key }}" class="admin-input" value="{{ $settings[$key]->value ?? '' }}" placeholder="https://...">
        </div>
        @endforeach
      </div>
    </div>

    <!-- Stats -->
    <div class="admin-card">
      <div class="admin-card-header">📊 Village Statistics</div>
      <div class="admin-card-body">
        @foreach([
          ['total_residents','Total Residents'],
          ['years_history','Years of History'],
          ['annual_festivals','Annual Festivals'],
          ['famous_places','Famous Places Count'],
        ] as [$key, $label])
        <div class="form-group">
          <label class="form-label">{{ $label }}</label>
          <input type="number" name="{{ $key }}" class="admin-input" value="{{ $settings[$key]->value ?? '' }}">
        </div>
        @endforeach
      </div>
    </div>

  </div>

  <div style="text-align:right;margin-top:24px">
    <button type="submit" class="admin-btn admin-btn-primary" style="padding:12px 40px;font-size:15px">
      💾 Save All Settings
    </button>
  </div>
</form>
@endsection
