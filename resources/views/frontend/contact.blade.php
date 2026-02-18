@extends('layouts.app')
@section('title','Contact — Chanan Khera')
@section('content')
<section style="padding:140px 0 80px;background:var(--green-deep)">
  <div class="container" style="text-align:center">
    <div class="section-tag light">Get In Touch</div>
    <h1 class="section-title light" style="margin-top:8px">Contact <em>Us</em></h1>
  </div>
</section>
<section style="padding:80px 0;background:var(--cream)">
  <div class="container">
    <div style="display:grid;grid-template-columns:1fr 1.2fr;gap:60px;max-width:1100px;margin:0 auto">
      <div>
        <h3 style="font-family:'Yeseva One',serif;font-size:28px;color:var(--green-deep);margin-bottom:24px">Village Information</h3>
        @foreach(['📍 Chanan Khera Village, Punjab, India','📞 +91 XXXXX XXXXX','✉ info@chanankhera.in','🌐 www.chanankhera.in'] as $info)
        <div style="display:flex;align-items:center;gap:12px;padding:16px;background:white;border-radius:10px;margin-bottom:12px;font-size:14px;color:var(--text-muted)">{{ $info }}</div>
        @endforeach
        <div style="margin-top:32px;padding:28px;background:linear-gradient(135deg,#0a2a05,#1a5c10);border-radius:16px;color:white;text-align:center">
          <div style="font-size:40px;margin-bottom:12px">🕌</div>
          <h4 style="font-family:'Yeseva One',serif;font-size:22px;margin-bottom:8px">Visit Us</h4>
          <p style="font-size:14px;opacity:0.75;line-height:1.6">Our village is open to visitors. Come experience the warmth of Punjabi hospitality.</p>
        </div>
      </div>
      <div>
        @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #bbf7d0;color:#166534;padding:16px;border-radius:10px;margin-bottom:24px">✅ {{ session('success') }}</div>
        @endif
        <form method="POST" action="{{ route('contact.submit') }}" style="background:white;padding:36px;border-radius:16px;box-shadow:0 4px 30px rgba(0,0,0,0.06)">
          @csrf
          <h3 style="font-family:'Yeseva One',serif;font-size:24px;color:var(--green-deep);margin-bottom:24px">Send a Message</h3>
          @foreach([['name','Your Name','text'],['email','Email Address','email'],['subject','Subject','text']] as [$n,$p,$t])
          <div style="margin-bottom:16px">
            <label style="display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#4b5563;margin-bottom:6px">{{ $p }}</label>
            <input type="{{ $t }}" name="{{ $n }}" placeholder="{{ $p }}" value="{{ old($n) }}"
                   style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:8px;font-size:14px;font-family:'Josefin Sans',sans-serif;outline:none;transition:0.2s"
                   onfocus="this.style.borderColor='#1a5c10'" onblur="this.style.borderColor='#e5e7eb'">
            @error($n)<div style="color:#ef4444;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
          </div>
          @endforeach
          <div style="margin-bottom:24px">
            <label style="display:block;font-size:12px;font-weight:600;text-transform:uppercase;letter-spacing:1px;color:#4b5563;margin-bottom:6px">Message</label>
            <textarea name="message" rows="5" placeholder="Write your message here..."
                      style="width:100%;padding:11px 14px;border:1.5px solid #e5e7eb;border-radius:8px;font-size:14px;font-family:'Josefin Sans',sans-serif;outline:none;resize:vertical;transition:0.2s"
                      onfocus="this.style.borderColor='#1a5c10'" onblur="this.style.borderColor='#e5e7eb'">{{ old('message') }}</textarea>
            @error('message')<div style="color:#ef4444;font-size:12px;margin-top:4px">{{ $message }}</div>@enderror
          </div>
          <button type="submit" class="cta-btn" style="width:100%;padding:14px;font-size:13px;border:none;cursor:pointer">Send Message →</button>
        </form>
      </div>
    </div>
  </div>
</section>
@endsection
