@extends('layouts.app')
@section('title', 'Chanan Khera – Village of Heritage, Nature & Life')

@section('content')

<!-- ═══ HERO SLIDER ═══ -->
<section class="hero-section">
  <div class="swiper heroSwiper">
    <div class="swiper-wrapper">

      <div class="swiper-slide hero-slide" style="--bg: linear-gradient(135deg,#0a1f04 0%,#1a4a0a 40%,#2d6b1a 70%,#0f2d05 100%)">
        <div class="slide-particles" id="particles1"></div>
        <div class="slide-overlay"></div>
        <div class="hero-content">
          <div class="hero-tag" data-swiper-parallax="-200">✦ Punjab, India ✦</div>
          <h1 class="hero-title" data-swiper-parallax="-300">
            <span class="hero-punjabi">ਚਾਨਣ ਖੇੜਾ</span>
            <span class="hero-eng">Where Fields<br><em>Sing at Dawn</em></span>
          </h1>
          <p class="hero-sub" data-swiper-parallax="-100">A village of golden fields, ancient temples, and stories that breathe through every leaf</p>
          <div class="hero-btns" data-swiper-parallax="-150">
            <a href="{{ route('places.index') }}" class="hbtn hbtn-gold">Explore Village</a>
            <a href="{{ route('about') }}" class="hbtn hbtn-outline">Our Story</a>
          </div>
        </div>
        <div class="hero-scroll-hint">
          <div class="scroll-mouse"><div class="scroll-wheel"></div></div>
          <span>Scroll</span>
        </div>
      </div>

      <div class="swiper-slide hero-slide" style="--bg: linear-gradient(135deg,#0a1525 0%,#0f3060 40%,#1a5c8a 70%,#0a1f35 100%)">
        <div class="slide-overlay"></div>
        <div class="hero-content">
          <div class="hero-tag" data-swiper-parallax="-200">✦ Sacred Waters ✦</div>
          <h1 class="hero-title" data-swiper-parallax="-300">
            <span class="hero-punjabi">ਸ਼ਾਂਤੀ ਦੀ ਭੂਮੀ</span>
            <span class="hero-eng">Land of<br><em>Peaceful Waters</em></span>
          </h1>
          <p class="hero-sub" data-swiper-parallax="-100">Crystal-clear streams and sacred ponds mirror the sky — places where time slows and souls find rest</p>
          <div class="hero-btns" data-swiper-parallax="-150">
            <a href="{{ route('places.index') }}" class="hbtn hbtn-gold">View Places</a>
            <a href="{{ route('gallery.index') }}" class="hbtn hbtn-outline">See Gallery</a>
          </div>
        </div>
      </div>

      <div class="swiper-slide hero-slide" style="--bg: linear-gradient(135deg,#200a00 0%,#5c2000 40%,#9b4a0a 70%,#2d1400 100%)">
        <div class="slide-overlay"></div>
        <div class="hero-content">
          <div class="hero-tag" data-swiper-parallax="-200">✦ Living Heritage ✦</div>
          <h1 class="hero-title" data-swiper-parallax="-300">
            <span class="hero-punjabi">ਸੱਭਿਆਚਾਰ ਦੀ ਧਰਤੀ</span>
            <span class="hero-eng">500 Years of<br><em>Culture & Pride</em></span>
          </h1>
          <p class="hero-sub" data-swiper-parallax="-100">Festivals, folk songs, harvest dances — our culture is not history, it lives in every heartbeat</p>
          <div class="hero-btns" data-swiper-parallax="-150">
            <a href="{{ route('culture.index') }}" class="hbtn hbtn-gold">Our Culture</a>
            <a href="{{ route('blog.index') }}" class="hbtn hbtn-outline">Read Stories</a>
          </div>
        </div>
      </div>

    </div>
    <!-- Slider Controls -->
    <div class="swiper-pagination hero-pagination"></div>
    <div class="swiper-button-prev hero-prev"></div>
    <div class="swiper-button-next hero-next"></div>
  </div>

  <!-- Floating Stats Bar -->
  <div class="hero-stats-bar" data-aos="fade-up" data-aos-delay="600">
    <div class="hstat"><span class="hstat-num" data-count="2400">0</span><span class="hstat-label">Residents</span></div>
    <div class="hstat-divider"></div>
    <div class="hstat"><span class="hstat-num" data-count="500">0</span><span class="hstat-label">Years History</span></div>
    <div class="hstat-divider"></div>
    <div class="hstat"><span class="hstat-num" data-count="34">0</span><span class="hstat-label">Annual Festivals</span></div>
    <div class="hstat-divider"></div>
    <div class="hstat"><span class="hstat-num" data-count="18">0</span><span class="hstat-label">Famous Places</span></div>
  </div>
