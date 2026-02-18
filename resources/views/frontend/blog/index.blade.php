{{-- resources/views/frontend/blog/index.blade.php --}}
@extends('layouts.app')
@section('title','Village Stories — Chanan Khera')
@section('content')
<section style="padding:140px 0 80px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Chronicles</div>
    <h1 class="section-title light" style="margin-top:8px">Village <em>Stories</em></h1>
  </div>
</section>
<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <!-- Search & Filter -->
    <div style="display:flex;gap:12px;margin-bottom:40px;flex-wrap:wrap;align-items:center">
      <form method="GET" style="flex:1;display:flex;gap:8px">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search stories..." class="admin-input" style="flex:1;border:1.5px solid var(--border);border-radius:8px;padding:10px 16px;font-family:'Josefin Sans',sans-serif">
        <button type="submit" class="cta-btn" style="padding:10px 20px;font-size:12px">Search</button>
      </form>
    </div>
    <div style="display:flex;gap:8px;flex-wrap:wrap;margin-bottom:32px">
      <a href="{{ route('blog.index') }}" class="cta-btn" style="padding:7px 18px;font-size:11px;{{ !request('category') ? '' : 'background:var(--sage)' }}">All</a>
      @foreach($categories as $cat)
      <a href="{{ route('blog.category', $cat) }}" class="cta-btn" style="padding:7px 18px;font-size:11px;background:var(--sage)">{{ $cat }}</a>
      @endforeach
    </div>
    <div class="blog-grid">
      @forelse($blogs as $post)
      <article class="blog-card {{ $loop->first && !request('search') ? 'blog-card-featured' : '' }}">
        <div class="bc-img">
          @if($post->thumbnail)
          <img src="{{ Storage::url($post->thumbnail) }}" alt="{{ $post->title }}" loading="lazy">
          @else
          <div class="bc-placeholder bc-color-{{ ($loop->index % 4) + 1 }}">📖</div>
          @endif
          <span class="bc-category">{{ $post->category }}</span>
        </div>
        <div class="bc-body">
          <time class="bc-date">{{ $post->created_at->format('d M Y') }}</time>
          <h3 class="bc-title"><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h3>
          <p class="bc-excerpt">{{ Str::limit($post->excerpt, 120) }}</p>
          <a href="{{ route('blog.show', $post->slug) }}" class="bc-link">Read Story <span>→</span></a>
        </div>
      </article>
      @empty
      <div style="grid-column:1/-1;text-align:center;padding:60px;color:var(--text-muted)">
        <div style="font-size:60px;margin-bottom:16px">📖</div>
        <h3>No stories yet</h3>
      </div>
      @endforelse
    </div>
    <div style="margin-top:40px;text-align:center">{{ $blogs->links() }}</div>
  </div>
</section>
@endsection
