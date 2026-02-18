@extends('layouts.app')
@section('title','Famous Places — Chanan Khera')

@section('content')
<section style="padding:140px 0 80px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Explore</div>
    <h1 class="section-title light" style="margin-top:8px">Famous Places of<br><em>Chanan Khera</em></h1>
  </div>
</section>

<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <!-- Category Filter -->
    <div style="display:flex;gap:10px;flex-wrap:wrap;margin-bottom:40px;justify-content:center">
      <a href="{{ route('places.index') }}" class="cta-btn {{ !request('category') ? '' : '' }}" style="padding:8px 20px;font-size:11px">All Places</a>
      @foreach($categories as $cat)
      <a href="{{ route('places.index', ['category'=>$cat]) }}" class="cta-btn" style="padding:8px 20px;font-size:11px;background:var(--sage)">{{ $cat }}</a>
      @endforeach
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(320px,1fr));gap:28px">
      @forelse($places as $place)
      <div class="blog-card" style="border-radius:16px;overflow:hidden;background:white;box-shadow:0 4px 20px rgba(0,0,0,0.06)">
        <div style="position:relative;aspect-ratio:4/3;overflow:hidden">
          @if($place->thumbnail)
          <img src="{{ Storage::url($place->thumbnail) }}" alt="{{ $place->name }}" style="width:100%;height:100%;object-fit:cover">
          @else
          <div style="width:100%;height:100%;background:linear-gradient(135deg,#0a2a05,#2d8a1a);display:flex;align-items:center;justify-content:center;font-size:80px;opacity:0.6">
            {{ $place->icon ?? '📍' }}
          </div>
          @endif
          <span style="position:absolute;top:16px;left:16px;background:var(--gold);color:var(--green-deep);padding:5px 14px;border-radius:4px;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase">{{ $place->category }}</span>
          @if($place->is_featured)<span style="position:absolute;top:16px;right:16px;background:var(--green-mid);color:white;padding:5px 12px;border-radius:4px;font-size:10px;font-weight:700">⭐ Featured</span>@endif
        </div>
        <div style="padding:24px">
          <h3 style="font-family:'Yeseva One',serif;font-size:22px;color:var(--green-deep);margin-bottom:10px">{{ $place->name }}</h3>
          <p style="font-size:14px;line-height:1.7;color:var(--text-muted);margin-bottom:16px">{{ $place->description }}</p>
          @if($place->best_time_to_visit)
          <p style="font-size:12px;color:var(--sage);margin-bottom:16px">🗓 Best time: {{ $place->best_time_to_visit }}</p>
          @endif
          <a href="{{ route('places.show', $place->slug) }}" class="cta-btn" style="display:inline-block;padding:10px 24px;font-size:11px">Explore →</a>
        </div>
      </div>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:80px 20px;color:var(--text-muted)">
        <div style="font-size:60px;margin-bottom:16px">📍</div>
        <h3>No places added yet</h3>
        <p>The admin will add famous places soon. Check back later!</p>
      </div>
      @endforelse
    </div>
    <div style="margin-top:40px;text-align:center">{{ $places->links() }}</div>
  </div>
</section>
@endsection