</section>

<!-- ═══ ABOUT VILLAGE ═══ -->
<section class="about-section" id="about">
  <div class="container">
    <div class="about-grid">
      <div class="about-visuals" data-aos="fade-right">
        <div class="av-main">
          <div class="av-img-block av-main-img">
            <div class="av-placeholder forest-bg">
              <span class="av-emoji">🏡</span>
              <div class="av-img-label">Chanan Khera Village</div>
            </div>
          </div>
          <div class="av-float-card fc1">
            <div class="fc-icon">🌾</div>
            <div class="fc-text">Organic<br>Farmlands</div>
          </div>
        </div>
        <div class="av-secondary-imgs">
          <div class="av-img-block field-bg">
            <span class="av-emoji-sm">🌅</span>
          </div>
          <div class="av-img-block river-bg">
            <span class="av-emoji-sm">💧</span>
          </div>
        </div>
        <div class="av-float-card fc2" data-aos="zoom-in" data-aos-delay="400">
          <div class="fc-big-num">500+</div>
          <div class="fc-label">Years of Heritage</div>
        </div>
      </div>

      <div class="about-text" data-aos="fade-left" data-aos-delay="200">
        <div class="section-tag">About Our Village</div>
        <h2 class="section-title">The Soul of <em>Punjab</em><br>Lives Here</h2>
        <p class="about-lead">Chanan Khera — whose name means "The Village of Light" — is nestled in the heart of Punjab, surrounded by golden wheat fields, ancient banyan trees, and the gentle murmur of the Beas River nearby.</p>
        <p>Founded over five centuries ago, our village has been home to farmers, artisans, singers, and warriors. Every stone path, every old haveli, every festival held under the open Punjab sky carries the memory of generations.</p>
        <div class="about-highlights">
          <div class="ah-item">
            <span class="ah-icon">🌿</span>
            <div><strong>Organic Farming</strong><p>Traditional farming methods, rich soil, chemical-free crops</p></div>
          </div>
          <div class="ah-item">
            <span class="ah-icon">🕌</span>
            <div><strong>Ancient Gurdwaras</strong><p>Sacred Sikh shrines dating back to the 17th century</p></div>
          </div>
          <div class="ah-item">
            <span class="ah-icon">🎵</span>
            <div><strong>Folk Music</strong><p>Bhangra, Giddha, and Alha performances at every celebration</p></div>
          </div>
        </div>
        <a href="{{ route('about') }}" class="cta-btn">Discover Our Village →</a>
      </div>
    </div>
  </div>
</section>

