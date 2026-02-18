@extends('layouts.app')
@section('title','About Chanan Khera Village')
@section('content')
<section style="padding:140px 0 80px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Our Village</div>
    <h1 class="section-title light" style="margin-top:8px">About <em>Chanan Khera</em></h1>
    <p style="font-family:'Lora',serif;font-style:italic;font-size:20px;color:rgba(255,255,255,0.7);max-width:600px;margin:20px auto 0">ਚਾਨਣ ਖੇੜਾ — The Village of Light, where every sunrise writes a new chapter</p>
  </div>
</section>
<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;max-width:1200px;margin:0 auto">
      <div>
        <div class="section-tag">500+ Years</div>
        <h2 class="section-title" style="margin-top:8px">A Village Rooted in <em>History</em></h2>
        <p style="font-family:'Lora',serif;font-size:18px;font-style:italic;color:var(--clay);line-height:1.7;margin:20px 0">Chanan Khera was founded over five centuries ago in the heart of Punjab, along the fertile lands watered by seasonal rivers and ancient wells.</p>
        <p style="font-size:15px;line-height:1.8;color:var(--text-muted);margin-bottom:16px">Our village has been home to farmers who feed nations, artisans whose hands weave stories, warriors who protected their land, and saints whose devotion built sacred spaces still visited today.</p>
        <p style="font-size:15px;line-height:1.8;color:var(--text-muted)">Through the Mughal era, British rule, the partition of 1947, and modern India's growth — Chanan Khera has stood firm, its identity shaped by the soil beneath its feet and the sky above its fields.</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:40px;padding-top:32px;border-top:1px solid var(--border)">
          @foreach([['2400+','Residents'],['500+','Years History'],['34','Festivals/Year']] as [$num,$lbl])
          <div style="text-align:center">
            <div style="font-family:'Yeseva One',serif;font-size:36px;color:var(--green-mid)">{{ $num }}</div>
            <div style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--sage);margin-top:4px">{{ $lbl }}</div>
          </div>
          @endforeach
        </div>
      </div>
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
        @foreach(['🌾','🕌','💧','🎭','🌳','🥁'] as $emoji)
        <div style="aspect-ratio:1;background:linear-gradient(135deg,#0a2a05,#2d8a1a);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:56px;opacity:0.7">{{ $emoji }}</div>
        @endforeach
      </div>
    </div>
  </div>
</section>
@endsection
