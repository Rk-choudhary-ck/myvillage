@extends('layouts.admin')
@section('title', 'Hero Slider')
@section('breadcrumb') / Hero Slider @endsection

@section('styles')
<style>
.slide-preview-card {
    background: white;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 2px 12px rgba(0,0,0,0.08);
    transition: transform 0.25s, box-shadow 0.25s;
}
.slide-preview-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 30px rgba(0,0,0,0.12);
}
.slide-thumb {
    width: 100%;
    aspect-ratio: 16/7;
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
.slide-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
}
.slide-thumb .slide-gradient-preview {
    width: 100%; height: 100%;
    display: flex; flex-direction: column;
    align-items: center; justify-content: center;
    color: white; text-align: center; padding: 20px;
}
.slide-thumb .slide-gradient-preview h4 {
    font-family: 'Yeseva One', serif;
    font-size: 22px; margin-bottom: 6px; line-height: 1.2;
}
.slide-thumb .slide-gradient-preview p {
    font-size: 12px; opacity: 0.7;
}
.slide-body { padding: 16px 18px; }
.slide-meta {
    display: flex; align-items: center;
    justify-content: space-between;
    margin-bottom: 10px;
}
.slide-order-badge {
    width: 28px; height: 28px;
    background: #f3f4f6;
    border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 700; color: #4b5563;
}
.slide-actions { display: flex; gap: 6px; margin-top: 12px; }
.empty-slider {
    grid-column: 1/-1;
    text-align: center;
    padding: 80px 20px;
    color: #9ca3af;
}
.empty-slider .empty-icon { font-size: 64px; margin-bottom: 16px; }
.tip-box {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-radius: 10px;
    padding: 16px 20px;
    margin-bottom: 24px;
    font-size: 13px;
    color: #166534;
    display: flex;
    align-items: center;
    gap: 12px;
}
</style>
@endsection

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Hero Slider</h1>
        <p class="page-sub">Manage the homepage hero slideshow — {{ count($sliders) }} slide(s)</p>
    </div>
    <a href="{{ route('admin.slider.create') }}" class="admin-btn admin-btn-primary">+ Add New Slide</a>
</div>

<div class="tip-box">
    💡 <span>Slides are shown in the <strong>Sort Order</strong> you set. Upload a background image or set a CSS gradient. Recommended image size: <strong>1920×900px</strong>.</span>
</div>

@if($sliders->isEmpty())
    <div class="admin-card">
        <div class="dc-body">
            <div class="empty-slider">
                <div class="empty-icon">🖼️</div>
                <h3 style="font-size:20px;font-weight:600;color:#374151;margin-bottom:8px">No slides yet</h3>
                <p style="margin-bottom:24px">Add your first hero slide to display on the homepage.</p>
                <a href="{{ route('admin.slider.create') }}" class="admin-btn admin-btn-primary">+ Create First Slide</a>
            </div>
        </div>
    </div>
@else
    <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(320px,1fr)); gap:20px;">
        @foreach($sliders as $slide)
        <div class="slide-preview-card">
            {{-- Slide Thumbnail --}}
            <div class="slide-thumb">
                @if($slide->image)
                    <img src="{{ Storage::url($slide->image) }}" alt="{{ $slide->title }}">
                @else
                    <div class="slide-gradient-preview"
                         style="background: {{ $slide->gradient ?: 'linear-gradient(135deg, #0a2a05 0%, #1a5c10 50%, #2d8a1a 100%)' }}">
                        <h4>{{ $slide->title }}</h4>
                        @if($slide->subtitle)
                            <p>{{ Str::limit($slide->subtitle, 60) }}</p>
                        @endif
                    </div>
                @endif

                {{-- Active / Inactive badge --}}
                <div style="position:absolute; top:10px; left:10px;">
                    <span style="
                        background: {{ $slide->is_active ? 'rgba(22,163,74,0.9)' : 'rgba(107,114,128,0.9)' }};
                        color: white; font-size: 10px; font-weight: 700;
                        padding: 4px 10px; border-radius: 20px; letter-spacing: 1px;
                    ">
                        {{ $slide->is_active ? '✅ Active' : '⬜ Inactive' }}
                    </span>
                </div>
            </div>

            {{-- Slide Info --}}
            <div class="slide-body">
                <div class="slide-meta">
                    <div class="slide-order-badge">#{{ $slide->sort_order }}</div>
                    <span style="font-size:11px; color:#9ca3af;">
                        {{ $slide->image ? 'Image Slide' : 'Gradient Slide' }}
                    </span>
                </div>

                <h3 style="font-size:15px; font-weight:600; color:#111827; margin-bottom:4px;">
                    {{ $slide->title }}
                </h3>
                @if($slide->subtitle)
                <p style="font-size:12px; color:#6b7280; line-height:1.5;">
                    {{ Str::limit($slide->subtitle, 70) }}
                </p>
                @endif

                @if($slide->button_text)
                <div style="margin-top:8px; display:flex; gap:6px; flex-wrap:wrap;">
                    <span style="padding:3px 10px; background:#f3f4f6; border-radius:5px; font-size:11px; color:#374151;">
                        🔘 {{ $slide->button_text }}
                    </span>
                    @if($slide->button2_text)
                    <span style="padding:3px 10px; background:#f3f4f6; border-radius:5px; font-size:11px; color:#374151;">
                        🔘 {{ $slide->button2_text }}
                    </span>
                    @endif
                </div>
                @endif

                <div class="slide-actions">
                    <a href="{{ route('admin.slider.edit', $slide) }}" class="ta-btn ta-edit" style="flex:1; text-align:center;">✏️ Edit</a>

                    {{-- Toggle Active --}}
                    <form method="POST" action="{{ route('admin.slider.update', $slide) }}" style="display:inline;">
                        @csrf @method('PUT')
                        <input type="hidden" name="title" value="{{ $slide->title }}">
                        <input type="hidden" name="is_active" value="{{ $slide->is_active ? 0 : 1 }}">
                        <input type="hidden" name="_toggle" value="1">
                        <button type="submit" class="ta-btn"
                                style="background:{{ $slide->is_active ? '#fef3c7' : '#dcfce7' }}; color:{{ $slide->is_active ? '#d97706' : '#16a34a' }};">
                            {{ $slide->is_active ? 'Hide' : 'Show' }}
                        </button>
                    </form>

                    <form method="POST" action="{{ route('admin.slider.destroy', $slide) }}" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="ta-btn ta-del"
                                onclick="return confirm('Delete this slide?')">🗑</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Reorder hint --}}
    <div style="margin-top:20px; text-align:center; color:#9ca3af; font-size:13px;">
        💡 Change the <strong>Sort Order</strong> number inside each slide to reorder them on the homepage.
    </div>
@endif

@endsection