<!-- ═══ FAMOUS PLACES ═══ -->
<section class="places-section dark-section" id="places">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <div class="section-tag light">Must-Visit Spots</div>
      <h2 class="section-title light">Famous <em>Places</em> of<br>Chanan Khera</h2>
      <p class="section-sub">From ancient Gurdwaras to shimmering ponds — every corner tells a story</p>
    </div>
    <div class="places-masonry" data-aos="fade-up" data-aos-delay="200">
      @forelse($featuredPlaces ?? [] as $place)
      <div class="place-tile {{ $loop->first ? 'place-tile-large' : '' }}">
        @if($place->thumbnail)
        <img src="{{ Storage::url($place->thumbnail) }}" alt="{{ $place->name }}" class="tile-bg-img">
        @else
        <div class="tile-bg tile-{{ $loop->index % 5 + 1 }}"></div>
        @endif
        <div class="tile-overlay">
          <div class="tile-cat">{{ $place->category }}</div>
          <h3 class="tile-name">{{ $place->name }}</h3>
          <p class="tile-desc">{{ $place->description }}</p>
          <a href="{{ route('places.show', $place->slug) }}" class="tile-link">Explore →</a>
        </div>
        <span class="tile-emoji">{{ $place->icon ?? '📍' }}</span>
      </div>
      @empty
      <!-- Demo tiles when no DB data -->
      <div class="place-tile place-tile-large">
        <div class="tile-bg tile-1"></div>
        <div class="tile-overlay">
          <div class="tile-cat">Sacred Site</div>
          <h3 class="tile-name">Village Gurdwara Sahib</h3>
          <p class="tile-desc">A 300-year-old Sikh shrine that has witnessed centuries of prayer, langar, and community gathering under the open Punjab sky.</p>
          <a href="{{ route('places.index') }}" class="tile-link">Explore →</a>
        </div>
        <span class="tile-emoji">🕌</span>
      </div>
      <div class="place-tile">
        <div class="tile-bg tile-2"></div>
        <div class="tile-overlay">
          <div class="tile-cat">Water Body</div>
          <h3 class="tile-name">Chanan Khera Pond</h3>
          <p class="tile-desc">A crystal-clear village pond reflecting golden sunrises.</p>
          <a href="{{ route('places.index') }}" class="tile-link">Explore →</a>
        </div>
        <span class="tile-emoji">💧</span>
      </div>
      <div class="place-tile">
        <div class="tile-bg tile-3"></div>
        <div class="tile-overlay">
          <div class="tile-cat">Nature Trail</div>
          <h3 class="tile-name">The Ancient Banyan Tree</h3>
          <p class="tile-desc">A 400-year-old banyan where elders gather for evening tales.</p>
          <a href="{{ route('places.index') }}" class="tile-link">Explore →</a>
        </div>
        <span class="tile-emoji">🌳</span>
      </div>
      <div class="place-tile">
        <div class="tile-bg tile-4"></div>
        <div class="tile-overlay">
          <div class="tile-cat">Heritage</div>
          <h3 class="tile-name">Old Haveli of Chanan Khera</h3>
          <p class="tile-desc">Magnificent 18th-century architecture with intricate frescoes.</p>
          <a href="{{ route('places.index') }}" class="tile-link">Explore →</a>
        </div>
        <span class="tile-emoji">🏛</span>
      </div>
      <div class="place-tile">
        <div class="tile-bg tile-5"></div>
        <div class="tile-overlay">
          <div class="tile-cat">Agriculture</div>
          <h3 class="tile-name">Golden Wheat Fields</h3>
          <p class="tile-desc">Endless fields turning gold at harvest — a sight to remember forever.</p>
          <a href="{{ route('places.index') }}" class="tile-link">Explore →</a>
        </div>
        <span class="tile-emoji">🌾</span>
      </div>
      @endforelse
    </div>
    <div class="section-cta" data-aos="fade-up">
      <a href="{{ route('places.index') }}" class="cta-btn cta-light">View All Places →</a>
    </div>
  </div>
</section>

