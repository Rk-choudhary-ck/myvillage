@extends('layouts.app')
@section('title','Culture & Traditions — Chanan Khera')
@section('content')
<section style="padding:140px 0 80px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Our Identity</div>
    <h1 class="section-title light" style="margin-top:8px">Culture &<br><em>Traditions</em></h1>
  </div>
</section>
<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    @forelse($grouped as $category => $items)
    <div style="margin-bottom:60px">
      <h2 style="font-family:'Yeseva One',serif;font-size:36px;color:var(--green-deep);margin-bottom:32px;text-transform:capitalize">
        {{ ['festival'=>'🪔 Festivals','music'=>'🥁 Music & Dance','food'=>'🍲 Cuisine','craft'=>'🎨 Crafts'][$category] ?? $category }}
      </h2>
      <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:24px">
        @foreach($items as $item)
        <div style="background:white;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.05);border-top:3px solid var(--gold);transition:transform 0.3s" onmouseover="this.style.transform='translateY(-6px)'" onmouseout="this.style.transform='translateY(0)'">
          <div style="font-size:48px;margin-bottom:16px">{{ $item->icon }}</div>
          <h3 style="font-family:'Yeseva One',serif;font-size:22px;color:var(--green-deep);margin-bottom:10px">{{ $item->title }}</h3>
          <p style="font-size:14px;line-height:1.75;color:var(--text-muted)">{{ $item->description }}</p>
        </div>
        @endforeach
      </div>
    </div>
    @empty
    <div style="text-align:center;padding:80px;color:var(--text-muted)">
      <div style="font-size:60px;margin-bottom:16px">🎭</div>
      <p>Culture items will be added soon by admin.</p>
    </div>
    @endforelse
  </div>
</section>
@endsection
