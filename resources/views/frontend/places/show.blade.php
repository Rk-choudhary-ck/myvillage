@extends('layouts.app')
@section('title', $place->name . ' — Chanan Khera')
@section('content')
<section style="padding:140px 0 80px;background:var(--green-deep);position:relative;overflow:hidden">
  @if($place->thumbnail)
  <div style="position:absolute;inset:0;background:url('{{ Storage::url($place->thumbnail) }}') center/cover;opacity:0.2"></div>
  @endif
  <div class="container" style="position:relative;z-index:1">
    <div class="section-tag light">{{ $place->category }}</div>
    <div style="display:flex;align-items:center;gap:16px;margin-top:12px">
      <span style="font-size:64px">{{ $place->icon ?? '📍' }}</span>
      <h1 class="section-title light">{{ $place->name }}</h1>
    </div>
    @if($place->best_time_to_visit)
    <p style="color:rgba(255,255,255,0.6);font-size:14px;margin-top:16px">🗓 Best time to visit: <strong style="color:var(--gold)">{{ $place->best_time_to_visit }}</strong></p>
    @endif
  </div>
</section>

<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <div style="display:grid;grid-template-columns:1.4fr 1fr;gap:60px;align-items:start">
      <div>
        @if($place->thumbnail)
        <img src="{{ Storage::url($place->thumbnail) }}" alt="{{ $place->name }}" style="width:100%;border-radius:16px;margin-bottom:32px;max-height:480px;object-fit:cover">
        @endif
        <h2 style="font-family:'Yeseva One',serif;font-size:32px;color:var(--green-deep);margin-bottom:16px">About This Place</h2>
        <p style="font-family:'Lora',serif;font-size:18px;font-style:italic;color:var(--clay);line-height:1.7;margin-bottom:24px">{{ $place->description }}</p>
        @if($place->full_description)
        <div style="font-size:16px;line-height:1.9;color:var(--text)">{!! $place->full_description !!}</div>
        @endif

        @if($place->gallery_images && count($place->gallery_images) > 0)
        <h3 style="font-family:'Yeseva One',serif;font-size:24px;margin:40px 0 16px;color:var(--green-deep)">Gallery</h3>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:10px">
          @foreach($place->gallery_images as $img)
          <img src="{{ Storage::url($img) }}" style="width:100%;aspect-ratio:1;object-fit:cover;border-radius:10px" loading="lazy">
          @endforeach
        </div>
        @endif
      </div>

      <div style="position:sticky;top:100px">
        <div style="background:white;border-radius:16px;padding:32px;box-shadow:0 4px 30px rgba(0,0,0,0.07);margin-bottom:20px">
          <h3 style="font-family:'Yeseva One',serif;font-size:20px;margin-bottom:20px;color:var(--green-deep)">Place Details</h3>
          @foreach([['📍 Category', $place->category], ['🗓 Best Time', $place->best_time_to_visit], ['📌 Location', $place->location_name]] as [$label, $value])
          @if($value)
          <div style="display:flex;justify-content:space-between;padding:12px 0;border-bottom:1px solid #f3f4f6;font-size:14px">
            <span style="color:#6b7280">{{ $label }}</span>
            <span style="font-weight:500;color:var(--text)">{{ $value }}</span>
          </div>
          @endif
          @endforeach
        </div>

        @if($place->latitude && $place->longitude)
        <div style="background:white;border-radius:16px;overflow:hidden;box-shadow:0 4px 30px rgba(0,0,0,0.07)">
          <iframe src="https://maps.google.com/maps?q={{ $place->latitude }},{{ $place->longitude }}&z=14&output=embed"
                  width="100%" height="250" style="border:none;display:block"></iframe>
        </div>
        @endif

        @if($related->isNotEmpty())
        <div style="margin-top:20px;background:white;border-radius:16px;padding:24px;box-shadow:0 4px 20px rgba(0,0,0,0.06)">
          <h4 style="font-family:'Yeseva One',serif;font-size:18px;margin-bottom:16px;color:var(--green-deep)">Related Places</h4>
          @foreach($related as $rp)
          <a href="{{ route('places.show', $rp->slug) }}" style="display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid #f3f4f6;text-decoration:none;color:var(--text)">
            <span style="font-size:24px">{{ $rp->icon ?? '📍' }}</span>
            <div>
              <div style="font-size:14px;font-weight:600">{{ $rp->name }}</div>
              <div style="font-size:11px;color:#9ca3af">{{ $rp->category }}</div>
            </div>
          </a>
          @endforeach
        </div>
        @endif
      </div>
    </div>
    <div style="margin-top:40px">
      <a href="{{ route('places.index') }}" class="cta-btn">← All Places</a>
    </div>
  </div>
</section>
@endsection
