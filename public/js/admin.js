/* Chanan Khera — Admin JS */

// ── SIDEBAR TOGGLE ──
const sidebar = document.getElementById('adminSidebar');
const sidebarToggle = document.getElementById('sidebarToggle');
const sidebarClose = document.getElementById('sidebarClose');
const adminMain = document.getElementById('adminMain');

if (sidebarToggle && sidebar) {
  sidebarToggle.addEventListener('click', () => {
    sidebar.classList.toggle('open');
  });
}
if (sidebarClose && sidebar) {
  sidebarClose.addEventListener('click', () => sidebar.classList.remove('open'));
}

// ── LIVE CLOCK ──
const timeEl = document.getElementById('topbarTime');
if (timeEl) {
  function updateClock() {
    const now = new Date();
    timeEl.textContent = now.toLocaleTimeString('en-IN', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
  }
  updateClock();
  setInterval(updateClock, 1000);
}

// ── AUTO-DISMISS ALERTS ──
document.querySelectorAll('.alert').forEach(alert => {
  setTimeout(() => {
    alert.style.transition = 'opacity 0.5s, transform 0.5s';
    alert.style.opacity = '0';
    alert.style.transform = 'translateY(-10px)';
    setTimeout(() => alert.remove(), 500);
  }, 4000);
});

// ── IMAGE PREVIEW HELPER ──
window.previewImage = function(input, previewId, placeholderId) {
  if (input.files && input.files[0]) {
    const reader = new FileReader();
    reader.onload = function(e) {
      let preview = document.getElementById(previewId);
      const box = input.closest('.image-preview-box');
      if (!preview) {
        preview = document.createElement('img');
        preview.id = previewId;
        preview.style.cssText = 'width:100%;height:100%;object-fit:cover;';
        if (box) { box.innerHTML = ''; box.appendChild(preview); }
      }
      preview.src = e.target.result;
      const ph = document.getElementById(placeholderId);
      if (ph) ph.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
  }
};

// ── SLUG AUTO-GENERATE ──
const titleInput = document.querySelector('input[name="title"]');
const slugInput = document.querySelector('input[name="slug"]');
if (titleInput && slugInput) {
  titleInput.addEventListener('input', () => {
    if (!slugInput.dataset.manual) {
      slugInput.value = titleInput.value
        .toLowerCase()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim();
    }
  });
  slugInput.addEventListener('input', () => { slugInput.dataset.manual = true; });
}

// ── CONFIRM DELETE ──
document.querySelectorAll('form [class*="ta-del"], form [class*="btn-danger"]').forEach(btn => {
  btn.addEventListener('click', e => {
    if (!confirm('Are you sure you want to delete this item? This cannot be undone.')) {
      e.preventDefault();
    }
  });
});

// ── BULK SELECT TABLE ──
const selectAll = document.getElementById('selectAll');
if (selectAll) {
  selectAll.addEventListener('change', () => {
    document.querySelectorAll('input[name="selected[]"]').forEach(cb => {
      cb.checked = selectAll.checked;
    });
  });
}

// ── IMAGE UPLOAD DRAG & DROP ──
document.querySelectorAll('.image-preview-box').forEach(box => {
  box.addEventListener('dragover', e => { e.preventDefault(); box.style.borderColor = '#2d8a1a'; });
  box.addEventListener('dragleave', () => { box.style.borderColor = ''; });
  box.addEventListener('drop', e => {
    e.preventDefault();
    box.style.borderColor = '';
    const input = box.nextElementSibling;
    if (input && input.type === 'file' && e.dataTransfer.files.length) {
      input.files = e.dataTransfer.files;
      input.dispatchEvent(new Event('change'));
    }
  });
});
