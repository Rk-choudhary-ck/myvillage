@extends('layouts.app')
@section('title','Activities & Games — Chanan Khera')
@section('content')
<section style="padding:140px 0 80px;background:linear-gradient(160deg,#0f2a08,#1a5c10)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Fun & Lifestyle</div>
    <h1 class="section-title light" style="margin-top:8px">Activities &<br><em>Traditional Games</em></h1>
  </div>
</section>
<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:24px">
      @forelse($activities as $activity)
      <div style="background:white;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.05);text-align:center;transition:transform 0.3s,box-shadow 0.3s" onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 12px 40px rgba(0,0,0,0.1)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 20px rgba(0,0,0,0.05)'">
        <div style="font-size:56px;margin-bottom:16px">{{ $activity->icon }}</div>
        <h3 style="font-family:'Yeseva One',serif;font-size:22px;color:var(--green-deep);margin-bottom:10px">{{ $activity->name }}</h3>
        @if($activity->season)<span style="display:inline-block;padding:4px 14px;background:rgba(45,138,26,0.1);border-radius:20px;font-size:11px;color:var(--green-mid);font-weight:600;margin-bottom:12px">{{ $activity->season }}</span>@endif
        <p style="font-size:14px;line-height:1.75;color:var(--text-muted)">{{ $activity->description }}</p>
      </div>
      @empty
      @foreach([['🤸','Kabaddi','Punjab\'s legendary contact sport played every Sunday'],['🏏','Gilli-Danda & Cricket','Childhood sport on dusty village pitches'],['🎣','Riverside Fishing','Early morning peace by the seasonal stream'],['🐄','Bullock Cart Rides','Joy on a decorated cart through golden fields'],['🌿','Farm Tours','Learn organic farming from masters'],['🎪','Village Mela','Annual fair with folk artists and food stalls']] as [$icon,$name,$desc])
      <div style="background:white;border-radius:16px;padding:32px;box-shadow:0 4px 20px rgba(0,0,0,0.05);text-align:center">
        <div style="font-size:56px;margin-bottom:16px">{{ $icon }}</div>
        <h3 style="font-family:'Yeseva One',serif;font-size:22px;color:var(--green-deep);margin-bottom:10px">{{ $name }}</h3>
        <p style="font-size:14px;line-height:1.75;color:var(--text-muted)">{{ $desc }}</p>
      </div>
      @endforeach
      @endforelse
    </div>
  </div>
</section>
@endsection
