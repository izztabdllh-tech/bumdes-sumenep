<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data BUMDes</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>

<body class="admin-page">

  <header class="topbar">
    <div class="container">
      <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">

        <div class="brand-wrap">
          <img src="{{ asset('logo.png') }}" class="brand-logo" alt="Logo DPMD">
          <div>
            <p class="brand-title">DPMD - Sistem Data BUMDes</p>
            <p class="brand-subtitle">Dashboard Administrasi</p>
          </div>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light btn-sm">← Dashboard</a>

      </div>
    </div>
  </header>

  <main class="page-wrapper">
    <div class="container py-4">

      <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
        <h3 class="page-title">BUMDes</h3>
        <a href="{{ route('admin.bumdes.create') }}" class="btn btn-primary btn-sm">+ Tambah</a>
      </div>

      <div class="card card-modern">
        <div class="card-body">

          <form action="{{ route('admin.bumdes.index') }}" method="GET" class="mb-3">
            <div class="row g-2 align-items-center">
              <div class="col-12 col-md-5">
                <input type="text" name="q" class="form-control form-control-sm"
                       placeholder="Cari nama BUMDes..." value="{{ $q ?? request('q') }}">
              </div>
              <div class="col-12 col-md-auto">
                <button class="btn btn-primary btn-sm">Cari</button>
                <a href="{{ route('admin.bumdes.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
              </div>
            </div>
          </form>

          @if(session('success'))
            <div class="alert alert-success py-2 mb-3">{{ session('success') }}</div>
          @endif

          <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
              <thead>
                <tr>
                  <th style="width:50px">No</th>
                  <th>Nama BUMDes</th>
                  <th>Desa</th>
                  <th style="width:160px">Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse($data as $i => $row)
                  <tr>
                    <td>{{ $data->firstItem() + $i }}</td>
                    <td>{{ $row->nama_bumdes }}</td>
                    <td>{{ $row->desa->nama_desa ?? '-' }}</td>
                    <td>
                      <a href="{{ route('admin.bumdes.edit', $row->id) }}" class="btn btn-warning btn-sm">Edit</a>
                      <form action="{{ route('admin.bumdes.destroy', $row->id) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr><td colspan="4" class="text-center text-muted py-4">Data tidak ditemukan.</td></tr>
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

    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>