@extends('layouts.public')
@section('title', 'Produk Ketahanan Pangan')

@section('content')

@push('styles')
<style>
/* ====== SEARCH BAR ====== */
.searchbar{
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    padding: 12px 14px;
    box-shadow: 0 10px 24px rgba(17,24,39,.06);
}
.search-icon{
    width: 42px;
    height: 42px;
    border-radius: 12px;
    display:grid;
    place-items:center;
    background: linear-gradient(135deg, rgba(13,110,253,.12), rgba(21,199,167,.12));
    border: 1px solid rgba(13,110,253,.18);
    font-size: 18px;
}
.searchbar .form-control{
    border: 0;
    outline: 0;
    box-shadow: none !important;
    font-weight: 600;
}

/* ====== CARD PRODUK (lebih profesional) ====== */
.card-pro{
    border-radius: 18px;
    border: 1px solid #e5e7eb;
    background: #ffffff;
    overflow: hidden;
    height: 100%;
    box-shadow: 0 14px 30px rgba(17,24,39,.08);
    transition: .25s ease;
}
.card-pro:hover{
    transform: translateY(-6px);
    box-shadow: 0 22px 48px rgba(17,24,39,.14);
}
.card-pro .thumb{
    width: 100%;
    aspect-ratio: 16 / 9;
    object-fit: cover;
    display: block;
    background: #eef2ff;
}
.card-pro .body{
    padding: 12px 12px 14px;
}
.card-pro .title{
    font-weight: 900;
    font-size: 13px;
    line-height: 1.3;
    margin: 0;
    text-align: center;
    color: #0b2a5a;

    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: calc(1.3em * 2);
}

/* hover zoom kecil di image */
.preview-image{
    cursor: zoom-in;
    transition: transform .25s ease;
}
.preview-image:hover{
    transform: scale(1.03);
}

/* ====== EMPTY STATE ====== */
.empty{
    display:none;
    padding: 22px;
    border-radius: 18px;
    border: 1px dashed #cbd5e1;
    background: rgba(255,255,255,.7);
    color:#64748b;
    text-align:center;
}

@media (max-width: 576px){
    .search-icon{ display:none; }
}
</style>
@endpush

<div class="container container-narrow py-5">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="fw-bold mb-0">Produk Ketahanan Pangan</h3>
            <div class="text-muted small">Galeri produk yang telah didigitalisasi.</div>
        </div>

        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm" style="border-radius:12px; font-weight:800;">
            ← Kembali
        </a>
    </div>

    {{-- JIKA DATA KOSONG --}}
    @if($items->isEmpty())
        <div class="alert alert-info">
            Belum ada produk. Silakan admin menambahkan produk terlebih dahulu.
        </div>

    {{-- JIKA ADA DATA --}}
    @else

        {{-- SEARCH --}}
        <div class="searchbar mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="search-icon">🔎</div>

                <input
                    id="searchProduk"
                    type="text"
                    class="form-control"
                    placeholder="Cari produk / kata kunci…"
                    autocomplete="off"
                />

                <div class="ms-auto small text-muted fw-semibold">
                    <span id="resultCount">{{ $items->count() }}</span> hasil
                </div>
            </div>
        </div>

        {{-- GRID PRODUK --}}
        <div class="row g-3" id="produkGrid">
            @foreach($items as $p)
                @php
                    // teks pencarian: minimal nama produk (boleh tambah kolom lain kalau ada)
                    $searchText = strtolower(trim(($p->nama ?? '')));

                    // url gambar
                    $imgUrl = asset($p->gambar);

                    // nama file download biar rapi
                    $safeName = preg_replace('/[^a-zA-Z0-9\-_]+/', '-', $p->nama ?? 'produk');
                    $fileName = strtolower(trim($safeName, '-')) . '.jpg';
                @endphp

                <div class="col-6 col-md-4 col-lg-3 produk-item" data-search="{{ $searchText }}">
                    <div class="card-pro">

                        {{-- GAMBAR (klik untuk besar + download) --}}
                        <img
                            src="{{ $imgUrl }}"
                            alt="{{ $p->nama }}"
                            class="thumb preview-image"
                            data-src="{{ $imgUrl }}"
                            data-title="{{ $p->nama }}"
                            data-filename="{{ $fileName }}"
                            loading="lazy"
                        >

                        {{-- NAMA --}}
                        <div class="body">
                            <p class="title">{{ $p->nama }}</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- EMPTY STATE untuk hasil pencarian kosong --}}
        <div class="empty mt-4" id="emptyState">
            <div style="font-size:34px">😕</div>
            <div class="fw-bold mt-2">Tidak ada hasil yang cocok</div>
            <div class="small mt-1">Coba kata kunci lain.</div>
        </div>

    @endif