<!-- ═══ CULTURE HIGHLIGHTS ═══ -->
<section class="culture-section" id="culture">
  <div class="culture-bg-pattern"></div>
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <div class="section-tag">Our Identity</div>
      <h2 class="section-title">Rich <em>Culture</em> &<br>Living Traditions</h2>
    </div>
    <div class="culture-tabs" data-aos="fade-up" data-aos-delay="100">
      <button class="ctab active" data-tab="festivals">🪔 Festivals</button>
      <button class="ctab" data-tab="music">🎵 Music & Dance</button>
      <button class="ctab" data-tab="food">🍲 Cuisine</button>
      <button class="ctab" data-tab="crafts">🎨 Crafts</button>
    </div>
    <div class="culture-tab-content">
      <div class="ctab-panel active" id="tab-festivals">
        <div class="culture-feature-grid">
          <div class="cfg-text" data-aos="fade-right">
            <h3>Festivals That Light Up the Village</h3>
            <p>From the blazing bonfires of Lohri to the colors of Holi, the triumph of Baisakhi harvests to the divine glow of Diwali diyas — Chanan Khera celebrates life in every season.</p>
            <p>Our annual village mela draws thousands from surrounding villages, with folk performers, artisan markets, and the legendary village wrestling tournament.</p>
            <div class="festival-tags">
              <span>🔥 Lohri</span><span>🌈 Holi</span><span>🌾 Baisakhi</span><span>🪔 Diwali</span><span>🎪 Village Mela</span>
            </div>
          </div>
          <div class="cfg-visual festival-visual" data-aos="fade-left" data-aos-delay="200">
            <div class="cv-main">🪔</div>
            <div class="cv-float f1">🎆</div>
            <div class="cv-float f2">🥁</div>
            <div class="cv-float f3">🌸</div>
          </div>
        </div>
      </div>
      <div class="ctab-panel" id="tab-music">
        <div class="culture-feature-grid">
          <div class="cfg-text">
            <h3>Bhangra, Giddha & Folk Songs</h3>
            <p>The dhol beats of Chanan Khera echo across the fields every harvest season. Our village bhangra troupe has won state championships and performed at national events.</p>
            <p>Women of the village gather for Giddha every Sunday — a beautiful circle dance full of wit, laughter, and ancient wisdom passed through generations.</p>
            <div class="festival-tags">
              <span>🥁 Bhangra</span><span>💃 Giddha</span><span>🎶 Alha</span><span>🎸 Folk Songs</span>
            </div>
          </div>
          <div class="cfg-visual music-visual">
            <div class="cv-main">🥁</div>
            <div class="cv-float f1">🎵</div>
            <div class="cv-float f2">💃</div>
            <div class="cv-float f3">🎺</div>
          </div>
        </div>
      </div>
      <div class="ctab-panel" id="tab-food">
        <div class="culture-feature-grid">
          <div class="cfg-text">
            <h3>Tastes Straight from the Soil</h3>
            <p>Chanan Khera's cuisine is a love letter to Punjab's land. Makki di Roti with Sarson da Saag, rich Daal Makhani slow-cooked on wood fire, and the sweetest Lassi you've ever tasted.</p>
            <p>Every household has heirloom recipes guarded like family secrets — but shared generously with every guest who arrives, because hospitality is our religion.</p>
            <div class="festival-tags">
              <span>🌽 Makki Roti</span><span>🥬 Saag</span><span>🥛 Lassi</span><span>🍯 Pinni</span>
            </div>
          </div>
          <div class="cfg-visual food-visual">
            <div class="cv-main">🍲</div>
            <div class="cv-float f1">🥛</div>
            <div class="cv-float f2">🌽</div>
            <div class="cv-float f3">🫕</div>
          </div>
        </div>
      </div>
      <div class="ctab-panel" id="tab-crafts">
        <div class="culture-feature-grid">
          <div class="cfg-text">
            <h3>Handmade with Heart</h3>
            <p>The women of Chanan Khera weave magic into phulkari dupattas — intricate embroidery on silk that has been our pride for centuries. Each piece takes weeks to complete and is unique.</p>
            <p>Our potters, weavers, and blacksmiths carry forward skills that no machine can replicate, keeping alive crafts that tell the story of who we are.</p>
            <div class="festival-tags">
              <span>🧵 Phulkari</span><span>🏺 Pottery</span><span>🪡 Weaving</span><span>⚒ Blacksmith</span>
            </div>
          </div>
          <div class="cfg-visual craft-visual">
            <div class="cv-main">🎨</div>
            <div class="cv-float f1">🧵</div>
            <div class="cv-float f2">🏺</div>
            <div class="cv-float f3">✨</div>
          </div>
        </div>
      </div>
    </div>
    <div class="section-cta" data-aos="fade-up">
      <a href="{{ route('culture.index') }}" class="cta-btn">Explore All Culture →</a>
    </div>
  </div>
</section>

