@extends('layouts.public')

@section('content')

@push('styles')
<style>
.berita-page{
    background: #f6f8fc;
    min-height: 100vh;
    padding: 40px 0 70px;
}

.berita-wrap{
    max-width: 920px;
    margin: 0 auto;
}

.berita-card{
    background: #ffffff;
    border: 1px solid #e5e7eb;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 18px 45px rgba(17,24,39,.08);
}

.berita-head{
    padding: 28px 28px 20px;
    border-bottom: 1px solid #eef2f7;
}

.berita-badge{
    display: inline-block;
    font-size: 13px;
    font-weight: 800;
    color: #0d6efd;
    background: rgba(13,110,253,.08);
    border: 1px solid rgba(13,110,253,.18);
    border-radius: 999px;
    padding: 6px 12px;
    margin-bottom: 14px;
}

.berita-title{
    font-size: 38px;
    line-height: 1.2;
    font-weight: 900;
    color: #123b7a;
    margin-bottom: 14px;
    letter-spacing: -.02em;
}

.berita-meta{
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 20px;
}

.berita-image img{
    width: 100%;
    display: block;
    max-height: 520px;
    object-fit: cover;
}

.berita-body{
    padding: 26px 28px 30px;
}

.berita-caption{
    color: #6b7280;
    font-size: 14px;
    margin-bottom: 20px;
}

.berita-text{
    font-size: 18px;
    line-height: 1.9;
    color: #1f2937;
}

.berita-text p{
    margin-bottom: 18px;
}

.berita-footer{
    margin-top: 28px;
    padding-top: 20px;
    border-top: 1px solid #eef2f7;
}

.berita-footer h5{
    font-weight: 800;
    margin-bottom: 14px;
}

.sosmed-links{
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.sosmed-btn{
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 12px 16px;
    border-radius: 14px;
    border: 1px solid #dbeafe;
    background: #fff;
    text-decoration: none;
    color: #111827;
    font-weight: 700;
    transition: .2s ease;
}

.sosmed-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(17,24,39,.08);
}

.back-wrap{
    margin-bottom: 18px;
}

@media (max-width: 768px){
    .berita-title{
        font-size: 28px;
    }

    .berita-head,
    .berita-body{
        padding: 20px;
    }

    .berita-text{
        font-size: 16px;
    }
}
</style>
@endpush

<section class="berita-page">
    <div class="container">
        <div class="berita-wrap">

            <div class="back-wrap">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    ← Kembali ke Beranda
                </a>
            </div>

            @forelse($beritas as $berita)
    <div class="berita-card" style="margin-bottom: 30px;">
        <div class="berita-head">
            <div class="berita-badge">Berita BUMDesa</div>

            <h1 class="berita-title">
                {{ $berita->judul }}
            </h1>

            <div class="berita-meta">
                {{ $berita->penulis ?? 'Admin DPMD Sumenep' }}
                •
                {{ $berita->tanggal ? \Carbon\Carbon::parse($berita->tanggal)->format('d F Y') : $berita->created_at->format('d F Y') }}
                • Kabupaten Sumenep
            </div>
        </div>

        <div class="berita-image">
            @if($berita->gambar)
                <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
            @else
                <img src="{{ asset('dpmd.jpeg') }}" alt="Berita BUMDesa">
            @endif
        </div>

        <div class="berita-body">
            @if($berita->ringkasan)
                <div class="berita-caption">
                    {{ $berita->ringkasan }}
                </div>
            @endif

            <div class="berita-text">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            @if($berita->link_instagram || $berita->link_tiktok || $berita->link_facebook || $berita->link_youtube)
                <div class="berita-footer">
                    <h5>Lihat Foto dan Video Terkait</h5>

                    <div class="sosmed-links">
                        @if($berita->link_instagram)
                            <a href="{{ $berita->link_instagram }}" target="_blank" class="sosmed-btn">📸 Instagram</a>
                        @endif

                        @if($berita->link_tiktok)
                            <a href="{{ $berita->link_tiktok }}" target="_blank" class="sosmed-btn">🎵 TikTok</a>
                        @endif

                        @if($berita->link_facebook)
                            <a href="{{ $berita->link_facebook }}" target="_blank" class="sosmed-btn">📘 Facebook</a>
                        @endif

                        @if($berita->link_youtube)
                            <a href="{{ $berita->link_youtube }}" target="_blank" class="sosmed-btn">▶️ YouTube</a>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@empty
    <div class="berita-card">
        <div class="berita-body">
            Belum ada berita yang dipublikasikan.
        </div>
    </div>
@endforelse
        </div>
    </div>
</section>
@endsection