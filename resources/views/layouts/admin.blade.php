<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Admin Panel') — Chanan Khera</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Yeseva+One&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@yield('styles')
</head>
<body class="admin-body">

<!-- Sidebar -->
<aside class="admin-sidebar" id="adminSidebar">
  <div class="sidebar-header">
    <div class="sidebar-logo">
      <span class="sl-icon">🏡</span>
      <div>
        <div class="sl-name">Chanan Khera</div>
        <div class="sl-sub">Admin Panel</div>
      </div>
    </div>
    <button class="sidebar-close" id="sidebarClose">✕</button>
  </div>

  <div class="sidebar-admin-info">
    <div class="admin-avatar">{{ strtoupper(substr(session('admin_user_name', 'A'), 0, 2)) }}</div>
    <div>
      <div class="admin-name">{{ session('admin_user_name', 'Admin') }}</div>
      <div class="admin-role">{{ ucfirst(str_replace('_',' ', session('admin_user_role', 'Administrator'))) }}</div>
    </div>
  </div>

  <nav class="sidebar-nav">
    <div class="nav-section-label">Main</div>
    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <span class="link-icon">📊</span> Dashboard
    </a>

    <div class="nav-section-label">Content</div>
    <a href="{{ route('admin.blogs.index') }}" class="sidebar-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
      <span class="link-icon">📝</span> Blog Posts
      @if($pendingBlogs ?? 0 > 0)<span class="badge">{{ $pendingBlogs }}</span>@endif
    </a>
    <a href="{{ route('admin.places.index') }}" class="sidebar-link {{ request()->routeIs('admin.places.*') ? 'active' : '' }}">
      <span class="link-icon">📍</span> Famous Places
    </a>
    <a href="{{ route('admin.culture.index') }}" class="sidebar-link {{ request()->routeIs('admin.culture.*') ? 'active' : '' }}">
      <span class="link-icon">🎭</span> Culture & Festivals
    </a>
    <a href="{{ route('admin.activities.index') }}" class="sidebar-link {{ request()->routeIs('admin.activities.*') ? 'active' : '' }}">
      <span class="link-icon">🏏</span> Activities & Games
    </a>

    <div class="nav-section-label">Media</div>
    <a href="{{ route('admin.gallery.index') }}" class="sidebar-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}">
      <span class="link-icon">🖼</span> Photo Gallery
    </a>
    <a href="{{ route('admin.videos.index') }}" class="sidebar-link {{ request()->routeIs('admin.videos.*') ? 'active' : '' }}">
      <span class="link-icon">🎬</span> Videos
    </a>

    <div class="nav-section-label">System</div>
    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
      <span class="link-icon">👥</span> Users & Admins
    </a>
    <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
      <span class="link-icon">⚙️</span> Site Settings
    </a>
    <a href="{{ route('admin.slider.index') }}" class="sidebar-link {{ request()->routeIs('admin.slider.*') ? 'active' : '' }}">
      <span class="link-icon">🖥</span> Hero Slider
    </a>

    <div class="sidebar-divider"></div>
    <a href="{{ route('home') }}" class="sidebar-link" target="_blank">
      <span class="link-icon">🌐</span> View Website
    </a>
    <form method="POST" action="{{ route('admin.logout') }}">
      @csrf
      <button type="submit" class="sidebar-link sidebar-logout">
        <span class="link-icon">🚪</span> Logout
      </button>
    </form>
  </nav>
</aside>

<!-- Main Admin Area -->
<div class="admin-main" id="adminMain">
  <!-- Top Bar -->
  <header class="admin-topbar">
    <div class="topbar-left">
      <button class="sidebar-toggle" id="sidebarToggle">☰</button>
      <div class="breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Home</a>
        @yield('breadcrumb')
      </div>
    </div>
    <div class="topbar-right">
      <div class="topbar-time" id="topbarTime"></div>
      <div class="topbar-notifications">
        <button class="notif-btn">🔔 <span class="notif-count">3</span></button>
      </div>
      <div class="topbar-user">
        <div class="topbar-avatar">{{ strtoupper(substr(session('admin_user_name', 'A'), 0, 1)) }}</div>
        <span>{{ session('admin_user_name', 'Admin') }}</span>
      </div>
    </div>
  </header>

  <!-- Page Content -->
  <div class="admin-content">
    @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif

    @yield('content')
  </div>
</div>

<script src="{{ asset('js/admin.js') }}"></script>
@yield('scripts')
</body>
</html>
