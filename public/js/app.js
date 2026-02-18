/* Chanan Khera — Frontend JS */

// ── INIT AOS ──
AOS.init({ duration: 900, once: true, offset: 60, easing: 'ease-out-cubic' });

// ── CUSTOM CURSOR ──
const dot = document.getElementById('cursorDot');
const ring = document.getElementById('cursorRing');
if (dot && ring) {
  let rx = 0, ry = 0;
  document.addEventListener('mousemove', e => {
    dot.style.left = e.clientX + 'px';
    dot.style.top = e.clientY + 'px';
    rx += (e.clientX - rx) * 0.12;
    ry += (e.clientY - ry) * 0.12;
    ring.style.left = rx + 'px';
    ring.style.top = ry + 'px';
  });
  setInterval(() => {
    ring.style.left = (parseFloat(ring.style.left) || 0) * 0.88 + '?px';
  }, 16);
  document.addEventListener('mousemove', () => {
    cancelAnimationFrame(window._ringRaf);
    function step() {
      rx += (parseFloat(dot.style.left) - rx) * 0.12;
      ry += (parseFloat(dot.style.top) - ry) * 0.12;
      ring.style.left = rx + 'px';
      ring.style.top = ry + 'px';
      window._ringRaf = requestAnimationFrame(step);
    }
    step();
  }, { once: true });

  document.querySelectorAll('a, button, .place-tile, .act-card, .blog-card, .benefit-card, .culture-card, .swiper-button-prev, .swiper-button-next').forEach(el => {
    el.addEventListener('mouseenter', () => document.body.classList.add('cursor-hover'));
    el.addEventListener('mouseleave', () => document.body.classList.remove('cursor-hover'));
  });
}

// ── PAGE LOADER ──
window.addEventListener('load', () => {
  setTimeout(() => {
    const loader = document.getElementById('loader');
    if (loader) loader.classList.add('hidden');
  }, 1800);
});

// ── NAVIGATION ──
const nav = document.getElementById('mainNav');
const navToggle = document.getElementById('navToggle');
const navMenu = document.getElementById('navMenu');

if (nav) {
  window.addEventListener('scroll', () => {
    nav.classList.toggle('scrolled', window.scrollY > 80);
  }, { passive: true });
}

if (navToggle && navMenu) {
  navToggle.addEventListener('click', () => {
    navMenu.classList.toggle('open');
    navToggle.classList.toggle('open');
  });
}

// ── BACK TO TOP ──
const btt = document.getElementById('backToTop');
if (btt) {
  window.addEventListener('scroll', () => {
    btt.classList.toggle('visible', window.scrollY > 400);
  }, { passive: true });
  btt.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
}

// ── GSAP SCROLL ANIMATIONS ──
if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
  gsap.registerPlugin(ScrollTrigger);

  // Staggered section entries
  gsap.utils.toArray('.benefit-card').forEach((card, i) => {
    gsap.from(card, {
      scrollTrigger: { trigger: card, start: 'top 85%' },
      y: 40, opacity: 0, duration: 0.7, delay: i * 0.08, ease: 'power2.out'
    });
  });

  // Parallax on place tiles
  gsap.utils.toArray('.tile-bg').forEach(tile => {
    gsap.to(tile, {
      scrollTrigger: { trigger: tile, scrub: true },
      y: -30
    });
  });
}

// ── SMOOTH INTERNAL LINKS ──
document.querySelectorAll('a[href^="#"]').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault();
    const target = document.querySelector(a.getAttribute('href'));
    if (target) target.scrollIntoView({ behavior: 'smooth', block: 'start' });
  });
});

// ── ACTIVE NAV LINK ON SCROLL ──
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-menu a');
if (sections.length && navLinks.length) {
  const obs = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        navLinks.forEach(l => l.classList.remove('active'));
        const link = document.querySelector(`.nav-menu a[href="#${entry.target.id}"]`);
        if (link) link.classList.add('active');
      }
    });
  }, { threshold: 0.4 });
  sections.forEach(s => obs.observe(s));
}
