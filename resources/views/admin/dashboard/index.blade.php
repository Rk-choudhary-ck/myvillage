@extends('layouts.admin')
@section('title', 'Dashboard')
@section('breadcrumb') / Dashboard @endsection

@section('content')
<div class="page-header">
  <div>
    <h1 class="page-title">Dashboard</h1>
    <p class="page-sub">Welcome back, {{ auth()->user()->name ?? session('admin_user_name') }}! Here's what's happening in Chanan Khera.</p>
  </div>
  <div class="page-actions">
    <a href="{{ route('admin.blogs.create') }}" class="admin-btn admin-btn-primary">+ New Blog Post</a>
    <a href="{{ route('admin.places.create') }}" class="admin-btn admin-btn-secondary">+ Add Place</a>
  </div>
</div>

<!-- Stats Cards -->
<div class="stats-grid">
  <div class="stat-card stat-green">
    <div class="sc-icon">📝</div>
    <div class="sc-body">
      <div class="sc-num">{{ $stats['blogs'] ?? 0 }}</div>
      <div class="sc-label">Blog Posts</div>
      <div class="sc-sub">{{ $stats['published_blogs'] ?? 0 }} published</div>
    </div>
    <div class="sc-trend up">↑ +3 this month</div>
  </div>
  <div class="stat-card stat-blue">
    <div class="sc-icon">📍</div>
    <div class="sc-body">
      <div class="sc-num">{{ $stats['places'] ?? 0 }}</div>
      <div class="sc-label">Famous Places</div>
      <div class="sc-sub">All active</div>
    </div>
    <div class="sc-trend up">↑ +2 this month</div>
  </div>
  <div class="stat-card stat-orange">
    <div class="sc-icon">🖼</div>
    <div class="sc-body">
      <div class="sc-num">{{ $stats['gallery'] ?? 0 }}</div>
      <div class="sc-label">Gallery Images</div>
      <div class="sc-sub">{{ $stats['videos'] ?? 0 }} videos</div>
    </div>
    <div class="sc-trend up">↑ +12 this month</div>
  </div>
  <div class="stat-card stat-purple">
    <div class="sc-icon">👁</div>
    <div class="sc-body">
      <div class="sc-num">{{ number_format($stats['views'] ?? 0) }}</div>
      <div class="sc-label">Total Views</div>
      <div class="sc-sub">Last 30 days</div>
    </div>
    <div class="sc-trend up">↑ 18% increase</div>
  </div>
</div>

<!-- Main Dashboard Grid -->
<div class="dash-grid">
  <!-- Recent Blog Posts -->
  <div class="dash-card">
    <div class="dc-header">
      <h3>Recent Blog Posts</h3>
      <a href="{{ route('admin.blogs.index') }}" class="dc-link">View All →</a>
    </div>
    <div class="dc-body">
      <table class="admin-table">
        <thead>
          <tr>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($recentBlogs ?? [] as $blog)
          <tr>
            <td class="td-title">{{ Str::limit($blog->title, 40) }}</td>
            <td><span class="tag">{{ $blog->category }}</span></td>
            <td>
              <span class="status-badge {{ $blog->is_published ? 'status-green' : 'status-gray' }}">
                {{ $blog->is_published ? 'Published' : 'Draft' }}
              </span>
            </td>
            <td class="td-date">{{ $blog->created_at->format('d M') }}</td>
            <td>
              <div class="table-actions">
                <a href="{{ route('admin.blogs.edit', $blog) }}" class="ta-btn ta-edit">Edit</a>
                <form method="POST" action="{{ route('admin.blogs.destroy', $blog) }}" style="display:inline">
                  @csrf @method('DELETE')
                  <button class="ta-btn ta-del" onclick="return confirm('Delete this post?')">Del</button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr><td colspan="5" class="td-empty">No blog posts yet. <a href="{{ route('admin.blogs.create') }}">Create one →</a></td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <!-- Quick Actions -->
  <div class="dash-card">
    <div class="dc-header"><h3>Quick Actions</h3></div>
    <div class="dc-body">
      <div class="quick-actions">
        <a href="{{ route('admin.blogs.create') }}" class="qa-item">
          <span class="qa-icon">✏️</span>
          <div><strong>Write Blog Post</strong><p>Share a new village story</p></div>
        </a>
        <a href="{{ route('admin.places.create') }}" class="qa-item">
          <span class="qa-icon">📍</span>
          <div><strong>Add Famous Place</strong><p>Add new location with images</p></div>
        </a>
        <a href="{{ route('admin.gallery.index') }}" class="qa-item">
          <span class="qa-icon">📸</span>
          <div><strong>Upload Photos</strong><p>Add to village gallery</p></div>
        </a>
        <a href="{{ route('admin.videos.create') }}" class="qa-item">
          <span class="qa-icon">🎬</span>
          <div><strong>Add Video</strong><p>YouTube link or upload file</p></div>
        </a>
        <a href="{{ route('admin.culture.create') }}" class="qa-item">
          <span class="qa-icon">🎭</span>
          <div><strong>Add Culture Item</strong><p>Festival, craft, food or dance</p></div>
        </a>
        <a href="{{ route('admin.settings') }}" class="qa-item">
          <span class="qa-icon">⚙️</span>
          <div><strong>Site Settings</strong><p>Update village info & contact</p></div>
        </a>
      </div>
    </div>
  </div>

  <!-- Recent Places -->
  <div class="dash-card">
    <div class="dc-header">
      <h3>Famous Places</h3>
      <a href="{{ route('admin.places.index') }}" class="dc-link">Manage →</a>
    </div>
    <div class="dc-body">
      <div class="place-list-admin">
        @forelse($recentPlaces ?? [] as $place)
        <div class="pla-item">
          <div class="pla-icon">{{ $place->icon ?? '📍' }}</div>
          <div class="pla-info">
            <div class="pla-name">{{ $place->name }}</div>
            <div class="pla-cat">{{ $place->category }}</div>
          </div>
          <div class="pla-actions">
            <a href="{{ route('admin.places.edit', $place) }}" class="ta-btn ta-edit">Edit</a>
          </div>
        </div>
        @empty
        <div class="empty-state">
          <span>📍</span>
          <p>No places added yet.<br><a href="{{ route('admin.places.create') }}">Add first place →</a></p>
        </div>
        @endforelse
      </div>
    </div>
  </div>

  <!-- Gallery Preview -->
  <div class="dash-card">
    <div class="dc-header">
      <h3>Recent Gallery</h3>
      <a href="{{ route('admin.gallery.index') }}" class="dc-link">Manage →</a>
    </div>
    <div class="dc-body">
      <div class="gallery-admin-grid">
        @forelse($recentGallery ?? [] as $img)
        <div class="gag-item">
          <img src="{{ Storage::url($img->image_path) }}" alt="{{ $img->title }}">
          <div class="gag-overlay">
            <a href="{{ route('admin.gallery.destroy', $img) }}" class="gag-del">🗑</a>
          </div>
        </div>
        @empty
        @for($i=0; $i<6; $i++)
        <div class="gag-item gag-empty"><span>📸</span></div>
        @endfor
        @endforelse
      </div>
      <a href="{{ route('admin.gallery.index') }}" class="admin-btn admin-btn-secondary" style="margin-top:16px; display:block; text-align:center">+ Upload Photos</a>
    </div>
  </div>
</div>
@endsection
