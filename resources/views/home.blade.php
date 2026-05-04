@extends('layouts.public')

@section('content')

@push('styles')
<style>
html{
    scroll-behavior:smooth;
}

:root{
    --primary:#3b82f6;
    --primary-dark:#2563eb;
    --text:#223a67;
    --muted:#667085;
    --card:#ffffff;
    --border:#dbeafe;
    --soft:#eff6ff;
    --yellow:#f6c443;
    --yellow-dark:#eab308;
    --shadow:0 18px 40px rgba(59,130,246,.12);
    --shadow-soft:0 10px 24px rgba(15,23,42,.06);
    --navy:#16325c;
    --navy-soft:#315a96;
    --glass:rgba(255,255,255,.72);
}

.public-home{
    position:relative;
    overflow:hidden;
    background:
        radial-gradient(circle at left center, rgba(125,211,252,.18), transparent 28%),
        radial-gradient(circle at right top, rgba(191,219,254,.22), transparent 26%),
        linear-gradient(180deg, #f8fbff 0%, #edf5ff 100%);
}

.public-home::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        linear-gradient(180deg, rgba(255,255,255,.35) 0%, rgba(255,255,255,0) 25%),
        radial-gradient(circle at 15% 85%, rgba(96,165,250,.08), transparent 18%),
        radial-gradient(circle at 88% 78%, rgba(59,130,246,.06), transparent 18%);
    pointer-events:none;
}

.hero-section{
    position:relative;
    padding:28px 0 18px;
}

.hero-shell{
    position:relative;
    overflow:hidden;
    border-radius:32px;
    padding:48px 46px 34px;
    min-height:520px;
    background:
        linear-gradient(115deg, rgba(255,255,255,.96) 0%, rgba(255,255,255,.84) 34%, rgba(255,255,255,.18) 100%),
        url('{{ asset('dpmd.jpeg') }}');
    background-size:cover;
    background-position:center;
    box-shadow:var(--shadow);
    border:1px solid rgba(255,255,255,.55);
}

.hero-shell::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        radial-gradient(circle at left top, rgba(147,197,253,.14), transparent 22%),
        linear-gradient(180deg, rgba(255,255,255,.08), rgba(255,255,255,0));
    pointer-events:none;
}

.hero-shell::after{
    content:"";
    position:absolute;
    width:420px;
    height:420px;
    right:-90px;
    top:-120px;
    border-radius:50%;
    background:radial-gradient(circle, rgba(59,130,246,.18), rgba(59,130,246,0));
    filter:blur(10px);
    pointer-events:none;
}

.hero-wave{
    position:absolute;
    left:0;
    right:0;
    bottom:-1px;
    height:150px;
    z-index:1;
    pointer-events:none;
    opacity:.95;
}

.hero-wave svg{
    display:block;
    width:100%;
    height:100%;
}

.hero-wave path:first-child{
    fill:rgba(255,255,255,.58);
}

.hero-wave path:last-child{
    fill:rgba(219,234,254,.55);
}

.hero-grid{
    position:relative;
    z-index:2;
    display:grid;
    grid-template-columns:1.05fr .95fr;
    gap:22px;
    align-items:center;
}

.hero-badge{
    display:inline-flex;
    align-items:center;
    gap:8px;
    padding:8px 14px;
    border-radius:999px;
    background:rgba(255,255,255,.78);
    border:1px solid rgba(191,219,254,.9);
    color:var(--navy);
    font-size:13px;
    font-weight:800;
    letter-spacing:.02em;
    box-shadow:0 10px 24px rgba(37,99,235,.08);
    margin-bottom:18px;
    backdrop-filter:blur(10px);
}

