@extends('layouts.public')

@section('content')

@push('styles')
<style>
/* ===============================
   GLOBAL LAYOUT
================================ */
.page-wrap{
    padding: 48px 0;
    background:#f4f6fb;
    font-size: 15px;
}

.card-pro{
    border-radius: 18px;
    background:#ffffff;
    border: 1px solid #e6eaf0;
    box-shadow: 0 20px 45px rgba(15,23,42,.08);
    overflow:hidden;
}

/* ===============================
   HEADER (TITLE ONLY)
================================ */
.topbar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap: 20px;
    flex-wrap: wrap;
}
.title{
    margin:0;
    font-weight: 800;
    font-size: 1.75rem;
    letter-spacing: -.015em;
    color:#0f172a;
}
.subtitle{
    font-size: 1rem;
    color:#64748b;
    margin-top: 4px;
}

/* ===============================
   FILTER BAR (INSIDE CARD)
================================ */
.filter-bar{
    padding: 18px 22px;
    border-bottom: 1px solid #e6eaf0;
    background: #ffffff;
}
.filter-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap: 16px;
    flex-wrap: wrap;
}
.search-form{
    display:flex;
    gap: 10px;
    align-items:center;
    flex-wrap: wrap;
}

/* samakan tinggi input & tombol */
.search-form .form-control,
.btn-rounded{
    height: 46px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 15px;
}
.search-form .form-control{
    min-width: 360px;
    padding: 10px 16px;
}

/* ===============================
   TABLE
================================ */
.table{ margin-bottom:0; }

.table thead th{
    background:#f8fafc;
    font-size: 14px;
    font-weight: 700;
    color:#334155;
    padding: 14px 16px;
    border-bottom: 1px solid #e5e7eb;
    white-space: nowrap;
}
.table tbody td{
    font-size: 15px;
    color:#0f172a;
    padding: 14px 16px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.table tbody tr:hover{ background:#f8fafc; }

/* kolom */
th.col-no, td.col-no{ width:80px; text-align:center; }
th.col-nama, td.col-nama{ min-width: 240px; }
th.col-status, td.col-status{ min-width: 280px; }

/* badge */
.badge-soft{
    padding: .45rem .7rem;
    border-radius: 999px;
    font-weight: 800;
    font-size: 12px;
    letter-spacing: .02em;
}

/* ===============================
   FOOTER
================================ */
.footer-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap: 20px;
    flex-wrap: wrap;
    padding: 18px 22px;
    background:#ffffff;
    border-top: 1px solid #e6eaf0;
}

/* pagination */
.pagination{ margin:0; }
.page-link{
    font-size: 13px;
    padding: 8px 12px;
    border-radius: 10px !important;
}
</style>
@endpush

<div class="page-wrap">
    <div class="container-fluid px-4">

        {{-- TITLE ONLY --}}
        <div class="topbar mb-4">
            <div>
                <h3 class="title">Data BUMDes</h3>
                <div class="subtitle">Daftar BUMDes Kabupaten Sumenep</div>
            </div>
        </div>

        <div class="card-pro">

            {{-- FILTER BAR INSIDE CARD --}}
            <div class="filter-bar">
                <div class="filter-row">

                    {{-- SEARCH --}}
                    <form method="GET" action="{{ route('bumdes.index') }}" class="search-form">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control"
                               placeholder="Cari nama BUMDes..."
                               autocomplete="off">

                        <button class="btn btn-primary btn-rounded px-4" type="submit">
                            Cari
                        </button>

                        @if(request('search'))
                            <a href="{{ route('bumdes.index') }}"
                               class="btn btn-outline-secondary btn-rounded px-4">
                                Reset
                            </a>
                        @endif
                    </form>

                    {{-- EXPORT --}}
                    <div class="dropdown">
                        <button class="btn btn-success btn-rounded dropdown-toggle px-4"
                                data-bs-toggle="dropdown" aria-expanded="false">
                            Ekspor
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('bumdes.export.excel', ['search'=>request('search')]) }}">
                                    Excel (.xlsx)
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('bumdes.export.word', ['search'=>request('search')]) }}">
                                    Word (.docx)
                                </a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

            {{-- TABLE --}}
            <div class="p-4 p-lg-5">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-no">No</th>
                                <th class="col-nama">Nama BUMDes</th>
                                <th>Desa</th>
                                <th>Kecamatan</th>
                                <th>Direktur</th>
                                <th class="col-status">Status Hukum</th>
                                <th style="width:150px">Klasifikasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($bumdes as $i => $b)
                                @php
                                    $kl = strtoupper($b->klasifikasi ?? '-');
                                @endphp

                                <tr>
                                    <td class="col-no fw-semibold">
                                        {{ $bumdes->firstItem() + $i }}
                                    </td>

                                    <td class="col-nama fw-semibold">
                                        {{ $b->nama_bumdes ?? '-' }}
                                    </td>

                                    <td>{{ $b->desa->nama_desa ?? '-' }}</td>
                                    <td>{{ $b->desa->kecamatan->nama_kecamatan ?? '-' }}</td>
                                    <td>{{ $b->direktur ?? '-' }}</td>

                                    <td class="col-status">
                                        <span class="badge badge-soft bg-light text-dark border">
                                            {{ $b->status_hukum ?? '-' }}
                                        </span>
                                    </td>

                                    <td>
                                        @if($kl === 'PEMULA')
                                            <span class="badge badge-soft bg-secondary-subtle text-secondary border">PEMULA</span>
                                        @elseif($kl === 'BERKEMBANG')
                                            <span class="badge badge-soft bg-primary-subtle text-primary border">BERKEMBANG</span>
                                        @elseif($kl === 'MAJU')
                                            <span class="badge badge-soft bg-success-subtle text-success border">MAJU</span>
                                        @else
                                            <span class="badge badge-soft bg-light text-dark border">
                                                {{ $b->klasifikasi ?? '-' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        Data tidak ditemukan
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- FOOTER --}}
            <div class="footer-bar">
                <a href="{{ route('home') }}"
                   class="btn btn-outline-secondary btn-rounded px-4">
                    ← Kembali
                </a>

                <div class="d-flex align-items-center gap-4 flex-wrap">
                    <div class="text-muted">
                        Menampilkan
                        <b>{{ $bumdes->firstItem() ?? 0 }}</b>–<b>{{ $bumdes->lastItem() ?? 0 }}</b>
                        dari <b>{{ $bumdes->total() }}</b> data
                    </div>

                    <div>
                        {{ $bumdes->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