<!-- ═══ ACTIVITIES STRIP ═══ -->
<section class="activities-strip" id="activities">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <div class="section-tag light">Fun & Lifestyle</div>
      <h2 class="section-title light">Activities &<br><em>Traditional Games</em></h2>
    </div>
    <div class="activities-swiper-wrap" data-aos="fade-up" data-aos-delay="200">
      <div class="swiper actSwiper">
        <div class="swiper-wrapper">
          @php
          $activities = $activities ?? [
            ['icon'=>'🤸','name'=>'Kabaddi','desc'=>'Punjabs legendary contact sport — raw energy, pure skill, no equipment needed'],
            ['icon'=>'🏏','name'=>'Cricket & Gilli-Danda','desc'=>'Dusty pitches, homemade bats, sunset matches — childhood in Chanan Khera'],
            ['icon'=>'🎣','name'=>'Riverside Fishing','desc'=>'Early mornings with rod and patience at the seasonal stream'],
            ['icon'=>'🐄','name'=>'Bullock Cart Rides','desc'=>'Trundle through fields on a decorated cart — joy in its simplest form'],
            ['icon'=>'🌿','name'=>'Farm Tours','desc'=>'Sow seeds, learn seasons, feel soil — guided organic farming experiences'],
            ['icon'=>'🎪','name'=>'Village Mela','desc'=>'Annual fair with folk artists, food stalls, jhulas and wrestling pits'],
            ['icon'=>'🏊','name'=>'Pond Swimming','desc'=>'Summer tradition for village youth in the cool village talab'],
            ['icon'=>'🐓','name'=>'Rooster Racing','desc'=>'Traditional village sport with colorful decorated roosters'],
          ];
          @endphp
          @foreach($activities as $act)
          <div class="swiper-slide act-card">
            <div class="act-icon">{{ is_array($act) ? $act['icon'] : $act->icon }}</div>
            <h3 class="act-name">{{ is_array($act) ? $act['name'] : $act->name }}</h3>
            <p class="act-desc">{{ is_array($act) ? $act['desc'] : $act->description }}</p>
          </div>
          @endforeach
        </div>
        <div class="swiper-pagination act-pagination"></div>
      </div>
    </div>
    <div class="section-cta" data-aos="fade-up">
      <a href="{{ route('activities.index') }}" class="cta-btn cta-light">See All Activities →</a>
    </div>
  </div>
</section>

<!-- ═══ VIDEO SHOWCASE ═══ -->
<section class="video-section" id="videos">
  <div class="container">
    <div class="video-grid">
      <div class="video-text" data-aos="fade-right">
        <div class="section-tag">Visual Stories</div>
        <h2 class="section-title">Watch Chanan<br>Khera <em>Breathe</em></h2>
        <p>Our video archive preserves the sights, sounds, and stories of village life — from Baisakhi celebrations to everyday sunrise moments that make life here extraordinary.</p>
        <a href="{{ route('videos.index') }}" class="cta-btn">Browse All Videos →</a>
      </div>
      <div class="video-showcase" data-aos="fade-left" data-aos-delay="200">
        @if(isset($featuredVideo) && $featuredVideo)
        <div class="video-thumb" onclick="playVideo('{{ $featuredVideo->video_url }}')">
          <img src="{{ Storage::url($featuredVideo->thumbnail) }}" alt="{{ $featuredVideo->title }}">
          <div class="play-ring">
            <div class="play-btn-vid">▶</div>
          </div>
          <div class="vid-label">{{ $featuredVideo->title }}</div>
        </div>
        @else
        <div class="video-thumb demo-thumb">
          <div class="demo-vid-bg">🎬</div>
          <div class="play-ring">
            <div class="play-btn-vid">▶</div>
          </div>
          <div class="vid-label">Chanan Khera — A Documentary</div>
        </div>
        @endif
        <div class="video-mini-grid">
          @foreach(($recentVideos ?? []) as $v)
          <div class="mini-vid" onclick="playVideo('{{ $v->video_url }}')">
            <img src="{{ Storage::url($v->thumbnail) }}" alt="{{ $v->title }}">
            <span class="mini-play">▶</span>
          </div>
          @endforeach
          @if(($recentVideos ?? collect())->isEmpty())
          <div class="mini-vid mini-demo"><div class="mini-emoji">🌾</div><span class="mini-play">▶</span></div>
          <div class="mini-vid mini-demo"><div class="mini-emoji">🪔</div><span class="mini-play">▶</span></div>
          <div class="mini-vid mini-demo"><div class="mini-emoji">🥁</div><span class="mini-play">▶</span></div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══ GALLERY PREVIEW ═══ -->