.hero-badge::before{
    content:"";
    width:8px;
    height:8px;
    border-radius:50%;
    background:linear-gradient(135deg, #22c55e, #16a34a);
    box-shadow:0 0 0 6px rgba(34,197,94,.12);
}

.hero-title{
    font-size:clamp(2.2rem, 4.2vw, 3.9rem);
    line-height:1.08;
    letter-spacing:-.04em;
    font-weight:900;
    color:#233a69;
    margin-bottom:16px;
    max-width:620px;
}

.hero-desc{
    font-size:18px;
    line-height:1.8;
    color:#5b6880;
    max-width:620px;
    margin-bottom:24px;
}

.hero-actions{
    display:flex;
    flex-wrap:wrap;
    gap:12px;
}

.btn-primary-hero,
.btn-secondary-hero{
    display:inline-flex;
    align-items:center;
    justify-content:center;
    gap:8px;
    text-decoration:none;
    border:none;
    border-radius:14px;
    padding:13px 22px;
    font-weight:800;
    transition:.25s ease;
}

.btn-primary-hero{
    color:#fff;
    background:linear-gradient(135deg, var(--primary), var(--primary-dark));
    box-shadow:0 14px 24px rgba(37,99,235,.18);
}

.btn-primary-hero:hover{
    transform:translateY(-2px);
    box-shadow:0 18px 30px rgba(37,99,235,.22);
}

.btn-secondary-hero{
    color:#344256;
    background:rgba(255,255,255,.84);
    border:1px solid rgba(226,232,240,.95);
}

.btn-secondary-hero:hover{
    transform:translateY(-2px);
    background:#fff;
}

.hero-visual{
    display:flex;
    justify-content:flex-end;
    align-items:center;
    min-height:390px;
}

.hero-image-wrap{
    position:relative;
    width:100%;
    max-width:540px;
    min-height:390px;
}

.dashboard-card{
    position:absolute;
    border-radius:22px;
    background:rgba(255,255,255,.74);
    border:1px solid rgba(255,255,255,.6);
    box-shadow:
        0 18px 40px rgba(15,23,42,.08),
        inset 0 1px 0 rgba(255,255,255,.7);
    backdrop-filter:blur(14px);
    animation:floatCard 4s ease-in-out infinite;
}

.dashboard-card::before{
    content:"";
    position:absolute;
    inset:0;
    border-radius:inherit;
    padding:1px;
    background:linear-gradient(135deg, rgba(255,255,255,.7), rgba(147,197,253,.35));
    -webkit-mask:
        linear-gradient(#fff 0 0) content-box,
        linear-gradient(#fff 0 0);
    -webkit-mask-composite:xor;
            mask-composite:exclude;
    pointer-events:none;
}

.dashboard-card.analytics{
    width:210px;
    padding:15px;
    top:18px;
    right:130px;
}

.dashboard-card.stats{
    width:190px;
    padding:15px;
    top:110px;
    right:14px;
    animation-delay:.4s;
}

.dashboard-card.mail{
    width:170px;
    padding:13px;
    bottom:38px;
    left:52px;
    animation-delay:.8s;
}

.chart-bars{
    height:70px;
    display:flex;
    align-items:flex-end;
    gap:8px;
    margin-top:12px;
}

.chart-bars span{
    display:block;
    flex:1;
    border-radius:999px 999px 8px 8px;
    background:linear-gradient(180deg, #93c5fd, #2563eb);
}

.dashboard-title{
    font-size:13px;
    font-weight:800;
    color:#355389;
    margin-bottom:8px;
}

.mini-lines{
    display:grid;
    gap:8px;
}

.mini-lines div{
    height:10px;
    border-radius:999px;
    background:#e8f1ff;
}

.mini-list{
    display:grid;
    gap:10px;
}

.mini-item{
    display:flex;
    justify-content:space-between;
    align-items:center;
    font-size:12px;
    color:#4b5b74;
    font-weight:700;
}

.mini-dot{
    width:8px;
    height:8px;
    border-radius:50%;
    background:#22c55e;
    display:inline-block;
    margin-right:8px;
}

.hero-illustration{
    position:absolute;
    right:34px;
    bottom:0;
    width:min(100%, 480px);
    filter:drop-shadow(0 16px 24px rgba(37,99,235,.14));
}

.services-section{
    position:relative;
    padding:10px 0 56px;
}

.section-header{
    text-align:center;
    max-width:820px;
    margin:0 auto 26px;
}

.section-header .section-badge{
    display:inline-block;
    padding:7px 12px;
    border-radius:999px;
    background:#eaf3ff;
    color:#2453a6;
    font-size:12px;
    font-weight:800;
    letter-spacing:.04em;
    text-transform:uppercase;
    margin-bottom:12px;
}

.section-header h2{
    font-size:clamp(1.9rem, 4vw, 2.9rem);
    font-weight:900;
    letter-spacing:-.03em;
    color:#243c6a;
    margin-bottom:10px;
}

.section-header p{
    margin:0;
    color:#73839d;
    font-size:15px;
    line-height:1.8;
}

.feature-grid{
    display:grid;
    grid-template-columns:repeat(3, minmax(0, 1fr));
    gap:18px;
    max-width:1020px;
    margin:0 auto;
}

.feature-card{
    position:relative;
    background:linear-gradient(180deg, rgba(255,255,255,.98), rgba(248,251,255,.95));
    border:1px solid rgba(226,232,240,.95);
    border-radius:22px;
    padding:22px 18px 18px;
    text-align:center;
    box-shadow:0 12px 28px rgba(15,23,42,.05);
    min-height:210px;
    overflow:hidden;
    transition:transform .28s ease, box-shadow .28s ease, border-color .28s ease;
    opacity:0;
    transform:translateY(22px);
    animation:fadeUp .7s ease forwards;
}

.feature-card:nth-child(1){ animation-delay:.08s; }
.feature-card:nth-child(2){ animation-delay:.16s; }
.feature-card:nth-child(3){ animation-delay:.24s; }
.feature-card:nth-child(4){ animation-delay:.32s; }
.feature-card:nth-child(5){ animation-delay:.40s; }
.feature-card:nth-child(6){ animation-delay:.48s; }

.feature-card::before{
    content:"";
    position:absolute;
    inset:0;
    background:linear-gradient(180deg, rgba(255,255,255,.24), rgba(255,255,255,0));
    pointer-events:none;
}

.feature-card::after{
    content:"";
    position:absolute;
    top:-60px;
    right:-60px;
    width:120px;
    height:120px;
    border-radius:50%;
    background:rgba(59,130,246,.07);
    filter:blur(8px);
    transition:.3s ease;
}

.feature-card .card-accent{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:4px;
    border-radius:999px;
    background:linear-gradient(90deg, rgba(59,130,246,.95), rgba(147,197,253,.65));
}

.feature-card:hover{
    transform:translateY(-8px);
    box-shadow:0 24px 40px rgba(37,99,235,.10);
    border-color:#bfdbfe;
}

.feature-card:hover::after{
    transform:scale(1.08);
    background:rgba(59,130,246,.10);
}

.feature-icon{
    width:58px;
    height:58px;
    border-radius:18px;
    display:grid;
    place-items:center;
    margin:0 auto 14px;
    font-size:24px;
    box-shadow:
        inset 0 1px 0 rgba(255,255,255,.85),
        0 10px 20px rgba(15,23,42,.04);
    transition:transform .25s ease;
    position:relative;
    z-index:2;
}

.feature-card:hover .feature-icon{
    transform:scale(1.08) rotate(-4deg);
}

.feature-icon.info{ background:linear-gradient(135deg, #e0ecff, #f8fbff); }
.feature-icon.data{ background:linear-gradient(135deg, #dcfce7, #f0fdf4); }
.feature-icon.product{ background:linear-gradient(135deg, #ffedd5, #fff7ed); }
.feature-icon.saran{ background:linear-gradient(135deg, #fef3c7, #fffbea); }
.feature-icon.bumdes{ background:linear-gradient(135deg, #ede9fe, #f5f3ff); }
.feature-icon.berita{ background:linear-gradient(135deg, #ffe4e6, #fff1f2); }

.feature-card h3{
    position:relative;
    z-index:2;
    font-size:18px;
    font-weight:800;
    color:#1f3761;
    line-height:1.35;
    margin-bottom:10px;
}

.feature-card p{
    position:relative;
    z-index:2;
    font-size:13px;
    line-height:1.7;
    color:#6b7280;
    margin-bottom:15px;
    min-height:60px;
}

.feature-btn{
    position:relative;
    z-index:2;
    display:inline-flex;
    align-items:center;
    justify-content:center;
    min-width:124px;
    border:none;
    border-radius:11px;
    padding:9px 14px;
    text-decoration:none;
    font-weight:800;
    font-size:13px;
    color:#fff;
    transition:.25s ease;
}

.feature-btn:hover{
    transform:translateY(-1px);
    filter:brightness(1.03);
}

.feature-btn.info{ background:linear-gradient(135deg, #4f8cff, #2563eb); }
.feature-btn.data{ background:linear-gradient(135deg, #34d399, #10b981); }
.feature-btn.product{ background:linear-gradient(135deg, #fb923c, #f97316); }
.feature-btn.saran{ background:linear-gradient(135deg, #facc15, #eab308); color:#3b2f0a; }
.feature-btn.bumdes{ background:linear-gradient(135deg, #8b5cf6, #7c3aed); }
.feature-btn.berita{ background:linear-gradient(135deg, #f472b6, #ec4899); }

.info-banner{
    padding:0 0 70px;
}

.info-banner-card{
    position:relative;
    background:linear-gradient(135deg, #1f56d6, #3b82f6 72%, #60a5fa 100%);
    color:#fff;
    border-radius:30px;
    padding:32px 34px;
    box-shadow:var(--shadow);
    overflow:hidden;
}

.info-banner-card::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        radial-gradient(circle at 15% 20%, rgba(255,255,255,.18), transparent 22%),
        radial-gradient(circle at 85% 80%, rgba(255,255,255,.12), transparent 22%);
    pointer-events:none;
}

.info-banner-grid{
    display:grid;
    grid-template-columns:1.15fr .85fr;
    gap:20px;
    align-items:center;
}

.info-banner-card h3{
    font-size:34px;
    font-weight:900;
    margin-bottom:10px;
}

.info-banner-card p{
    margin:0;
    line-height:1.85;
    opacity:.95;
}

.info-points{
    display:grid;
    gap:12px;
}

.info-points div{
    background:rgba(255,255,255,.12);
    border:1px solid rgba(255,255,255,.18);
    border-radius:18px;
    padding:15px 16px;
    font-weight:700;
    backdrop-filter:blur(8px);
    transition:.25s ease;
}

.info-points div:hover{
    transform:translateX(6px);
    background:rgba(255,255,255,.18);
}

.footer-wave{
    position:relative;
    background:linear-gradient(180deg, rgba(255,255,255,0), rgba(255,255,255,.22));
}

.footer-main{
    position:relative;
    background:linear-gradient(135deg, #2f6fe8, #1f56d6);
    color:#fff;
    padding:28px 0 16px;
    overflow:hidden;
}

.footer-main::before{
    content:"";
    position:absolute;
    inset:0;
    background:
        radial-gradient(circle at 12% 20%, rgba(255,255,255,.18), transparent 20%),
        radial-gradient(circle at 88% 12%, rgba(255,255,255,.10), transparent 18%);
    pointer-events:none;
}

.footer-top{
    position:relative;
    z-index:2;
    display:grid;
    grid-template-columns:1.3fr .9fr 1fr;
    gap:22px;
    align-items:center;
    padding-bottom:16px;
    border-bottom:1px solid rgba(255,255,255,.16);
}

.footer-brand{
    display:flex;
    align-items:center;
    gap:14px;
}

.footer-brand img{
    width:56px;
    height:56px;
    object-fit:contain;
}

.footer-brand h5{
    font-size:18px;
    font-weight:900;
    margin:0 0 4px;
}

.footer-brand p{
    margin:0;
    opacity:.88;
}

.footer-links{
    display:flex;
    justify-content:center;
    gap:22px;
    flex-wrap:wrap;
}

.footer-links a,
.footer-links button{
    color:#fff;
    text-decoration:none;
    background:none;
    border:none;
    padding:0;
    font-weight:700;
    opacity:.92;
    transition:.2s ease;
}

.footer-links a:hover,
.footer-links button:hover{
    opacity:1;
    transform:translateY(-1px);
}

.footer-contact{
    text-align:right;
    font-size:14px;
    opacity:.92;
}

.footer-bottom{
    position:relative;
    z-index:2;
    text-align:center;
    padding-top:14px;
    font-size:13px;
    opacity:.88;
}

section{
    scroll-margin-top:100px;
}

@keyframes fadeUp{
    from{
        opacity:0;
        transform:translateY(22px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

@keyframes floatCard{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-6px);
    }
}

@media (max-width: 1199.98px){
    .feature-grid{
        grid-template-columns:repeat(2, 1fr);
    }

    .hero-grid,
    .info-banner-grid,
    .footer-top{
        grid-template-columns:1fr;
    }

    .hero-visual{
        justify-content:center;
        min-height:430px;
    }

    .footer-contact{
        text-align:left;
    }

    .footer-links{
        justify-content:flex-start;
    }
}

@media (max-width: 767.98px){
    .hero-shell{
        padding:34px 24px 30px;
        min-height:auto;
    }

    .hero-title{
        font-size:2.2rem;
    }

    .hero-desc{
        font-size:15px;
    }

    .feature-grid{
        grid-template-columns:1fr;
    }

    .feature-card{
        min-height:auto;
    }

    .feature-card p{
        min-height:auto;
    }

    .hero-visual{
        min-height:340px;
    }

    .dashboard-card.analytics{
        width:170px;
        right:82px;
    }

    .dashboard-card.stats{
        width:150px;
        right:0;
    }

    .dashboard-card.mail{
        width:145px;
        left:0;
    }

    .hero-illustration{
        width:300px;
        right:20px;
    }

    .info-banner-card h3{
        font-size:26px;
    }

    .hero-wave{
        height:110px;
    }
}
</style>
@endpush

<div id="top" class="public-home">

    <section class="hero-section">
        <div class="container container-narrow">
            <div class="hero-shell">
                <div class="hero-grid">
                    <div>
                        <div class="hero-badge">Platform Resmi Layanan Digital BUMDes</div>

                        <h1 class="hero-title">
                            Sistem Pendataan dan
                            Digitalisasi Produk BUMDes
                        </h1>

                        <p class="hero-desc">
                            Sistem terintegrasi untuk pendataan, monitoring, dan digitalisasi
                            produk BUMDes melalui aplikasi yang efisien, modern, dan aman.
                        </p>

                        <div class="hero-actions">
                            <a href="#layanan-utama" class="btn-primary-hero">
                                Lihat Menu
                            </a>
                        </div>
                    </div>

                    <div class="hero-visual">
                        <div class="hero-image-wrap">
                            <div class="dashboard-card analytics">
                                <div class="dashboard-title">Monitoring</div>
                                <div class="mini-lines">
                                    <div style="width:72%;"></div>
                                    <div style="width:100%;"></div>
                                </div>
                                <div class="chart-bars">
                                    <span style="height:26px;"></span>
                                    <span style="height:42px;"></span>
                                    <span style="height:34px;"></span>
                                    <span style="height:58px;"></span>
                                    <span style="height:44px;"></span>
                                </div>
                            </div>

                            <div class="dashboard-card stats">
                                <div class="dashboard-title">Data</div>
                                <div class="mini-list">
                                    <div class="mini-item"><span><span class="mini-dot"></span>Informasi</span><span>Aktif</span></div>
                                    <div class="mini-item"><span><span class="mini-dot"></span>Produk</span><span>Aman</span></div>
                                    <div class="mini-item"><span><span class="mini-dot"></span>Wilayah</span><span>Lengkap</span></div>
                                </div>
                            </div>

                            <div class="dashboard-card mail">
                                <div class="dashboard-title">Layanan</div>
                                <div class="mini-lines">
                                    <div style="width:100%;"></div>
                                    <div style="width:82%;"></div>
                                    <div style="width:64%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-wave">
                    <svg viewBox="0 0 1440 220" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0,160 C180,110 310,210 520,180 C720,150 860,70 1080,110 C1240,138 1340,190 1440,170 L1440,220 L0,220 Z"></path>
                        <path d="M0,185 C210,145 340,225 560,198 C760,172 920,105 1120,138 C1260,160 1360,205 1440,192 L1440,220 L0,220 Z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <section class="services-section" id="layanan-utama">
        <div class="container container-narrow">
            <div class="section-header">
                <div class="section-badge">Layanan Utama</div>
                <h2>Layanan Utama Digitalisasi BUMDes</h2>
                <p>
                    Akses fitur utama untuk informasi, pendataan, monitoring, digitalisasi produk,
                    berita, dan saran publik dalam satu tampilan yang lebih ringkas, modern, dan profesional.
                </p>
            </div>

            <div class="feature-grid">
                <div class="feature-card">
                    <div class="card-accent"></div>
                    <div class="feature-icon info">📘</div>
                    <h3>Informasi Terpusat</h3>
                    <p>Publikasi, pengumuman, dokumentasi, dan informasi layanan BUMDes tersaji lebih rapi.</p>
                    <a href="{{ route('informasi.index') }}" class="feature-btn info">Lihat Informasi</a>
                </div>

                <div class="feature-card">
                    <div class="card-accent"></div>
                    <div class="feature-icon data">📊</div>
                    <h3>Data & Monitoring</h3>
                    <p>Pendataan kecamatan, desa, BUMDes, dan monitoring program dalam satu sistem.</p>
                    <a href="{{ route('kecamatan.index') }}" class="feature-btn data">Lihat Data</a>
                </div>

                <div class="feature-card">
                    <div class="card-accent"></div>
                    <div class="feature-icon product">📦</div>
                    <h3>Digitalisasi Produk</h3>
                    <p>Jelajahi produk unggulan BUMDes dan tampilkan katalog digital yang lebih mudah diakses.</p>
                    <button type="button"
                            class="feature-btn product"
                            data-bs-toggle="modal"
                            data-bs-target="#modalProduk">
                        Lihat Produk
                    </button>
                </div>

                <div class="feature-card">
                    <div class="card-accent"></div>
                    <div class="feature-icon saran">💬</div>
                    <h3>Kotak Saran</h3>
                    <p>Sampaikan masukan, kritik, dan usulan untuk peningkatan layanan publik yang lebih baik.</p>
                    <button type="button"
                            class="feature-btn saran"
                            data-bs-toggle="modal"
                            data-bs-target="#modalSaran">
                        Kirim Saran
                    </button>
                </div>

                <div class="feature-card">
                    <div class="card-accent"></div>
                    <div class="feature-icon bumdes">🏢</div>
                    <h3>Data BUMDes</h3>
                    <p>Lihat profil, unit usaha, dan informasi dasar BUMDes di Kabupaten Sumenep secara terstruktur.</p>
                    <a href="{{ route('bumdes.index') }}" class="feature-btn bumdes">Lihat BUMDes</a>
                </div>

                <div class="feature-card">
                    <div class="card-accent"></div>
                    <div class="feature-icon berita">📰</div>
                    <h3>Berita</h3>
                    <p>Ikuti kabar terbaru, agenda kegiatan, publikasi, dan perkembangan program desa dan BUMDes.</p>
                    <a href="{{ route('berita.index') }}" class="feature-btn berita">Lihat Berita</a>
                </div>
            </div>
        </div>
    </section>

    <section class="info-banner" id="profil">
        <div class="container container-narrow">
            <div class="info-banner-card">
                <div class="info-banner-grid">
                    <div>
                        <h3>Layanan Publik yang Lebih Modern</h3>
                        <p>
                            Platform ini dirancang untuk membantu penyediaan informasi BUMDes secara lebih cepat,
                            tertata, dan profesional. Masyarakat dapat melihat informasi dan dokumentasi,
                            sedangkan pemerintah daerah memperoleh media pendataan yang lebih baik.
                        </p>
                    </div>

                    <div class="info-points">
                        <div>✔ Informasi lebih mudah diakses</div>
                        <div>✔ Tampilan lebih modern dan profesional</div>
                        <div>✔ Mendukung transparansi data publik</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="footer-wave" id="galeri">
        <footer class="footer-main">
            <div class="container container-narrow">
                <div class="footer-top">
                    <div class="footer-brand">
                        <img src="{{ asset('logo.png') }}" alt="Logo DPMD">
                        <div>
                            <h5>Dinas Pemberdayaan Masyarakat dan Desa</h5>
                            <p>Kabupaten Sumenep</p>
                        </div>
                    </div>

                    <div class="footer-contact">
                        <div>PKL UNIVERSITAS ANNUQAYAH - 2026</div>
                    </div>
                </div>

                <div class="footer-bottom">
                    © {{ date('Y') }} Transparansi data & layanan publik
                </div>
            </div>
        </footer>
    </div>
</div>

<div class="modal fade" id="modalProduk" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:20px; overflow:hidden; border:0; box-shadow:0 20px 50px rgba(15,23,42,.15);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Pilih Jenis Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body pt-3">
                <p class="text-muted small mb-3">
                    Silakan pilih kategori produk yang ingin ditampilkan.
                </p>

                <div class="row g-3">
                    <div class="col-12 col-md-6">
                        <a class="d-block text-decoration-none text-dark border rounded-4 p-3 h-100"
                           href="{{ route('produk.index', ['kategori' => 'ketahanan_pangan']) }}">
                            <div class="text-center fs-2 mb-2">🌾</div>
                            <h6 class="fw-bold text-center mb-1">Ketahanan Pangan</h6>
                            <p class="text-muted small text-center mb-0">Produk pangan, pertanian, dan sejenisnya.</p>
                        </a>
                    </div>

                    <div class="col-12 col-md-6">
                        <a class="d-block text-decoration-none text-dark border rounded-4 p-3 h-100"
                           href="{{ route('produk.index', ['kategori' => 'unit_usaha']) }}">
                            <div class="text-center fs-2 mb-2">🏪</div>
                            <h6 class="fw-bold text-center mb-1">Unit Usaha</h6>
                            <p class="text-muted small text-center mb-0">Produk atau unit usaha BUMDes lainnya.</p>
                        </a>
                    </div>
                </div>
            </div>

            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content" style="border-radius:20px; overflow:hidden; border:0; box-shadow:0 20px 50px rgba(15,23,42,.15);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Kotak Saran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('saran.store') }}" method="POST">
                @csrf
                <div class="modal-body pt-3">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nama</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Kontak (opsional)</label>
                            <input type="text" name="kontak" class="form-control">
                        </div>

                        <div class="col-12">
                            <label class="form-label">Kategori</label>
                            <select name="kategori" class="form-select" required>
                                <option value="Saran">Saran</option>
                                <option value="Bug">Laporan Bug</option>
                                <option value="Fitur">Permintaan Fitur</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Pesan</label>
                            <textarea name="pesan" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3">Kirim Saran</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection