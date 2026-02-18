@extends('layouts.app')
@section('title','Benefits of Village Life — Chanan Khera')
@section('content')
<section style="padding:140px 0 80px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Why Village?</div>
    <h1 class="section-title light" style="margin-top:8px">Real <em>Benefits</em> of<br>Village Life</h1>
  </div>
</section>
<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <div class="benefits-grid" style="max-width:1200px;margin:0 auto">
      @foreach([
        ['🫁','Pure Air & Health','Breathe air untouched by pollution. Rural living dramatically reduces stress, anxiety and respiratory illness.'],
        ['🤝','True Community','Know every neighbour by name. Village bonds create lifelong support networks cities can never replicate.'],
        ['🥦','Farm-to-Table Food','Eat vegetables grown without chemicals, dairy from your own buffalo, grains ground fresh daily.'],
        ['🧘','Slower, Richer Life','Time moves at a human pace. Children play outdoors, elders are honoured, priorities become crystal clear.'],
        ['💰','Affordable Living','Housing, food, transport — a fraction of city costs. Live fully on what city life calls a minimal budget.'],
        ['🌱','Sustainable Living','Solar, rain harvesting, composting, minimal waste — villages naturally model what cities desperately try to learn.'],
        ['📚','Roots & Identity','Know where you come from. Village life gives children an unshakeable sense of identity and cultural pride.'],
        ['🌅','Natural Beauty','Wake up to open skies, golden fields, and birdsong — a luxury money cannot buy in any city apartment.'],
        ['🎊','Festivals & Joy','34 festivals a year. Real celebrations with real people, real food, real music — community joy in its purest form.'],
      ] as [$icon,$title,$desc])
      <div class="benefit-card" data-aos="fade-up">
        <div class="benefit-icon">{{ $icon }}</div>
        <h3 class="benefit-title">{{ $title }}</h3>
        <p class="benefit-desc">{{ $desc }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endsection