<section class="gallery-preview dark-section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <div class="section-tag light">Visual Journey</div>
      <h2 class="section-title light">Glimpses of<br><em>Chanan Khera</em></h2>
    </div>
    <div class="gallery-masonry-preview" data-aos="fade-up" data-aos-delay="200">
      @forelse($galleryPreview ?? [] as $img)
      <div class="gmp-item">
        <img src="{{ Storage::url($img->image_path) }}" alt="{{ $img->title }}" loading="lazy">
        <div class="gmp-overlay">
          <div class="gmp-icon">🔍</div>
          <div class="gmp-title">{{ $img->title }}</div>
        </div>
      </div>
      @empty
      @for($i = 1; $i <= 8; $i++)
      <div class="gmp-item gmp-demo gmp-demo-{{ $i }}">
        <div class="gmp-emoji">{{ ['🌾','🌅','🏡','💧','🌳','🕌','🎭','🐄'][$i-1] }}</div>
        <div class="gmp-overlay">
          <div class="gmp-icon">🔍</div>
          <div class="gmp-title">Village Life</div>
        </div>
      </div>
      @endfor
      @endforelse
    </div>
    <div class="section-cta" data-aos="fade-up">
      <a href="{{ route('gallery.index') }}" class="cta-btn cta-light">Open Full Gallery →</a>
    </div>
  </div>
</section>

<!-- ═══ BLOG PREVIEW ═══ -->
<section class="blog-section" id="blog">
  <div class="container">
    <div class="blog-header" data-aos="fade-up">
      <div>
        <div class="section-tag">Village Chronicles</div>
        <h2 class="section-title">Stories from the<br><em>Heart of Punjab</em></h2>
      </div>
      <a href="{{ route('blog.index') }}" class="cta-btn">All Stories →</a>
    </div>
    <div class="blog-grid" data-aos="fade-up" data-aos-delay="200">
      @forelse($recentBlogs ?? [] as $post)
      <article class="blog-card {{ $loop->first ? 'blog-card-featured' : '' }}">
        <div class="bc-img">
          @if($post->thumbnail)
          <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" loading="lazy">
          @else
          <div class="bc-placeholder bc-color-{{ $loop->index % 4 + 1 }}">📖</div>
          @endif
          <span class="bc-category">{{ $post->category }}</span>
        </div>
        <div class="bc-body">
          <time class="bc-date">{{ $post->created_at->format('d M Y') }}</time>
          <h3 class="bc-title"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
          <p class="bc-excerpt">{{ Str::limit($post->excerpt, 100) }}</p>
          <a href="{{ route('blog.show', $post->slug) }}" class="bc-link">Read Story <span>→</span></a>
        </div>
      </article>
      @empty
      <article class="blog-card blog-card-featured">
        <div class="bc-img"><div class="bc-placeholder bc-color-1">🌾</div><span class="bc-category">Farming</span></div>
        <div class="bc-body">
          <time class="bc-date">15 Jan 2025</time>
          <h3 class="bc-title"><a href="#">Harvest Season: When the Whole Village Becomes One Family</a></h3>
          <p class="bc-excerpt">The smell of fresh wheat, the rhythm of sickles, and voices singing harvest songs — this is what community truly means in Chanan Khera.</p>
          <a href="#" class="bc-link">Read Story <span>→</span></a>
        </div>
      </article>
      <article class="blog-card">
        <div class="bc-img"><div class="bc-placeholder bc-color-2">🎭</div><span class="bc-category">Culture</span></div>
        <div class="bc-body">
          <time class="bc-date">28 Jan 2025</time>
          <h3 class="bc-title"><a href="#">The Last Bhangra Master of Chanan Khera</a></h3>
          <p class="bc-excerpt">At 82, Gurdev Singh ji is the last keeper of a rare bhangra style that could vanish with him.</p>
          <a href="#" class="bc-link">Read Story <span>→</span></a>
        </div>
      </article>
      <article class="blog-card">
        <div class="bc-img"><div class="bc-placeholder bc-color-3">🕌</div><span class="bc-category">Heritage</span></div>
        <div class="bc-body">
          <time class="bc-date">5 Feb 2025</time>
          <h3 class="bc-title"><a href="#">Restoration of Our 300-Year-Old Gurdwara Begins</a></h3>
          <p class="bc-excerpt">Community effort brings new life to the ancient shrine that has witnessed five centuries of prayer.</p>
          <a href="#" class="bc-link">Read Story <span>→</span></a>
        </div>
      </article>
      @endforelse
    </div>
  </div>
</section>

