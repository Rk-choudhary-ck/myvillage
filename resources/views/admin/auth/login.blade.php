<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login — Chanan Khera</title>
<link href="https://fonts.googleapis.com/css2?family=Yeseva+One&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
    font-family: 'Inter', sans-serif;
    background: #0a1505;
    min-height: 100vh;
    display: flex;
    overflow: hidden;
  }
  /* Left Panel */
  .login-visual {
    flex: 1;
    position: relative;
    background: linear-gradient(160deg, #0a2a05 0%, #1a5c10 40%, #2d8a1a 70%, #0f3a08 100%);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 60px;
    overflow: hidden;
  }
  .lv-circles {
    position: absolute; inset: 0;
  }
  .lv-c {
    position: absolute;
    border-radius: 50%;
    border: 1px solid rgba(255,255,255,0.06);
    animation: rotateSlow linear infinite;
  }
  .lv-c:nth-child(1) { width: 300px; height: 300px; top: -50px; left: -50px; animation-duration: 30s; }
  .lv-c:nth-child(2) { width: 500px; height: 500px; bottom: -150px; right: -150px; animation-duration: 45s; animation-direction: reverse; }
  .lv-c:nth-child(3) { width: 200px; height: 200px; top: 50%; right: 100px; animation-duration: 25s; }
  @keyframes rotateSlow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }

  .lv-floating {
    position: absolute;
    font-size: 36px;
    opacity: 0.3;
    animation: floatAround 6s ease-in-out infinite;
  }
  @keyframes floatAround {
    0%,100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
  }
  .lv-floating:nth-child(4) { top: 15%; left: 15%; animation-delay: 0s; }
  .lv-floating:nth-child(5) { top: 25%; right: 20%; animation-delay: 1s; }
  .lv-floating:nth-child(6) { bottom: 30%; left: 20%; animation-delay: 2s; }
  .lv-floating:nth-child(7) { bottom: 15%; right: 15%; animation-delay: 3s; }

  .lv-content {
    position: relative;
    z-index: 1;
    text-align: center;
    color: white;
  }
  .lv-logo-punjabi {
    font-family: 'Yeseva One', serif;
    font-size: 52px;
    color: rgba(255,255,255,0.95);
    line-height: 1;
    text-shadow: 0 4px 30px rgba(0,0,0,0.4);
    margin-bottom: 8px;
  }
  .lv-logo-eng {
    font-size: 18px;
    letter-spacing: 6px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.6);
    margin-bottom: 50px;
  }
  .lv-tagline {
    font-size: 28px;
    font-weight: 300;
    line-height: 1.4;
    color: rgba(255,255,255,0.85);
    max-width: 380px;
  }
  .lv-tagline em {
    font-style: italic;
    color: #a8e063;
  }
  .lv-features {
    margin-top: 50px;
    display: flex;
    flex-direction: column;
    gap: 16px;
    text-align: left;
  }
  .lv-feat {
    display: flex;
    align-items: center;
    gap: 14px;
    color: rgba(255,255,255,0.7);
    font-size: 14px;
  }
  .lv-feat-icon {
    width: 36px; height: 36px;
    background: rgba(255,255,255,0.1);
    border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
  }

  /* Right Panel — Login Form */
  .login-form-panel {
    width: 480px;
    flex-shrink: 0;
    background: #fff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    padding: 60px 50px;
    position: relative;
  }
  .login-form-panel::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 4px;
    background: linear-gradient(to right, #1a5c10, #a8e063, #1a5c10);
  }
  .form-header { margin-bottom: 40px; }
  .form-welcome {
    font-size: 13px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: #6b8c5c;
    margin-bottom: 12px;
  }
  .form-title {
    font-family: 'Yeseva One', serif;
    font-size: 36px;
    color: #0f2a08;
    line-height: 1.2;
  }
  .form-subtitle {
    font-size: 14px;
    color: #888;
    margin-top: 8px;
  }

  .form-group {
    margin-bottom: 22px;
  }
  .form-label {
    display: block;
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #444;
    margin-bottom: 8px;
  }
  .form-input-wrap {
    position: relative;
  }
  .form-input-icon {
    position: absolute;
    left: 16px; top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    color: #aaa;
  }
  .form-input {
    width: 100%;
    padding: 14px 16px 14px 46px;
    border: 2px solid #e8e8e8;
    border-radius: 10px;
    font-size: 15px;
    font-family: 'Inter', sans-serif;
    color: #222;
    background: #fafafa;
    transition: border-color 0.3s, box-shadow 0.3s, background 0.3s;
    outline: none;
  }
  .form-input:focus {
    border-color: #2d8a1a;
    background: #fff;
    box-shadow: 0 0 0 4px rgba(45,138,26,0.1);
  }
  .form-input.is-invalid { border-color: #e53e3e; }
  .invalid-feedback { color: #e53e3e; font-size: 12px; margin-top: 6px; }

  .form-options {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 28px;
    font-size: 13px;
  }
  .form-check { display: flex; align-items: center; gap: 8px; cursor: pointer; color: #555; }
  .form-check input { accent-color: #2d8a1a; width: 16px; height: 16px; cursor: pointer; }
  .form-forgot { color: #2d8a1a; text-decoration: none; font-weight: 500; }
  .form-forgot:hover { text-decoration: underline; }

  .btn-login {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #1a5c10, #2d8a1a);
    color: white;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    font-weight: 600;
    letter-spacing: 1px;
    cursor: pointer;
    transition: transform 0.2s, box-shadow 0.3s;
    position: relative;
    overflow: hidden;
  }
  .btn-login::before {
    content: '';
    position: absolute;
    top: 0; left: -100%; width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
    transition: left 0.5s;
  }
  .btn-login:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(45,138,26,0.4); }
  .btn-login:hover::before { left: 100%; }
  .btn-login:active { transform: translateY(0); }

  .form-divider {
    display: flex; align-items: center; gap: 16px;
    margin: 24px 0; color: #ccc; font-size: 12px;
  }
  .form-divider::before, .form-divider::after {
    content: ''; flex: 1; height: 1px; background: #e8e8e8;
  }

  .form-back {
    text-align: center;
    margin-top: 20px;
    font-size: 13px;
    color: #888;
  }
  .form-back a { color: #2d8a1a; text-decoration: none; font-weight: 500; }

  .alert-error {
    background: #fff5f5; border: 1px solid #fed7d7;
    border-radius: 8px; padding: 12px 16px;
    color: #c53030; font-size: 13px; margin-bottom: 20px;
    display: flex; align-items: center; gap: 10px;
  }

  @media (max-width: 900px) {
    .login-visual { display: none; }
    .login-form-panel { width: 100%; }
  }
</style>
</head>
<body>

<div class="login-visual">
  <div class="lv-circles">
    <div class="lv-c"></div>
    <div class="lv-c"></div>
    <div class="lv-c"></div>
  </div>
  <span class="lv-floating">🌾</span>
  <span class="lv-floating">🏡</span>
  <span class="lv-floating">🕌</span>
  <span class="lv-floating">🌿</span>
  <div class="lv-content">
    <div class="lv-logo-punjabi">ਚਾਨਣ ਖੇੜਾ</div>
    <div class="lv-logo-eng">Chanan Khera</div>
    <p class="lv-tagline">Manage the <em>digital heartbeat</em> of our village</p>
    <div class="lv-features">
      <div class="lv-feat"><div class="lv-feat-icon">📝</div><span>Create & publish blog stories</span></div>
      <div class="lv-feat"><div class="lv-feat-icon">📍</div><span>Manage famous places & galleries</span></div>
      <div class="lv-feat"><div class="lv-feat-icon">🎬</div><span>Upload photos and videos</span></div>
      <div class="lv-feat"><div class="lv-feat-icon">⚙️</div><span>Control all website content</span></div>
    </div>
  </div>
</div>

<div class="login-form-panel">
  <div class="form-header">
    <div class="form-welcome">Admin Portal</div>
    <h1 class="form-title">Welcome Back</h1>
    <p class="form-subtitle">Sign in to manage Chanan Khera Village</p>
  </div>

  @if(session('error'))
  <div class="alert-error">⚠️ {{ session('error') }}</div>
  @endif

  @if($errors->any())
  <div class="alert-error">⚠️ {{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('admin.login.post') }}">
    @csrf
    <div class="form-group">
      <label class="form-label" for="email">Email Address</label>
      <div class="form-input-wrap">
        <span class="form-input-icon">✉</span>
        <input type="email" name="email" id="email"
               class="form-input {{ $errors->has('email') ? 'is-invalid' : '' }}"
               value="{{ old('email') }}" placeholder="admin@chanankhera.in"
               required autocomplete="email" autofocus>
      </div>
      @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="password">Password</label>
      <div class="form-input-wrap">
        <span class="form-input-icon">🔒</span>
        <input type="password" name="password" id="password"
               class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}"
               placeholder="Enter your password"
               required autocomplete="current-password">
      </div>
      @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-options">
      <label class="form-check">
        <input type="checkbox" name="remember"> Remember me
      </label>
      <a href="#" class="form-forgot">Forgot password?</a>
    </div>

    <button type="submit" class="btn-login">Sign In to Admin Panel</button>
  </form>

  <div class="form-back">
    <a href="{{ route('home') }}">← Back to Village Website</a>
  </div>
</div>

</body>
</html>
