@extends('layouts.admin')
@section('title', isset($slider) ? 'Edit Slide' : 'Add New Slide')
@section('breadcrumb')
    / <a href="{{ route('admin.slider.index') }}">Hero Slider</a>
    / {{ isset($slider) ? 'Edit' : 'Add New Slide' }}
@endsection

@section('styles')
<style>
.gradient-picker {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    margin-top: 10px;
}
.gradient-swatch {
    height: 56px;
    border-radius: 8px;
    cursor: pointer;
    border: 3px solid transparent;
    transition: border-color 0.2s, transform 0.2s;
    display: flex; align-items: center; justify-content: center;
    font-size: 10px; color: white; font-weight: 600;
    letter-spacing: 0.5px; text-align: center; padding: 4px;
}
.gradient-swatch:hover { transform: scale(1.05); }
.gradient-swatch.selected { border-color: #1a5c10; }
.live-preview {
    width: 100%;
    aspect-ratio: 16/7;
    border-radius: 12px;
    position: relative;
    overflow: hidden;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.4s;
}
.live-preview .preview-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.55) 0%, rgba(0,0,0,0.25) 60%, rgba(0,0,0,0.45) 100%);
}
.live-preview .preview-content {
    position: relative; z-index: 1;
    text-align: center; color: white; padding: 20px;
}
.live-preview .preview-content .pv-tag {
    font-size: 10px; letter-spacing: 4px; text-transform: uppercase;
    color: #d4a843; margin-bottom: 8px;
}
.live-preview .preview-content .pv-title {
    font-family: 'Yeseva One', serif;
    font-size: clamp(18px, 3vw, 28px); line-height: 1.1;
}
.live-preview .preview-content .pv-sub {
    font-size: 12px; opacity: 0.75; margin-top: 8px;
}
.live-preview .preview-content .pv-btns {
    display: flex; gap: 8px; justify-content: center; margin-top: 12px;
}
.live-preview .preview-content .pv-btn {
    padding: 6px 16px; border-radius: 4px;
    font-size: 10px; font-weight: 700; letter-spacing: 1px;
}
.pv-btn-gold { background: #d4a843; color: #0a2a05; }
.pv-btn-outline { border: 1.5px solid rgba(255,255,255,0.6); color: white; background: transparent; }
.preview-img {
    position: absolute; inset: 0; width: 100%; height: 100%;
    object-fit: cover; z-index: 0;
}
</style>
@endsection

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">{{ isset($slider) ? 'Edit Slide' : 'Add New Slide' }}</h1>
        <p class="page-sub">{{ isset($slider) ? 'Update slide details and image' : 'Create a new hero slider slide' }}</p>
    </div>
    <a href="{{ route('admin.slider.index') }}" class="admin-btn admin-btn-ghost">← Back to Slides</a>
</div>

<form method="POST"
      action="{{ isset($slider) ? route('admin.slider.update', $slider) : route('admin.slider.store') }}"
      enctype="multipart/form-data"
      id="sliderForm">
    @csrf
    @if(isset($slider)) @method('PUT') @endif

    <div class="form-two-col">

        {{-- ── MAIN COLUMN ── --}}
        <div class="form-main-col">

            {{-- Live Preview --}}
            <div class="admin-card">
                <div class="admin-card-header">🖥️ Live Preview</div>
                <div class="admin-card-body">
                    <div class="live-preview" id="livePreview"
                         style="background: {{ old('gradient', $slider->gradient ?? 'linear-gradient(135deg, #0a2a05 0%, #1a5c10 50%, #2d8a1a 100%)') }}">
                        @if(isset($slider) && $slider->image)
                        <img src="{{ Storage::url($slider->image) }}" class="preview-img" id="previewImg">
                        @else
                        <img src="" class="preview-img" id="previewImg" style="display:none">
                        @endif
                        <div class="preview-overlay"></div>
                        <div class="preview-content">
                            <div class="pv-tag">✦ Chanan Khera ✦</div>
                            <div class="pv-title" id="pvTitle">{{ old('title', $slider->title ?? 'Your Slide Title') }}</div>
                            <div class="pv-sub" id="pvSub">{{ old('subtitle', $slider->subtitle ?? 'Slide subtitle will appear here') }}</div>
                            <div class="pv-btns">
                                <span class="pv-btn pv-btn-gold" id="pvBtn1">{{ old('button_text', $slider->button_text ?? 'Explore') }}</span>
                                <span class="pv-btn pv-btn-outline" id="pvBtn2">{{ old('button2_text', $slider->button2_text ?? 'Learn More') }}</span>
                            </div>
                        </div>
                    </div>
                    <p style="font-size:11px;color:#9ca3af;text-align:center;margin-top:10px;">
                        Preview updates as you type ↑
                    </p>
                </div>
            </div>

            {{-- Slide Text --}}
            <div class="admin-card">
                <div class="admin-card-header">📝 Slide Content</div>
                <div class="admin-card-body">
                    <div class="form-group">
                        <label class="form-label">Slide Title *</label>
                        <input type="text" name="title" id="titleInput"
                               class="admin-input @error('title') is-invalid @enderror"
                               value="{{ old('title', $slider->title ?? '') }}"
                               placeholder="e.g., Where Fields Sing at Dawn"
                               required maxlength="150">
                        @error('title')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Subtitle / Description</label>
                        <textarea name="subtitle" id="subtitleInput" rows="3"
                                  class="admin-input @error('subtitle') is-invalid @enderror"
                                  placeholder="A short line shown below the title on the slide"
                                  maxlength="300">{{ old('subtitle', $slider->subtitle ?? '') }}</textarea>
                        @error('subtitle')<div class="form-error">{{ $message }}</div>@enderror
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div class="form-group">
                            <label class="form-label">Button 1 Text</label>
                            <input type="text" name="button_text" id="btn1Text"
                                   class="admin-input"
                                   value="{{ old('button_text', $slider->button_text ?? '') }}"
                                   placeholder="Explore Village">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Button 1 URL</label>
                            <input type="text" name="button_url"
                                   class="admin-input"
                                   value="{{ old('button_url', $slider->button_url ?? '') }}"
                                   placeholder="/places">
                        </div>
                    </div>

                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                        <div class="form-group">
                            <label class="form-label">Button 2 Text</label>
                            <input type="text" name="button2_text" id="btn2Text"
                                   class="admin-input"
                                   value="{{ old('button2_text', $slider->button2_text ?? '') }}"
                                   placeholder="Our Story">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Button 2 URL</label>
                            <input type="text" name="button2_url"
                                   class="admin-input"
                                   value="{{ old('button2_url', $slider->button2_url ?? '') }}"
                                   placeholder="/about">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Background --}}
            <div class="admin-card">
                <div class="admin-card-header">🎨 Background</div>
                <div class="admin-card-body">

                    <div class="form-group">
                        <label class="form-label">Background Image <span style="color:#9ca3af">(recommended: 1920×900px)</span></label>
                        <div class="image-preview-box" onclick="document.getElementById('bgImage').click()"
                             style="aspect-ratio:16/6; cursor:pointer;">
                            @if(isset($slider) && $slider->image)
                                <img src="{{ Storage::url($slider->image) }}" id="bgThumb"
                                     style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <div id="bgPlaceholder" style="text-align:center;color:#a0aec0;padding:20px">
                                    <span style="font-size:36px;display:block;margin-bottom:8px">🖼️</span>
                                    <p>Click or drag to upload background image</p>
                                    <small>JPEG, PNG, WebP — Max 8MB</small>
                                </div>
                            @endif
                        </div>
                        <input type="file" name="image" id="bgImage" accept="image/*" style="display:none"
                               onchange="onImageUpload(this)">
                        @if(isset($slider) && $slider->image)
                        <label style="display:flex;align-items:center;gap:8px;margin-top:8px;font-size:13px;color:#6b7280;cursor:pointer;">
                            <input type="checkbox" name="remove_image" value="1"> Remove current image (use gradient instead)
                        </label>
                        @endif
                    </div>

                    <div style="margin: 16px 0; text-align:center; color:#9ca3af; font-size:12px; font-weight:600; letter-spacing:2px; text-transform:uppercase;">
                        — OR USE GRADIENT BACKGROUND —
                    </div>

                    <div class="form-group">
                        <label class="form-label">Choose Gradient Preset</label>
                        <div class="gradient-picker" id="gradientPicker">
                            @php
                            $gradients = [
                                ['label'=>'Forest Green',  'value'=>'linear-gradient(135deg, #0a2a05 0%, #1a5c10 50%, #2d8a1a 100%)'],
                                ['label'=>'Deep Ocean',    'value'=>'linear-gradient(135deg, #0a1525 0%, #0f3060 40%, #1a5c8a 100%)'],
                                ['label'=>'Golden Harvest','value'=>'linear-gradient(135deg, #3d2b1f 0%, #8b5e3c 40%, #c9a96e 100%)'],
                                ['label'=>'Midnight Blue', 'value'=>'linear-gradient(135deg, #0a0a2a 0%, #1a1a6a 50%, #2a2a9a 100%)'],
                                ['label'=>'Warm Sunset',   'value'=>'linear-gradient(135deg, #4a0a0a 0%, #8a2a00 40%, #c96a00 100%)'],
                                ['label'=>'Sage Garden',   'value'=>'linear-gradient(135deg, #1a2a0a 0%, #4a7c2f 50%, #6b8c5c 100%)'],
                                ['label'=>'Royal Purple',  'value'=>'linear-gradient(135deg, #1a0a2a 0%, #4a1a8a 50%, #6a2aaa 100%)'],
                                ['label'=>'Earth Brown',   'value'=>'linear-gradient(135deg, #1a0a00 0%, #5c2a00 40%, #8a5a1a 100%)'],
                            ];
                            $currentGradient = old('gradient', $slider->gradient ?? $gradients[0]['value']);
                            @endphp
                            @foreach($gradients as $g)
                            <div class="gradient-swatch {{ $currentGradient === $g['value'] ? 'selected' : '' }}"
                                 style="background: {{ $g['value'] }}"
                                 data-gradient="{{ $g['value'] }}"
                                 onclick="selectGradient(this)"
                                 title="{{ $g['label'] }}">
                                {{ $g['label'] }}
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Custom CSS Gradient <span style="color:#9ca3af">(optional — overrides preset)</span></label>
                        <input type="text" name="gradient" id="gradientInput"
                               class="admin-input"
                               value="{{ old('gradient', $slider->gradient ?? $gradients[0]['value']) }}"
                               placeholder="linear-gradient(135deg, #000 0%, #fff 100%)">
                        <small class="form-help">Paste any CSS gradient. Changes the preview instantly.</small>
                    </div>
                </div>
            </div>

        </div>

        {{-- ── SIDEBAR COLUMN ── --}}
        <div class="form-side-col">

            <div class="admin-card">
                <div class="admin-card-header">⚙️ Settings</div>
                <div class="admin-card-body">
                    <div class="toggle-group">
                        <label class="toggle-label">Slide Active</label>
                        <label class="toggle-switch">
                            <input type="checkbox" name="is_active" value="1"
                                   {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                    <div class="form-group" style="margin-top:16px">
                        <label class="form-label">Sort Order</label>
                        <input type="number" name="sort_order" class="admin-input"
                               value="{{ old('sort_order', $slider->sort_order ?? 0) }}"
                               min="0" max="99">
                        <small class="form-help">Lower number = shown first (e.g. 1, 2, 3...)</small>
                    </div>

                    <button type="submit" class="admin-btn admin-btn-primary" style="width:100%; margin-top:20px; padding:13px;">
                        {{ isset($slider) ? '💾 Update Slide' : '🖼️ Add Slide' }}
                    </button>
                </div>
            </div>

            <div class="admin-card">
                <div class="admin-card-header">💡 Tips</div>
                <div class="admin-card-body">
                    <ul style="font-size:13px; color:#6b7280; line-height:2; list-style:none; padding:0;">
                        <li>🖼️ Upload a <strong>high-resolution</strong> background image for best results</li>
                        <li>🎨 If no image, the <strong>gradient</strong> is used as background</li>
                        <li>📐 Best image size: <strong>1920 × 900px</strong></li>
                        <li>🔢 Use <strong>Sort Order</strong> to control slide sequence</li>
                        <li>👁 Use <strong>Active toggle</strong> to show/hide a slide</li>
                        <li>🔘 Both buttons are optional — leave blank to hide</li>
                    </ul>
                </div>
            </div>

            @if(isset($slider))
            <div class="admin-card">
                <div class="admin-card-header" style="color:#dc2626">🗑️ Danger Zone</div>
                <div class="admin-card-body">
                    <p style="font-size:13px;color:#6b7280;margin-bottom:14px;">
                        Permanently delete this slide. This action cannot be undone.
                    </p>
                    <form method="POST" action="{{ route('admin.slider.destroy', $slider) }}">
                        @csrf @method('DELETE')
                        <button type="submit"
                                class="admin-btn admin-btn-danger" style="width:100%"
                                onclick="return confirm('Are you sure you want to delete this slide?')">
                            🗑️ Delete This Slide
                        </button>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>
</form>

@endsection

@section('scripts')
<script>
// ── Live Preview Updates ──
const titleInput    = document.getElementById('titleInput');
const subtitleInput = document.getElementById('subtitleInput');
const btn1Input     = document.getElementById('btn1Text');
const btn2Input     = document.getElementById('btn2Text');
const gradientInput = document.getElementById('gradientInput');
const livePreview   = document.getElementById('livePreview');

if (titleInput)    titleInput.addEventListener('input',    () => { document.getElementById('pvTitle').textContent = titleInput.value || 'Your Slide Title'; });
if (subtitleInput) subtitleInput.addEventListener('input', () => { document.getElementById('pvSub').textContent   = subtitleInput.value || 'Slide subtitle will appear here'; });
if (btn1Input)     btn1Input.addEventListener('input',     () => { document.getElementById('pvBtn1').textContent  = btn1Input.value || 'Explore'; });
if (btn2Input)     btn2Input.addEventListener('input',     () => { document.getElementById('pvBtn2').textContent  = btn2Input.value || 'Learn More'; });

if (gradientInput) {
    gradientInput.addEventListener('input', () => {
        livePreview.style.background = gradientInput.value;
        // Deselect all swatches
        document.querySelectorAll('.gradient-swatch').forEach(s => s.classList.remove('selected'));
    });
}

// ── Gradient Preset Selector ──
function selectGradient(el) {
    document.querySelectorAll('.gradient-swatch').forEach(s => s.classList.remove('selected'));
    el.classList.add('selected');
    const g = el.dataset.gradient;
    gradientInput.value  = g;
    livePreview.style.background = g;
}

// ── Image Upload Preview ──
function onImageUpload(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        // Update live preview
        let img = document.getElementById('previewImg');
        if (!img) {
            img = document.createElement('img');
            img.id = 'previewImg';
            img.className = 'preview-img';
            livePreview.prepend(img);
        }
        img.src = e.target.result;
        img.style.display = 'block';

        // Update thumbnail box
        let thumb = document.getElementById('bgThumb');
        let placeholder = document.getElementById('bgPlaceholder');
        if (!thumb) {
            thumb = document.createElement('img');
            thumb.id = 'bgThumb';
            thumb.style.cssText = 'width:100%;height:100%;object-fit:cover;';
            const box = input.closest('.image-preview-box') || input.previousElementSibling;
            if (box) { box.innerHTML = ''; box.appendChild(thumb); }
        }
        thumb.src = e.target.result;
        if (placeholder) placeholder.style.display = 'none';
    };
    reader.readAsDataURL(input.files[0]);
}

// ── Drag & Drop on image box ──
const imgBox = document.querySelector('.image-preview-box');
if (imgBox) {
    imgBox.addEventListener('dragover', e => { e.preventDefault(); imgBox.style.borderColor = '#1a5c10'; });
    imgBox.addEventListener('dragleave', () => { imgBox.style.borderColor = ''; });
    imgBox.addEventListener('drop', e => {
        e.preventDefault();
        imgBox.style.borderColor = '';
        const dt = e.dataTransfer;
        if (dt && dt.files.length) {
            document.getElementById('bgImage').files = dt.files;
            onImageUpload(document.getElementById('bgImage'));
        }
    });
}
</script>
@endsection
