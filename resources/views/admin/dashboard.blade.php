@extends('layouts.public')
@section('title', 'Dashboard Admin')

@push('styles')
<style>
  :root{
    --primary:#1f6feb;
    --primary-2:#3b82f6;
    --primary-soft:#eaf3ff;
    --success:#22c55e;
    --warning:#f59e0b;
    --info:#38bdf8;
    --dark:#0f172a;
    --text:#24324a;
    --muted:#7b8aa0;
    --border:#e6edf7;
    --bg:#f4f7fc;
    --white:#ffffff;
    --shadow:0 14px 32px rgba(31,111,235,.08);
    --shadow-lg:0 22px 48px rgba(15,23,42,.12);
  }

  body{
    background:var(--bg);
  }

  .admin-shell{
    display:grid;
    grid-template-columns:280px 1fr;
    gap:22px;
    min-height:calc(100vh - 40px);
  }

  .admin-sidebar{
    position:sticky;
    top:20px;
    height:calc(100vh - 40px);
    background:linear-gradient(180deg,#f8fbff 0%,#eef4ff 100%);
    border:1px solid var(--border);
    border-radius:28px;
    box-shadow:var(--shadow);
    padding:20px 16px;
    display:flex;
    flex-direction:column;
    justify-content:space-between;
    overflow:hidden;
  }

  .admin-sidebar::before{
    content:"";
    position:absolute;
    inset:auto -80px -80px auto;
    width:220px;
    height:220px;
    border-radius:50%;
    background:radial-gradient(circle, rgba(59,130,246,.18) 0%, rgba(59,130,246,0) 70%);
    pointer-events:none;
  }

  .brand-wrap{
    display:flex;
    align-items:center;
    gap:12px;
    margin-bottom:18px;
  }

  .brand-logo{
    width:48px;
    height:48px;
    border-radius:16px;
    display:grid;
    place-items:center;
    background:linear-gradient(135deg,#d9e9ff,#ffffff);
    box-shadow:inset 0 1px 0 rgba(255,255,255,.7);
    overflow:hidden;
  }

  .brand-logo img{
    width:34px;
    height:34px;
    object-fit:contain;
  }

  .brand-title{
    margin:0;
    font-size:15px;
    font-weight:800;
    line-height:1.35;
    color:#1c2b49;
  }

  .brand-sub{
    margin:2px 0 0;
    font-size:12px;
    color:var(--muted);
  }

  .menu-group-title{
    font-size:11px;
    font-weight:800;
    text-transform:uppercase;
    letter-spacing:.08em;
    color:#92a4bd;
    margin:16px 10px 8px;
  }

  .menu-list{
    display:grid;
    gap:8px;
  }

  .menu-item{
    display:flex;
    align-items:center;
    gap:12px;
    padding:13px 14px;
    border-radius:16px;
    color:#38506b;
    text-decoration:none;
    font-weight:700;
    transition:.18s ease;
    border:1px solid transparent;
  }

  .menu-item:hover{
    background:#edf5ff;
    border-color:#d7e8ff;
    color:var(--primary);
    transform:translateY(-1px);
  }

  .menu-item.active{
    background:linear-gradient(135deg,#dceaff,#eef5ff);
    color:var(--primary);
    border-color:#cfe2ff;
    box-shadow:0 8px 20px rgba(31,111,235,.08);
  }

  .menu-icon{
    width:34px;
    height:34px;
    border-radius:12px;
    display:grid;
    place-items:center;
    background:#fff;
    border:1px solid #e3edf9;
    font-size:16px;
    flex-shrink:0;
  }

  .sidebar-footer{
    display:grid;
    gap:10px;
  }

  .sidebar-user{
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px;
    border-radius:18px;
    background:#fff;
    border:1px solid var(--border);
    transition:.18s ease;
  }

  .sidebar-user:hover{
    background:#edf5ff;
    border-color:#d7e8ff;
    transform:translateY(-1px);
  }

  .sidebar-avatar{
    width:42px;
    height:42px;
    border-radius:50%;
    display:grid;
    place-items:center;
    font-weight:800;
    color:#fff;
    background:linear-gradient(135deg,#60a5fa,#1f6feb);
    overflow:hidden;
    flex-shrink:0;
  }

  .sidebar-avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }

  .logout-card{
    width:100%;
    display:flex;
    align-items:center;
    gap:12px;
    padding:12px 14px;
    border:none;
    border-radius:18px;
    background:#fff;
    border:1px solid var(--border);
    color:#ef4444;
    font-weight:800;
    box-shadow:var(--shadow);
    transition:.18s ease;
  }

  .logout-card:hover{
    background:#fff5f5;
    border-color:#fecaca;
  }

  .logout-icon{
    width:34px;
    height:34px;
    border-radius:12px;
    display:grid;
    place-items:center;
    background:#fff1f2;
    border:1px solid #ffe4e6;
    font-size:16px;
    flex-shrink:0;
  }

  .main-area{
    display:flex;
    flex-direction:column;
    gap:18px;
  }

  .topbar{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:14px;
  }

  .search-box{
    flex:1;
    display:flex;
    align-items:center;
    gap:12px;
    background:#fff;
    border:1px solid var(--border);
    height:58px;
    border-radius:999px;
    padding:0 18px;
    box-shadow:var(--shadow);
  }

  .search-box input{
    flex:1;
    border:0;
    outline:none;
    background:transparent;
    font-size:15px;
  }

  .topbar-actions{
    display:flex;
    align-items:center;
    gap:12px;
  }

  .icon-circle{
    width:48px;
    height:48px;
    border-radius:16px;
    display:grid;
    place-items:center;
    background:#fff;
    border:1px solid var(--border);
    box-shadow:var(--shadow);
    position:relative;
  }

  .notif-badge{
    position:absolute;
    top:-5px;
    right:-5px;
    min-width:22px;
    height:22px;
    padding:0 6px;
    border-radius:999px;
    display:grid;
    place-items:center;
    background:#ef4444;
    color:#fff;
    font-size:11px;
    font-weight:800;
    border:2px solid #fff;
  }

  .profile-pill{
    display:flex;
    align-items:center;
    gap:10px;
    padding:6px 12px 6px 6px;
    border-radius:999px;
    background:#fff;
    border:1px solid var(--border);
    box-shadow:var(--shadow);
  }

  .profile-pill .avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    display:grid;
    place-items:center;
    color:#fff;
    font-weight:800;
    background:linear-gradient(135deg,#93c5fd,#2563eb);
    overflow:hidden;
    flex-shrink:0;
  }

  .profile-pill .avatar img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }

  .hero-card{
    position:relative;
    overflow:hidden;
    border-radius:28px;
    background:
      linear-gradient(135deg, rgba(31,111,235,.96), rgba(59,130,246,.88)),
      url('{{ asset('dpmd.jpeg') }}');
    background-size:cover;
    background-position:center;
    color:#fff;
    padding:30px;
    box-shadow:var(--shadow-lg);
    min-height:180px;
  }

  .hero-card::before{
    content:"";
    position:absolute;
    top:-80px;
    right:-80px;
    width:240px;
    height:240px;
    border-radius:50%;
    background:radial-gradient(circle, rgba(255,255,255,.20) 0%, rgba(255,255,255,0) 72%);
  }

  .hero-card::after{
    content:"";
    position:absolute;
    bottom:-100px;
    left:-80px;
    width:260px;
    height:260px;
    border-radius:50%;
    background:radial-gradient(circle, rgba(255,255,255,.16) 0%, rgba(255,255,255,0) 72%);
  }

  .hero-content{
    position:relative;
    z-index:2;
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:20px;
    flex-wrap:wrap;
  }

  .hero-title{
    margin:0 0 8px;
    font-size:34px;
    font-weight:900;
    letter-spacing:-.03em;
  }

  .hero-desc{
    margin:0;
    font-size:15px;
    opacity:.92;
    max-width:620px;
  }

  .hero-actions{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
    margin-top:18px;
  }

  .hero-btn{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:11px 16px;
    border-radius:14px;
    font-weight:800;
    text-decoration:none;
    border:1px solid rgba(255,255,255,.22);
  }

  .hero-btn-light{
    background:#fff;
    color:var(--primary);
  }

  .hero-btn-outline{
    background:rgba(255,255,255,.12);
    color:#fff;
  }

  .hero-mini{
    min-width:220px;
    background:rgba(255,255,255,.14);
    border:1px solid rgba(255,255,255,.20);
    backdrop-filter:blur(6px);
    border-radius:20px;
    padding:16px;
  }

  .hero-mini small{
    display:block;
    opacity:.85;
    margin-bottom:6px;
  }

  .hero-mini strong{
    font-size:22px;
    font-weight:900;
  }

  .stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:16px;
  }

  .stat-card,
  .panel{
    background:#fff;
    border:1px solid var(--border);
    border-radius:22px;
    box-shadow:var(--shadow);
  }

  .stat-card{
    padding:18px;
    display:flex;
    align-items:center;
    gap:14px;
    min-height:108px;
    transition:.18s ease;
  }

  .stat-card:hover{
    transform:translateY(-3px);
    box-shadow:0 18px 34px rgba(31,111,235,.10);
  }

  .stat-icon{
    width:58px;
    height:58px;
    border-radius:18px;
    display:grid;
    place-items:center;
    color:#fff;
    font-size:22px;
    flex-shrink:0;
  }

  .bg-kec{ background:linear-gradient(135deg,#60a5fa,#2563eb); }
  .bg-desa{ background:linear-gradient(135deg,#4ade80,#16a34a); }
  .bg-bumdes{ background:linear-gradient(135deg,#fbbf24,#f59e0b); }
  .bg-produk{ background:linear-gradient(135deg,#67e8f9,#06b6d4); }

  .stat-number{
    margin:0;
    font-size:28px;
    line-height:1;
    font-weight:900;
    letter-spacing:-.03em;
    color:#142844;
  }

  .stat-label{
    margin:4px 0 0;
    font-size:14px;
    color:#51627a;
    font-weight:700;
  }

  .stat-growth{
    margin-top:7px;
    font-size:12px;
    color:var(--success);
    font-weight:800;
  }

  .content-grid{
    display:grid;
    grid-template-columns:2fr 1fr;
    gap:16px;
  }

  .panel{
    padding:20px;
  }

  .panel-head{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:12px;
    margin-bottom:14px;
  }

  .panel-title{
    margin:0;
    font-size:17px;
    font-weight:900;
    color:#1b2c49;
  }

  .panel-sub{
    font-size:13px;
    color:var(--muted);
  }

  .big-number{
    font-size:30px;
    font-weight:900;
    color:#132644;
    line-height:1;
  }

  .trend-up{
    color:var(--success);
    font-size:13px;
    font-weight:800;
  }

  .chart-wrap{
    height:260px;
    margin-top:8px;
  }

  .right-stack{
    display:grid;
    gap:16px;
  }

  .progress-line{
    width:100%;
    height:10px;
    border-radius:999px;
    background:#ebf2fb;
    overflow:hidden;
    margin-top:12px;
  }

  .progress-line span{
    display:block;
    height:100%;
    border-radius:999px;
    background:linear-gradient(90deg,#22c55e,#3b82f6);
  }

  .mini-stat{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
    margin-top:14px;
  }

  .mini-chip{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 12px;
    border-radius:999px;
    background:#f5f9ff;
    border:1px solid #e5eefb;
    color:#49607d;
    font-size:12px;
    font-weight:800;
  }

  .bottom-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 18px;
  align-items: stretch;
}

.bottom-grid .panel {
  height: 100%;
}

@media (max-width: 768px) {
  .bottom-grid {
    grid-template-columns: 1fr;
  }
}

  table{
    width:100%;
    border-collapse:collapse;
  }

  th,td{
    padding:12px 10px;
    border-bottom:1px solid #eef3fb;
    text-align:left;
    font-size:14px;
  }

  th{
    font-size:12px;
    text-transform:uppercase;
    letter-spacing:.04em;
    color:#7b8aa0;
    font-weight:800;
  }

  .rank-pill{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    width:34px;
    height:34px;
    border-radius:12px;
    color:#fff;
    font-weight:800;
    margin-right:10px;
    background:linear-gradient(135deg,#60a5fa,#1f6feb);
  }

  .list-stack{
    display:grid;
    gap:12px;
  }

  .list-item{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:10px;
    padding:12px;
    border:1px solid #edf3fb;
    border-radius:16px;
    background:#fbfdff;
  }

  .list-left{
    display:flex;
    align-items:center;
    gap:10px;
    min-width:0;
  }

  .small-avatar{
    width:38px;
    height:38px;
    border-radius:50%;
    display:grid;
    place-items:center;
    color:#fff;
    font-size:13px;
    font-weight:800;
    background:linear-gradient(135deg,#8ec5ff,#1f6feb);
    flex-shrink:0;
  }

  .list-title{
    margin:0;
    font-size:14px;
    font-weight:800;
    color:#1c2b49;
  }

  .list-sub{
    margin:2px 0 0;
    font-size:12px;
    color:var(--muted);
  }

  .list-value{
    font-weight:900;
    color:#132644;
    white-space:nowrap;
  }

  .shortcut-grid{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:14px;
  }

  .shortcut-card{
    display:flex;
    flex-direction:column;
    align-items:flex-start;
    gap:10px;
    text-decoration:none;
    padding:16px;
    border-radius:20px;
    background:#fff;
    border:1px solid var(--border);
    box-shadow:var(--shadow);
    transition:.18s ease;
    color:inherit;
  }

  .shortcut-card:hover{
    transform:translateY(-3px);
    box-shadow:0 18px 34px rgba(31,111,235,.10);
    border-color:#d8e8ff;
  }

  .shortcut-icon{
    width:44px;
    height:44px;
    border-radius:14px;
    display:grid;
    place-items:center;
    background:linear-gradient(135deg,#e8f2ff,#f8fbff);
    border:1px solid #dbeafe;
    font-size:20px;
  }

  .footer-note{
    background:linear-gradient(90deg,#1f6feb,#278cff);
    color:#fff;
    border-radius:22px;
    padding:15px 18px;
    box-shadow:var(--shadow);
    font-size:13px;
    display:flex;
    justify-content:space-between;
    gap:12px;
    flex-wrap:wrap;
  }

  @media (max-width:1400px){
    .stats-grid{ grid-template-columns:repeat(2,1fr); }
    .bottom-grid{ grid-template-columns:1fr; }
    .shortcut-grid{ grid-template-columns:repeat(3,1fr); }
  }

  @media (max-width:1100px){
    .admin-shell{
      grid-template-columns:1fr;
    }

    .admin-sidebar{
      position:relative;
      top:0;
      height:auto;
    }

    .content-grid{
      grid-template-columns:1fr;
    }
  }

  @media (max-width:768px){
    .topbar{
      flex-direction:column;
      align-items:stretch;
    }

    .stats-grid{
      grid-template-columns:1fr;
    }

    .shortcut-grid{
      grid-template-columns:1fr 1fr;
    }

    .hero-title{
      font-size:28px;
    }
  }

  @media (max-width:576px){
    .shortcut-grid{
      grid-template-columns:1fr;
    }
  }
</style>
@endpush

@section('content')
<div class="container-fluid py-4 px-3 px-lg-4">
  <div class="admin-shell">

    {{-- SIDEBAR --}}
    <aside class="admin-sidebar position-relative">
      <div>
        <div class="brand-wrap">
          <div class="brand-logo">
            <img src="{{ asset('dpmd.jpeg') }}" alt="Logo">
          </div>
          <div>
            <h1 class="brand-title">DPMD Dashboard</h1>
            <p class="brand-sub">Kabupaten Sumenep</p>
          </div>
        </div>

        <div class="menu-group-title">Menu Utama</div>
        <div class="menu-list">
          <a href="{{ route('admin.dashboard') }}" class="menu-item active">
            <span class="menu-icon">⌂</span>
            <span>Dashboard</span>
          </a>

          <a href="{{ route('admin.kecamatan.index') }}" class="menu-item">
            <span class="menu-icon">🏛️</span>
            <span>Data Kecamatan</span>
          </a>

          <a href="{{ route('admin.desa.index') }}" class="menu-item">
            <span class="menu-icon">🏘️</span>
            <span>Data Desa</span>
          </a>

          <a href="{{ route('admin.bumdes.index') }}" class="menu-item">
            <span class="menu-icon">🧾</span>
            <span>Data BUMDes</span>
          </a>

          <a href="{{ route('admin.kp.index') }}" class="menu-item">
            <span class="menu-icon">📦</span>
            <span>Produk</span>
          </a>

          <a href="{{ route('admin.saran.index') }}" class="menu-item">
            <span class="menu-icon">💬</span>
            <span>Kotak Saran</span>
          </a>
          <a href="{{ route('admin.berita.index') }}" class="menu-item">
  <span class="menu-icon">📰</span>
  <span>Berita</span>
</a>
        </div>

        <div class="menu-group-title">Monitoring</div>
        <div class="menu-list">
          <a href="{{ route('admin.aktivitas.index') }}" class="menu-item">
            <span class="menu-icon">📈</span>
            <span>Aktivitas Data</span>
          </a>

        </div>
      </div>

      <div class="sidebar-footer">
        <a href="{{ route('admin.profile.edit') }}" class="sidebar-user text-decoration-none">
          <div class="sidebar-avatar">
            @if(!empty(session('admin_photo')))
              <img src="{{ asset('uploads/profile/' . session('admin_photo')) }}" alt="Foto Profil">
            @else
              {{ strtoupper(substr(session('admin_username', 'A'), 0, 1)) }}
            @endif
          </div>
          <div>
            <div style="font-weight:800; font-size:14px; color:#1c2b49;">
              {{ session('admin_username', 'Admin') }}
            </div>
            <div style="font-size:12px; color:var(--muted);">Administrator</div>
          </div>
          <div style="margin-left:auto; color:var(--muted); font-size:12px;">✎</div>
        </a>

        <form method="POST" action="{{ route('admin.logout') }}" style="margin:0;">
          @csrf
          <button type="submit" class="logout-card">
            <span class="logout-icon">⎋</span>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </aside>

    {{-- MAIN --}}
    <div class="main-area">

      {{-- TOPBAR --}}
      <div class="topbar">
        <div class="search-box">
          <span>🔍</span>
          <input type="text" placeholder="Cari kecamatan, desa, BUMDes, produk...">
          <span style="color:var(--muted);">⌘K</span>
        </div>

        <div class="topbar-actions">
          <a href="{{ route('admin.notifications.goToSaran') }}" class="icon-circle text-decoration-none text-dark">
            🔔
            @if(($unreadCount ?? 0) > 0)
              <span class="notif-badge">{{ $unreadCount }}</span>
            @endif
          </a>

          <div class="profile-pill">
            <div class="avatar">
              @if(!empty(session('admin_photo')))
                <img src="{{ asset('uploads/profile/' . session('admin_photo')) }}" alt="Foto Profil">
              @else
                {{ strtoupper(substr(session('admin_username', 'A'), 0, 1)) }}
              @endif
            </div>
            <div>
              <div style="font-weight:800; font-size:14px; line-height:1.1;">{{ session('admin_username', 'Admin') }}</div>
              <div style="font-size:12px; color:var(--muted);">Super Admin</div>
            </div>
          </div>
        </div>
      </div>

      {{-- HERO --}}
      <div class="hero-card">
        <div class="hero-content">
          <div>
            <h2 class="hero-title">Dashboard Admin DPMD</h2>
            <p class="hero-desc">
              Monitoring data Kecamatan, Desa, BUMDes, Produk Ketahanan Pangan, dan Kotak Saran
              dalam satu tampilan yang lebih modern, cepat, dan informatif.
            </p>

            <div class="hero-actions">
              <a href="{{ route('home') }}" class="hero-btn hero-btn-light">← Lihat Web Publik</a>
              <a href="{{ route('admin.saran.index') }}" class="hero-btn hero-btn-outline">💬 Buka Kotak Saran</a>
            </div>
          </div>

          <div class="hero-mini">
            <small>Ringkasan Hari Ini</small>
            <strong>{{ ($totalDesa ?? 330) + ($totalBumdes ?? 120) }}</strong>
            <div style="margin-top:6px; font-size:13px; opacity:.9;">
              total data inti yang sedang dipantau
            </div>
          </div>
        </div>
      </div>

      {{-- STATS --}}
      <div class="stats-grid">
        <div class="stat-card">
          <div class="stat-icon bg-kec">🏛️</div>
          <div>
            <h3 class="stat-number">{{ $totalKecamatan ?? 12 }}</h3>
            <p class="stat-label">Total Kecamatan</p>
            <div class="stat-growth">+12% bulan ini</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon bg-desa">🏘️</div>
          <div>
            <h3 class="stat-number">{{ $totalDesa ?? 330 }}</h3>
            <p class="stat-label">Total Desa</p>
            <div class="stat-growth">+8% bulan ini</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon bg-bumdes">🧾</div>
          <div>
            <h3 class="stat-number">{{ $totalBumdes ?? 120 }}</h3>
            <p class="stat-label">Total BUMDes</p>
            <div class="stat-growth">+15% bulan ini</div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-icon bg-produk">📦</div>
          <div>
            <h3 class="stat-number">{{ $totalProduk ?? 560 }}</h3>
            <p class="stat-label">Total Produk</p>
            <div class="stat-growth">+10% bulan ini</div>
          </div>
        </div>
      </div>

      {{-- CHART + SIDE INFO --}}
      <div class="content-grid">
        <div class="panel">
          <div class="panel-head">
            <div>
              <h3 class="panel-title">Aktivitas Input Data</h3>
              <div class="panel-sub">Statistik mingguan pengelolaan data admin</div>
            </div>
            <div class="trend-up">+32% meningkat</div>
          </div>

          <div class="big-number">128 <span style="font-size:15px; color:var(--muted); font-weight:700;">update minggu ini</span></div>

          <div class="chart-wrap">
            <canvas id="activityChart"></canvas>
          </div>
        </div>

        <div class="right-stack">
          <div class="panel">
            <div class="panel-head">
              <div>
                <h3 class="panel-title">Kelengkapan Data</h3>
                <div class="panel-sub">Status data utama sistem</div>
              </div>
            </div>

            <div class="big-number">76%</div>
            <div class="panel-sub">24% data masih perlu dilengkapi</div>
            <div class="progress-line">
              <span style="width:76%"></span>
            </div>

            <div class="mini-stat">
              <span class="mini-chip">✔ Validasi baik</span>
              <span class="mini-chip">↻ Update aktif</span>
            </div>
          </div>

          <div class="panel">
            <div class="panel-head">
              <div>
                <h3 class="panel-title">Kotak Saran</h3>
                <div class="panel-sub">Notifikasi masukan masyarakat</div>
              </div>
            </div>

            <div class="big-number">{{ $unreadCount ?? 5 }}</div>
            <div class="panel-sub">pesan belum dibaca</div>
            <div class="mini-stat">
              <span class="mini-chip">9 diproses</span>
              <span class="mini-chip">4 selesai</span>
            </div>
          </div>
        </div>
      </div>

      {{-- BOTTOM GRID --}}
      <div class="bottom-grid">
        <div class="panel">
          <div class="panel-head">
            <div>
              <h3 class="panel-title">Desa Teraktif</h3>
              <div class="panel-sub">Berdasarkan aktivitas update data</div>
            </div>
          </div>

          <table>
            <thead>
              <tr>
                <th>Rank</th>
                <th>Nama Desa</th>
                <th>Aktivitas</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td><span class="rank-pill">A</span>Batuputih</td>
                <td class="trend-up">+32 update</td>
              </tr>
              <tr>
                <td>2</td>
                <td><span class="rank-pill" style="background:linear-gradient(135deg,#4ade80,#16a34a);">B</span>Batuan</td>
                <td class="trend-up">+30 update</td>
              </tr>
              <tr>
                <td>3</td>
                <td><span class="rank-pill" style="background:linear-gradient(135deg,#fbbf24,#f59e0b);">R</span>Rubaru</td>
                <td class="trend-up">+26 update</td>
              </tr>
              <tr>
                <td>4</td>
                <td><span class="rank-pill" style="background:linear-gradient(135deg,#67e8f9,#06b6d4);">P</span>Pasongsongan</td>
                <td class="trend-up">+23 update</td>
              </tr>
              <tr>
                <td>5</td>
                <td><span class="rank-pill" style="background:linear-gradient(135deg,#a78bfa,#7c3aed);">D</span>Dasuk</td>
                <td class="trend-up">+19 update</td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="panel">
          <div class="panel-head">
            <div>
              <h3 class="panel-title">Kecamatan Teraktif</h3>
              <div class="panel-sub">Monitoring wilayah aktif</div>
            </div>
          </div>

          <div class="list-stack">
            <div class="list-item">
              <div class="list-left">
                <div class="small-avatar">1</div>
                <div>
                  <p class="list-title">Batang-Batang</p>
                  <p class="list-sub">Update data terbanyak</p>
                </div>
              </div>
              <div class="list-value">30</div>
            </div>

            <div class="list-item">
              <div class="list-left">
                <div class="small-avatar">2</div>
                <div>
                  <p class="list-title">Batuputih</p>
                  <p class="list-sub">Aktif minggu ini</p>
                </div>
              </div>
              <div class="list-value">27</div>
            </div>

            <div class="list-item">
              <div class="list-left">
                <div class="small-avatar">3</div>
                <div>
                  <p class="list-title">Batuan</p>
                  <p class="list-sub">Input konsisten</p>
                </div>
              </div>
              <div class="list-value">25</div>
            </div>

            <div class="list-item">
              <div class="list-left">
                <div class="small-avatar">4</div>
                <div>
                  <p class="list-title">Rubaru</p>
                  <p class="list-sub">Kenaikan aktivitas</p>
                </div>
              </div>
              <div class="list-value">21</div>
            </div>
          </div>
        </div>
          </div>
        </div>
      </div>

      {{-- SHORTCUT --}}
      <div class="shortcut-grid">
        <a href="{{ route('admin.kecamatan.index') }}" class="shortcut-card">
          <div class="shortcut-icon">🏛️</div>
          <div>
            <div style="font-weight:900;">Kelola Kecamatan</div>
            <div style="font-size:13px; color:var(--muted);">Data wilayah kecamatan</div>
          </div>
        </a>

        <a href="{{ route('admin.desa.index') }}" class="shortcut-card">
          <div class="shortcut-icon">🏘️</div>
          <div>
            <div style="font-weight:900;">Kelola Desa</div>
            <div style="font-size:13px; color:var(--muted);">Daftar desa dan profil</div>
          </div>
        </a>

        <a href="{{ route('admin.bumdes.index') }}" class="shortcut-card">
          <div class="shortcut-icon">🧾</div>
          <div>
            <div style="font-weight:900;">Kelola BUMDes</div>
            <div style="font-size:13px; color:var(--muted);">Profil dan informasi BUMDes</div>
          </div>
        </a>

        <a href="{{ route('admin.kp.index') }}" class="shortcut-card">
          <div class="shortcut-icon">📦</div>
          <div>
            <div style="font-weight:900;">Kelola Produk</div>
            <div style="font-size:13px; color:var(--muted);">Produk ketahanan pangan</div>
          </div>
        </a>

        <a href="{{ route('admin.saran.index') }}" class="shortcut-card">
          <div class="shortcut-icon">💬</div>
          <div>
            <div style="font-weight:900;">Kelola Saran</div>
            <div style="font-size:13px; color:var(--muted);">Masukan masyarakat</div>
          </div>
        </a>
      </div>

      <div class="footer-note">
        <div>© {{ date('Y') }} Dinas Pemberdayaan Masyarakat dan Desa Kabupaten Sumenep</div>
        <div>Dashboard Monitoring Admin</div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const activityCanvas = document.getElementById('activityChart');

  if (activityCanvas) {
    new Chart(activityCanvas, {
      type: 'line',
      data: {
        labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
        datasets: [{
          label: 'Aktivitas Input',
          data: [14, 18, 17, 25, 19, 16, 15],
          borderColor: '#1f6feb',
          backgroundColor: 'rgba(31,111,235,0.14)',
          fill: true,
          tension: 0.42,
          borderWidth: 3,
          pointRadius: 4,
          pointHoverRadius: 5,
          pointBackgroundColor: '#ffffff',
          pointBorderColor: '#1f6feb',
          pointBorderWidth: 2
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: { display: false }
        },
        scales: {
          x: {
            grid: { display: false },
            ticks: { color: '#7b8aa0', font: { weight: '600' } }
          },
          y: {
            beginAtZero: true,
            ticks: { color: '#7b8aa0', font: { weight: '600' } },
            grid: { color: '#eef3fb' }
          }
        }
      }
    });
  }
</script>
@endpush