<!-- ═══ BENEFITS ═══ -->
<section class="benefits-section">
  <div class="benefits-bg"></div>
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <div class="section-tag">Why Village Life?</div>
      <h2 class="section-title">The Real <em>Benefits</em><br>of Living in Chanan Khera</h2>
    </div>
    <div class="benefits-grid" data-aos="fade-up" data-aos-delay="200">
      @foreach([
        ['🫁','Pure Air & Health','Breathe air untouched by pollution. Village life is proven to reduce stress, anxiety and respiratory illness significantly.'],
        ['🤝','True Community','Know every neighbor by name. Village bonds create lifelong support networks that cities can never replicate.'],
        ['🥦','Farm-to-Table Food','Eat vegetables grown without chemicals, dairy from your own buffalo, and grains ground fresh — taste the difference.'],
        ['🧘','Slower, Richer Life','Time moves at a human pace. Children play outdoors, elders are honored, and life\'s priorities become crystal clear.'],
        ['💰','Affordable Living','Housing, food, transport — a fraction of city costs. Live fully on what city life calls a minimal budget.'],
        ['🌱','Sustainable Living','Solar, rain harvesting, composting, minimal waste — villages naturally model what cities desperately try to learn.'],
      ] as [$icon,$title,$desc])
      <div class="benefit-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
        <div class="benefit-icon">{{ $icon }}</div>
        <h3 class="benefit-title">{{ $title }}</h3>
        <p class="benefit-desc">{{ $desc }}</p>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- ═══ CTA BANNER ═══ -->
<section class="cta-banner">
  <div class="cta-banner-inner" data-aos="zoom-in">
    <div class="cta-banner-text">
      <h2>Come Visit <em>Chanan Khera</em></h2>
      <p>Experience the magic of Punjab village life — stay with us, celebrate with us, belong with us.</p>
    </div>
    <div class="cta-banner-btns">
      <a href="{{ route('contact') }}" class="hbtn hbtn-gold">Plan Your Visit</a>
      <a href="{{ route('gallery.index') }}" class="hbtn hbtn-outline-dark">View Gallery</a>
    </div>
  </div>
</section>

<!-- Video Modal -->
<div class="video-modal" id="videoModal">
  <div class="vm-backdrop" onclick="closeVideo()"></div>
  <div class="vm-container">
    <button class="vm-close" onclick="closeVideo()">✕</button>
    <div class="vm-frame" id="vmFrame"></div>
  </div>
</div>

@endsection

@section('scripts')
<script>
// Hero Swiper
new Swiper('.heroSwiper', {
  loop: true, speed: 1200,
  parallax: true,
  autoplay: { delay: 5500, disableOnInteraction: false },
  pagination: { el: '.hero-pagination', clickable: true },
  navigation: { prevEl: '.hero-prev', nextEl: '.hero-next' },
  effect: 'fade',
  fadeEffect: { crossFade: true }
});

// Activities Swiper
new Swiper('.actSwiper', {
  slidesPerView: 1, spaceBetween: 20,
  loop: true, autoplay: { delay: 3500 },
  pagination: { el: '.act-pagination', clickable: true },
  breakpoints: {
    640: { slidesPerView: 2 },
    900: { slidesPerView: 3 },
    1200: { slidesPerView: 4 }
  }
});

// Culture tabs
document.querySelectorAll('.ctab').forEach(btn => {
  btn.addEventListener('click', () => {
    document.querySelectorAll('.ctab').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.ctab-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
  });
});

// Count up animation
function countUp(el) {
  const target = parseInt(el.dataset.count);
  const dur = 2000; const step = dur / target;
  let current = 0;
  const timer = setInterval(() => {
    current += Math.ceil(target / 80);
    if (current >= target) { el.textContent = target + '+'; clearInterval(timer); }
    else el.textContent = current;
  }, step);
}
const observer = new IntersectionObserver(entries => {
  entries.forEach(e => { if(e.isIntersecting) { countUp(e.target); observer.unobserve(e.target); } });
});
document.querySelectorAll('[data-count]').forEach(el => observer.observe(el));

// Video modal
function playVideo(url) {
  const embed = url.includes('youtube') ? url.replace('watch?v=','embed/') + '?autoplay=1' : url;
  document.getElementById('vmFrame').innerHTML = `<iframe src="${embed}" frameborder="0" allowfullscreen></iframe>`;
  document.getElementById('videoModal').classList.add('active');
}
function closeVideo() {
  document.getElementById('videoModal').classList.remove('active');
  document.getElementById('vmFrame').innerHTML = '';
}
</script>
@endsection
