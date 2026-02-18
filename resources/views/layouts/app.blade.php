<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Chanan Khera - Village of Heritage & Life')</title>
<meta name="description" content="@yield('meta_description', 'Discover Chanan Khera – a village of rich culture, stunning nature, ancient traditions and warm community spirit.')">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Yeseva+One&family=Josefin+Sans:wght@300;400;600&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">

<!-- Swiper CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<!-- AOS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@yield('styles')
</head>
<body>

<!-- Page Loader -->
<div id="loader">
  <div class="loader-inner">
    <div class="loader-logo">ਚਾਨਣ ਖੇੜਾ</div>
    <div class="loader-text">Chanan Khera</div>
    <div class="loader-bar"><div class="loader-fill"></div></div>
  </div>
</div>

<!-- Custom Cursor -->
<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- Navigation -->
<nav id="mainNav">
  <div class="nav-container">
    <a href="{{ route('home') }}" class="nav-brand">
      <span class="brand-punjabi">ਚਾਨਣ ਖੇੜਾ</span>
      <span class="brand-english">Chanan Khera</span>
    </a>
    <ul class="nav-menu" id="navMenu">
      <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
      <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Village</a></li>
      <li class="has-dropdown">
        <a href="{{ route('places.index') }}">Explore <span class="chevron">▾</span></a>
        <ul class="dropdown">
          <li><a href="{{ route('places.index') }}">Famous Places</a></li>
          <li><a href="{{ route('gallery.index') }}">Photo Gallery</a></li>
          <li><a href="{{ route('videos.index') }}">Videos</a></li>
        </ul>
      </li>
      <li class="has-dropdown">
        <a href="#">Culture <span class="chevron">▾</span></a>
        <ul class="dropdown">
          <li><a href="{{ route('culture.index') }}">Traditions</a></li>
          <li><a href="{{ route('activities.index') }}">Activities & Games</a></li>
          <li><a href="{{ route('benefits.index') }}">Village Benefits</a></li>
        </ul>
      </li>
      <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Stories</a></li>
      <li><a href="{{ route('contact') }}">Contact</a></li>
    </ul>
    <div class="nav-actions">
      <a href="{{ route('admin.dashboard') }}" class="nav-admin-btn">⚙ Admin</a>
      <button class="nav-toggle" id="navToggle" aria-label="Toggle menu">
        <span></span><span></span><span></span>
      </button>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main>@yield('content')</main>

<!-- Footer -->
<footer id="mainFooter">
  <div class="footer-wave">
    <svg viewBox="0 0 1440 100" preserveAspectRatio="none"><path d="M0,60 C360,100 1080,0 1440,60 L1440,100 L0,100 Z" fill="#0f1a0a"/></svg>
  </div>
  <div class="footer-body">
    <div class="footer-grid">
      <div class="footer-brand-col">
        <div class="footer-logo">
          <span class="f-punjabi">ਚਾਨਣ ਖੇੜਾ</span>
          <span class="f-english">Chanan Khera</span>
        </div>
        <p>A timeless village where nature whispers ancient stories and every sunrise paints a new chapter of life, community, and belonging.</p>
        <div class="footer-socials">
          <a href="#" aria-label="Facebook">𝔽</a>
          <a href="#" aria-label="Instagram">𝕀</a>
          <a href="#" aria-label="YouTube">𝕐</a>
        </div>
      </div>
      <div>
        <h4>Explore</h4>
        <ul>
          <li><a href="{{ route('places.index') }}">Famous Places</a></li>
          <li><a href="{{ route('gallery.index') }}">Photo Gallery</a></li>
          <li><a href="{{ route('videos.index') }}">Videos</a></li>
          <li><a href="{{ route('culture.index') }}">Culture & Traditions</a></li>
          <li><a href="{{ route('activities.index') }}">Activities & Games</a></li>
        </ul>
      </div>
      <div>
        <h4>Village</h4>
        <ul>
          <li><a href="{{ route('about') }}">About Chanan Khera</a></li>
          <li><a href="{{ route('blog.index') }}">Village Stories</a></li>
          <li><a href="{{ route('benefits.index') }}">Benefits of Village</a></li>
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
        </ul>
      </div>
      <div>
        <h4>Contact</h4>
        <div class="footer-contact">
          <p>📍 Chanan Khera Village,<br>Punjab, India</p>
          <p>📞 +91 XXXXX XXXXX</p>
          <p>✉ info@chanankhera.in</p>
        </div>
        <div class="footer-weather" id="footerWeather">
          <span>🌤 Punjab Weather</span>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <p>© {{ date('Y') }} Chanan Khera Village. Made with ♥ for our community.</p>
      <p><a href="{{ route('admin.login') }}">Admin Login</a> · <a href="#">Privacy</a></p>
    </div>
  </div>
</footer>

<!-- Back to Top -->
<button id="backToTop" aria-label="Back to top">↑</button>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