</div>

{{-- MODAL PREVIEW GAMBAR (RAPI + DOWNLOAD DI FOOTER) --}}
<div class="modal fade" id="imagePreviewModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl modal-fullscreen-sm-down">
        <div class="modal-content" style="border-radius:18px; overflow:hidden;">

            {{-- HEADER --}}
            <div class="modal-header">
                <h6 class="modal-title fw-bold" id="previewTitle"></h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            {{-- BODY --}}
            <div class="modal-body p-0 bg-dark d-flex align-items-center justify-content-center">
                <img id="previewImage"
                     src=""
                     alt=""
                     style="max-width:100%; max-height:75vh; object-fit:contain;">
            </div>

            {{-- FOOTER --}}
            <div class="modal-footer justify-content-between">
                <div class="small text-muted">
                    Klik tombol untuk mengunduh gambar
                </div>

                <a id="downloadBtn"
                   href="#"
                   class="btn btn-primary btn-sm"
                   style="border-radius:12px; font-weight:800;"
                   download>
                    ⬇️ Unduh Foto
                </a>
            </div>

        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // ====== SEARCH ======
    const input   = document.getElementById('searchProduk');
    const items   = Array.from(document.querySelectorAll('.produk-item'));
    const countEl = document.getElementById('resultCount');
    const emptyEl = document.getElementById('emptyState');

    function updateCount(n){
        if (countEl) countEl.textContent = String(n);
        if (emptyEl) emptyEl.style.display = (n === 0) ? 'block' : 'none';
    }

    function filter(){
        const q = (input?.value || '').trim().toLowerCase();
        let shown = 0;

        items.forEach(el => {
            const hay = (el.getAttribute('data-search') || '').toLowerCase();
            const match = !q || hay.includes(q);
            el.style.display = match ? '' : 'none';
            if (match) shown++;
        });

        updateCount(shown);
    }

    updateCount(items.length);

    let timer = null;
    input?.addEventListener('input', () => {
        clearTimeout(timer);
        timer = setTimeout(filter, 120);
    });

    // ====== IMAGE PREVIEW + DOWNLOAD ======
    const modalEl = document.getElementById('imagePreviewModal');
    if (modalEl && window.bootstrap) {
        const modal = new bootstrap.Modal(modalEl);
        const imgEl = document.getElementById('previewImage');
        const titleEl = document.getElementById('previewTitle');
        const dlBtn = document.getElementById('downloadBtn');

        document.querySelectorAll('.preview-image').forEach(img => {
            img.addEventListener('click', () => {
                const src = img.dataset.src;
                const title = img.dataset.title || '';
                const filename = img.dataset.filename || 'foto.jpg';

                imgEl.src = src;
                imgEl.alt = title;
                titleEl.textContent = title;

                dlBtn.href = src;
                dlBtn.setAttribute('download', filename);

                modal.show();
            });
        });

        modalEl.addEventListener('hidden.bs.modal', () => {
            imgEl.src = '';
            titleEl.textContent = '';
            dlBtn.href = '#';
            dlBtn.removeAttribute('download');
        });
    }
});
</script>
@endpush
