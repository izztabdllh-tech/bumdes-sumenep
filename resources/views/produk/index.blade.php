@extends('layouts.public')
@section('title', 'Digitalisasi Produk')

@section('content')
<div class="container container-narrow py-5">
    <div class="text-center mb-4">
        <h3 class="fw-bold mb-1">Digitalisasi Produk</h3>
        <p class="text-muted mb-0">Silakan pilih kategori produk.</p>
    </div>

    <div class="row g-3 justify-content-center">
        <div class="col-md-4">
            <a href="{{ route('produk.ketahanan_pangan') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100" style="border-radius:16px;">
                    <div class="card-body text-center py-4">
                        <div style="font-size:40px;">🌾</div>
                        <h6 class="fw-bold mt-2 mb-1">Ketahanan Pangan</h6>
                        <div class="text-muted small">Produk pangan, pertanian, dan sejenisnya.</div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4">
            <a href="{{ route('produk.unit_usaha') }}" class="text-decoration-none">
                <div class="card shadow-sm h-100" style="border-radius:16px;">
                    <div class="card-body text-center py-4">
                        <div style="font-size:40px;">🏪</div>
                        <h6 class="fw-bold mt-2 mb-1">Unit Usaha</h6>
                        <div class="text-muted small">Produk/unit usaha BUMDes lainnya.</div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="text-center mt-4">
        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">← Kembali</a>
    </div>
</div>
@endsection
