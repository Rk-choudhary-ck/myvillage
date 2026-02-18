{{-- Blog Show --}}
@extends('layouts.app')
@section('title', $blog->title . ' — Chanan Khera')
@section('content')
<section style="padding:140px 0 60px;background:var(--green-deep)">
  <div class="container" style="max-width:860px">
    <span class="section-tag light">{{ $blog->category }}</span>
    <h1 style="font-family:'Yeseva One',serif;font-size:clamp(32px,5vw,58px);color:white;line-height:1.1;margin-top:12px">{{ $blog->title }}</h1>
    <div style="display:flex;gap:20px;margin-top:20px;color:rgba(255,255,255,0.6);font-size:13px;flex-wrap:wrap">
      <span>✍️ {{ $blog->author }}</span>
      <span>📅 {{ $blog->created_at->format('d F Y') }}</span>
      <span>👁 {{ number_format($blog->views) }} views</span>
    </div>
  </div>
</section>
<section style="padding:60px 0;background:var(--cream)">
  <div class="container" style="max-width:860px">
    @if($blog->thumbnail)
    <img src="{{ Storage::url($blog->thumbnail) }}" alt="{{ $blog->title }}" style="width:100%;border-radius:16px;margin-bottom:40px;max-height:480px;object-fit:cover">
    @endif
    <div style="font-family:'Lora',serif;font-size:19px;font-style:italic;color:var(--clay);line-height:1.7;margin-bottom:32px;padding:24px;border-left:4px solid var(--gold);background:rgba(212,168,67,0.05);border-radius:0 12px 12px 0">
      {{ $blog->excerpt }}
    </div>
    <div style="font-size:16px;line-height:1.9;color:var(--text);font-family:'Lora',serif" class="blog-content">
      {!! $blog->content !!}
    </div>
    @if($blog->tags)
    <div style="margin-top:40px;padding-top:32px;border-top:1px solid var(--border)">
      <strong style="font-size:12px;letter-spacing:2px;text-transform:uppercase;color:var(--sage)">Tags:</strong>
      <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:10px">
        @foreach(explode(',',$blog->tags) as $tag)
        <span style="padding:5px 14px;background:rgba(45,138,26,0.1);border-radius:20px;font-size:12px;color:var(--green-mid)">{{ trim($tag) }}</span>
        @endforeach
      </div>
    </div>
    @endif
    @if($related->isNotEmpty())
    <div style="margin-top:60px">
      <h3 style="font-family:'Yeseva One',serif;font-size:28px;margin-bottom:24px">More Stories</h3>
      <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px">
        @foreach($related as $post)
        <div class="blog-card">
          <div class="bc-img"><div class="bc-placeholder bc-color-{{ ($loop->index % 4) + 1 }}">📖</div><span class="bc-category">{{ $post->category }}</span></div>
          <div class="bc-body">
            <h3 class="bc-title" style="font-size:16px"><a href="{{ route('blog.show', $post->slug) }}">{{ Str::limit($post->title, 60) }}</a></h3>
            <a href="{{ route('blog.show', $post->slug) }}" class="bc-link">Read →</a>
          </div>
        </div>
        @endforeach
      </div>
    </div>
    @endif
    <div style="margin-top:40px">
      <a href="{{ route('blog.index') }}" class="cta-btn">← All Stories</a>
    </div>
  </div>
</section>
<style>
.blog-content h2 { font-family:'Yeseva One',serif; font-size:28px; margin:32px 0 14px; color:var(--green-deep); }
.blog-content h3 { font-family:'Yeseva One',serif; font-size:22px; margin:24px 0 12px; color:var(--green-deep); }
.blog-content p  { margin-bottom:18px; }
.blog-content blockquote { border-left:4px solid var(--gold); padding:16px 24px; margin:24px 0; background:rgba(212,168,67,0.05); font-style:italic; border-radius:0 8px 8px 0; }
.blog-content ul, .blog-content ol { margin:16px 0 16px 24px; }
.blog-content li { margin-bottom:8px; }
.blog-content img { border-radius:12px; margin:20px 0; max-width:100%; }
</style>
@endsection
