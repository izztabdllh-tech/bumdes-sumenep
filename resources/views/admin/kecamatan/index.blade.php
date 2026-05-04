<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Kecamatan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* ===========================
       OPSI B - BACKGROUND GRADIENT (HALAMAN)
       =========================== */
    body.admin-page{
      min-height: 100vh;
      background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 50%, #f8fafc 100%);
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
    }

    /* ===========================
       OPSI D - HEADER / TOPBAR BRANDING
       (pakai dpmd.jpeg + overlay)
       =========================== */
    .topbar{
      position: relative;
      overflow: hidden;
      color: #fff;
      border-bottom: 1px solid rgba(255,255,255,.15);
    }

    .topbar::before{
      content: "";
      position: absolute;
      inset: 0;
      background: url("{{ asset('dpmd.jpeg') }}") center/cover no-repeat;
      transform: scale(1.05);
      z-index: 0;
    }

    .topbar::after{
      content: "";
      position: absolute;
      inset: 0;
      background: linear-gradient(
        135deg,
        rgba(15,23,42,.92) 0%,
        rgba(30,58,138,.85) 60%,
        rgba(15,23,42,.92) 100%
      );
      z-index: 1;
    }

    .topbar .container{
      position: relative;
      z-index: 2;
    }

    .brand-wrap{
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 14px 0;
    }

    .brand-logo{
      width: 46px;
      height: 46px;
      object-fit: contain;
      background: rgba(255,255,255,.14);
      border: 1px solid rgba(255,255,255,.20);
      border-radius: 12px;
      padding: 6px;
    }

    .brand-title{
      margin: 0;
      font-weight: 800;
      font-size: 18px;
      line-height: 1.1;
    }

    .brand-subtitle{
      margin: 0;
      font-size: 12px;
      opacity: .9;
    }

    /* ===========================
       KONTEN PAGE
       =========================== */
    .page-title{
      font-size: 22px;
      font-weight: 800;
      color: #111827;
      margin: 0;
    }

    /* Card modern */
    .card-modern{
      border: 1px solid rgba(0,0,0,.06);
      border-radius: 14px;
      box-shadow: 0 10px 25px rgba(0,0,0,.06);
      overflow: hidden;
    }

    /* Table header soft */
    .table thead th{
      background: #f3f4f6 !important;
      color: #111827 !important;
      font-weight: 700;
      border-bottom: 1px solid rgba(0,0,0,.08) !important;
    }

    /* Hover halus */
    .table-hover tbody tr:hover{
      background: rgba(0,0,0,.02);
    }

    /* Input & tombol rounding */
    .form-control{
      border-radius: 10px;
    }

    .btn{
      border-radius: 10px;
      font-weight: 600;
    }

    /* Pagination */
    .pagination .page-link{
      border-radius: 8px !important;
      margin: 0 3px;
    }
  </style>
</head>

<body class="admin-page">

  <!-- HEADER (OPSI D) -->
  <header class="topbar">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="brand-wrap">
          <img src="{{ asset('logo.png') }}" alt="Logo DPMD" class="brand-logo">
          <div>
            <p class="brand-title">DPMD - Sistem Data Kecamatan</p>
            <p class="brand-subtitle">Dashboard Administrasi</p>
          </div>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">
          ← Dashboard
        </a>
      </div>
    </div>
  </header>

  <!-- CONTENT -->
  <main class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
      <h3 class="page-title">Kecamatan</h3>
      <a href="{{ route('admin.kecamatan.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
    </div>

    <div class="card card-modern">
      <div class="card-body">

        {{-- SEARCH DI DALAM CARD --}}
        <form action="{{ route('admin.kecamatan.index') }}" method="GET" class="mb-3">
          <div class="row g-2 align-items-center">
            <div class="col-12 col-md-5">
              <input type="text" name="q" class="form-control form-control-sm"
                     placeholder="Cari nama kecamatan..." value="{{ $q ?? '' }}">
            </div>
            <div class="col-12 col-md-auto">
              <button class="btn btn-primary btn-sm">Cari</button>
              <a href="{{ route('admin.kecamatan.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
          </div>
        </form>

        @if(session('success'))
          <div class="alert alert-success py-2">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
          <table class="table table-bordered table-hover align-middle mb-0">
            <thead>
              <tr>
                <th style="width:50px">No</th>
                <th>Nama Kecamatan</th>
                <th style="width:160px">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @forelse($data as $i => $row)
                <tr>
                  <td>{{ $data->firstItem() + $i }}</td>
                  <td>{{ $row->nama_kecamatan }}</td>
                  <td>
                    <a href="{{ route('admin.kecamatan.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.kecamatan.destroy', $row->id) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus data ini?')">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="3" class="text-center text-muted py-4">Data tidak ditemukan.</td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mt-3">
          <div>
            {{ $data->onEachSide(1)->links('pagination::bootstrap-5') }}
          </div>

          <div class="small text-muted">
            Showing {{ $data->firstItem() ?? 0 }} to {{ $data->lastItem() ?? 0 }} of {{ $data->total() }} results
          </div>
        </div>

      </div>
    </div>

  </main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>