@extends('layouts.public')
@section('title', 'Login Admin')

@push('styles')
<style>
  .login-wrap{
    position: relative;
    background: #f6f8fc;
    padding: 70px 0 140px;
    overflow: hidden;
    min-height: calc(100vh - 220px);
  }

  #ribbon-canvas{
    position: absolute;
    left: 0;
    right: 0;
    bottom: -20px;
    height: 260px;
    width: 100%;
    z-index: 1;
    pointer-events: none;
  }

  .login-inner{
    position: relative;
    z-index: 2;
  }

  .login-card{
    position: relative;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    background: rgba(255,255,255,.92);
    backdrop-filter: blur(8px);
    box-shadow: 0 18px 50px rgba(17,24,39,.10);
    overflow: hidden;
  }

  .aurora{
    position: absolute;
    inset: -40%;
    z-index: 0;
    pointer-events: none;
    filter: blur(32px);
    opacity: .9;
    background:
      radial-gradient(480px 220px at 30% 30%, rgba(13,110,253,.55), transparent 60%),
      radial-gradient(520px 240px at 70% 40%, rgba(0,210,255,.45), transparent 62%),
      radial-gradient(500px 260px at 45% 75%, rgba(99,102,241,.40), transparent 65%),
      radial-gradient(420px 220px at 78% 78%, rgba(21,199,167,.30), transparent 60%);
    animation: auroraMove 6s ease-in-out infinite;
    transform: translate3d(0,0,0);
  }

  @keyframes auroraMove{
    0%   { transform: translate3d(-6%, -4%, 0) rotate(0deg) scale(1.05); }
    50%  { transform: translate3d(6%, 3%, 0) rotate(8deg) scale(1.12); }
    100% { transform: translate3d(-6%, -4%, 0) rotate(0deg) scale(1.05); }
  }

  .login-head,
  .login-body{
    position: relative;
    z-index: 2;
  }

  .login-head{
    padding: 18px 20px 12px;
    border-bottom: 1px solid rgba(238,242,247,.85);
    background: linear-gradient(180deg, rgba(255,255,255,.88), rgba(248,250,252,.75));
  }

  .login-logo{
    width: 56px;
    height: 56px;
    object-fit: contain;
    display: block;
    margin: 4px auto 10px;
    filter: drop-shadow(0 8px 18px rgba(13,110,253,.12));
  }

  .login-head h3{
    margin: 0;
    font-weight: 900;
    letter-spacing: -.01em;
    color: #0b2a5a;
    font-size: 20px;
    text-align: center;
  }

  .login-head p{
    margin: 6px 0 0;
    color: #6b7280;
    font-size: 13px;
    text-align: center;
  }

  .login-body{
    padding: 18px 20px 20px;
  }

  .form-control{
    border-radius: 14px;
    padding: .65rem .85rem;
    border: 1px solid rgba(229,231,235,.95);
  }

  .form-control:focus{
    border-color: rgba(13,110,253,.45);
    box-shadow: 0 0 0 .2rem rgba(13,110,253,.12);
  }

  .btn{
    border-radius: 14px;
    font-weight: 800;
    padding: .65rem 1rem;
  }

  .password-wrap{
    position: relative;
  }

  .password-input{
    padding-right: 48px;
  }

  .password-toggle{
    position: absolute;
    top: 50%;
    right: 12px;
    transform: translateY(-50%);
    border: none;
    background: transparent;
    padding: 0;
    width: 22px;
    height: 22px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: #9ca3af;
    line-height: 1;
    transition: color .2s ease;
  }

  .password-toggle:hover{
    color: #6b7280;
  }

  .password-toggle:focus{
    outline: none;
    box-shadow: none;
  }

  .password-toggle svg{
    display: block;
  }

  @media (prefers-reduced-motion: reduce){
    #ribbon-canvas{ display:none; }
    .aurora{ animation:none; }
  }
</style>
@endpush

@section('content')
<section class="login-wrap">
  <canvas id="ribbon-canvas"></canvas>

  <div class="container login-inner">
    <div class="row justify-content-center">
      <div class="col-12 col-md-7 col-lg-5">
        <div class="login-card">
          <div class="aurora"></div>

          <div class="login-head">
            <img src="{{ asset('logo.png') }}" alt="Logo" class="login-logo">
            <h3>Login Admin</h3>
            <p>Masukkan username dan password untuk masuk.</p>
          </div>

          <div class="login-body">
            <form method="POST" action="{{ route('admin.login.submit') }}" autocomplete="off">
              @csrf

              <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input
                  type="text"
                  id="username"
                  name="username"
                  class="form-control @error('username') is-invalid @enderror"
                  value=""
                  autocomplete="off"
                  autocapitalize="off"
                  spellcheck="false"
                  required
                >
                @error('username')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>

                <div class="password-wrap">
                  <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control password-input @error('password') is-invalid @enderror"
                    value=""
                    autocomplete="new-password"
                    required
                  >

                  <button
                    type="button"
                    class="password-toggle"
                    id="togglePassword"
                    aria-label="Tampilkan password"
                    aria-pressed="false"
                  >
                    <!-- Icon mata tertutup -->
                    <svg id="eyeClose" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                      <path d="M3 3L21 21" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                      <path d="M10.58 10.58A2 2 0 0 0 13.41 13.41" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                      <path d="M9.88 5.08A10.94 10.94 0 0 1 12 4.9c6.5 0 10 7.1 10 7.1a17.56 17.56 0 0 1-4.04 4.95" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M6.61 6.61A17.34 17.34 0 0 0 2 12s3.5 7.1 10 7.1a10.7 10.7 0 0 0 4.25-.82" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>

                    <!-- Icon mata terbuka -->
                    <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true" style="display:none;">
                      <path d="M2 12S5.5 5.5 12 5.5 22 12 22 12s-3.5 6.5-10 6.5S2 12 2 12Z" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                      <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.8"/>
                    </svg>
                  </button>
                </div>

                @error('password')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </form>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary w-100 mt-3">← Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const username = document.getElementById('username');
  const password = document.getElementById('password');

  if (username) username.value = '';
  if (password) password.value = '';

  const togglePassword = document.getElementById('togglePassword');
  const eyeOpen = document.getElementById('eyeOpen');
  const eyeClose = document.getElementById('eyeClose');

  if (togglePassword && password) {
    togglePassword.addEventListener('click', function () {
      const isHidden = password.type === 'password';
      password.type = isHidden ? 'text' : 'password';

      if (eyeOpen && eyeClose) {
        eyeOpen.style.display = isHidden ? 'block' : 'none';
        eyeClose.style.display = isHidden ? 'none' : 'block';
      }

      togglePassword.setAttribute(
        'aria-label',
        isHidden ? 'Sembunyikan password' : 'Tampilkan password'
      );

      togglePassword.setAttribute(
        'aria-pressed',
        isHidden ? 'true' : 'false'
      );
    });
  }

  const canvas = document.getElementById('ribbon-canvas');
  const section = canvas?.closest('.login-wrap');
  if (!canvas || !section) return;

  const ctx = canvas.getContext('2d');
  const dpr = Math.min(2, window.devicePixelRatio || 1);
  let w = 0, h = 260, t = 0;

  function resize() {
    const r = section.getBoundingClientRect();
    w = Math.floor(r.width);
    canvas.width = w * dpr;
    canvas.height = h * dpr;
    canvas.style.width = w + 'px';
    canvas.style.height = h + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function draw({ y, amp, speed, thick, c1, c2, a }) {
    const pts = [];
    const step = 18;
    const time = t * speed;

    for (let x = -60; x <= w + 60; x += step) {
      const yv = h * y + Math.sin(x / 220 + time) * amp;
      pts.push({ x, y: yv });
    }

    const top = [];
    const bot = [];

    pts.forEach((p, i) => {
      const th = thick + Math.sin(i * 0.3 + time) * 3;
      top.push({ x: p.x, y: p.y - th });
      bot.push({ x: p.x, y: p.y + th });
    });

    const g = ctx.createLinearGradient(0, 0, w, h);
    g.addColorStop(0, c1);
    g.addColorStop(1, c2);

    ctx.globalAlpha = a;
    ctx.beginPath();
    ctx.moveTo(top[0].x, top[0].y);
    top.forEach(p => ctx.lineTo(p.x, p.y));
    bot.reverse().forEach(p => ctx.lineTo(p.x, p.y));
    ctx.closePath();
    ctx.fillStyle = g;
    ctx.fill();
    ctx.globalAlpha = 1;
  }

  function loop() {
    ctx.clearRect(0, 0, w, h);

    draw({
      y: .55,
      amp: 32,
      speed: .04,
      thick: 18,
      c1: 'rgba(0,195,255,.9)',
      c2: 'rgba(13,110,253,.9)',
      a: .55
    });

    draw({
      y: .40,
      amp: 22,
      speed: .03,
      thick: 12,
      c1: 'rgba(0,210,255,.7)',
      c2: 'rgba(99,102,241,.7)',
      a: .35
    });

    t++;
    requestAnimationFrame(loop);
  }

  resize();
  window.addEventListener('resize', resize);
  loop();
});
</script>
@endpush