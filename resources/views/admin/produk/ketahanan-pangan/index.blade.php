<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin - Produk Ketahanan Pangan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
  :root{
    --bg:#f4f6fb;
    --card:#ffffff;
    --muted:#6b7280;
    --stroke:#e5e7eb;
    --shadow:0 12px 28px rgba(0,0,0,.08);
    --radius:16px;
    --primary:#0d6efd;
  }

  body{
    margin:0;
    background:
      radial-gradient(1200px 600px at 10% 0%, rgba(13,110,253,.10), transparent 60%),
      radial-gradient(900px 500px at 90% 10%, rgba(0,180,255,.08), transparent 55%),
      var(--bg);
    color:#111827;
    font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
  }

  .page-wrap{ padding: 22px 0 34px; }

  .page-head{
    border:1px solid var(--stroke);
    background: linear-gradient(135deg, #ffffff, #f1f5ff);
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    padding: 16px;
  }

  .page-title{
    font-size: 22px;
    font-weight: 800;
    margin: 0;
    color:#1e3a8a;
  }

  .page-sub{
    margin: 2px 0 0;
    color: var(--muted);
    font-size: 13px;
  }

  .content-card{
    border:1px solid var(--stroke);
    background: #fff;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    overflow: hidden;
  }

  .content-card .content-head{
    padding: 14px 16px;
    border-bottom: 1px solid var(--stroke);
    background: linear-gradient(180deg, #ffffff, #f8fafc);
  }

  .content-card .content-body{
    padding: 16px;
  }

  .grid{
    display:grid;
    grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
    gap: 14px;
  }

  .prod-card{
    background: var(--card);
    border: 1px solid var(--stroke);
    border-radius: 14px;
    overflow:hidden;
    box-shadow: 0 10px 22px rgba(0,0,0,.06);
    transition: .18s ease;
    height: 100%;
  }

  .prod-card:hover{
    transform: translateY(-4px);
    box-shadow:0 18px 36px rgba(13,110,253,.18);
  }

  .thumb{
    width:100%;
    height: 190px;
    object-fit: cover;
    display:block;
    background:#eef2ff;
    cursor: zoom-in;
  }

  .meta{
    padding: 10px 12px 12px;
    display:flex;
    align-items:flex-start;
    justify-content:space-between;
    gap:10px;
  }

  .name{
    margin: 0;
    font-size: 13px;
    line-height: 1.35;
    color: #111827;
    word-break: break-word;
    font-weight: 700;
  }

  .badge-soft{
    font-size: 11px;
    padding: 4px 8px;
    border-radius: 999px;
    background: rgba(13,110,253,.12);
    border: 1px solid rgba(13,110,253,.35);
    color: #1e40af;
    white-space: nowrap;
  }

  .empty{
    border:1px dashed var(--stroke);
    background: #ffffff;
    border-radius: 14px;
    padding: 18px;
    color: var(--muted);
  }

  .modal-content{
    background: #ffffff;
    border: 1px solid var(--stroke);
    border-radius: 16px;
    overflow:hidden;
  }

  .modal-header{
    border-bottom: 1px solid var(--stroke);
  }

  .modal-title{
    font-size: 14px;
    font-weight: 800;
    color:#1e3a8a;
  }

  .modal-body{
    background:#f8fafc;
  }

  .preview-img{
    width:100%;
    height:auto;
    display:block;
  }
  </style>
</head>

<body>
<div class="container page-wrap">

  <div class="page-head mb-3">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2">
      <div>
        <h1 class="page-title">Admin - Produk Ketahanan Pangan</h1>
        <p class="page-sub">Tambah, edit & hapus produk ketahanan pangan.</p>
      </div>
      <div class="d-flex gap-2 align-items-center">
        <span class="badge-soft">Total: {{ $items->count() }}</span>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">← Dashboard</a>
      </div>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="content-card mb-3">
    <div class="content-head"><b>Tambah Produk</b></div>
    <div class="content-body">
      <form action="{{ route('admin.kp.store') }}" method="POST" enctype="multipart/form-data" class="row g-2">
        @csrf
        <div class="col-md-5">
          <input type="text" name="nama" class="form-control" placeholder="Nama produk" required>
        </div>
        <div class="col-md-5">
          <input type="file" name="gambar" class="form-control" accept="image/*" required>
        </div>
        <div class="col-md-2 d-grid">
          <button class="btn btn-primary" type="submit">+ Tambah</button>
        </div>
      </form>

      @if ($errors->any())
        <div class="mt-2 text-danger small">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
    </div>
  </div>

  <div class="content-card">
    <div class="content-head">
      <div class="row g-2 align-items-center">
        <div class="col-md-9">
          <input id="q" type="text" class="form-control" placeholder="Cari nama produk… (contoh: telur, sapi)">
        </div>
        <div class="col-md-3 d-grid">
          <button class="btn btn-outline-secondary" id="btnClear" type="button">Reset</button>
        </div>
        <div class="col-12">
          <div class="small text-secondary">Menampilkan: <b id="shown">0</b> item</div>
        </div>
      </div>
    </div>

    <div class="content-body">
      @if($items->isEmpty())
        <div class="empty">Belum ada data. Silakan tambah produk di form atas.</div>
      @else
        <div class="grid" id="grid">
          @foreach($items as $i => $p)
            @php
              $path = $p->gambar ?? '';
              $nama = $p->nama ?? 'Produk';
              $modalPreviewId = 'prev' . $i;
              $modalEditId = 'edit' . $i;
            @endphp

            <div class="prod-card item" data-name="{{ strtolower($nama) }}">
              <img
                src="{{ asset($path) }}"
                alt="produk"
                class="thumb"
                data-bs-toggle="modal"
                data-bs-target="#{{ $modalPreviewId }}"
              >

              <div class="meta">
                <p class="name">{{ $nama }}</p>
                <span class="badge-soft">Foto</span>
              </div>

              <div class="px-2 pb-2 d-grid gap-2">
                <button class="btn btn-warning btn-sm" type="button"
                        data-bs-toggle="modal" data-bs-target="#{{ $modalEditId }}">
                  Edit
                </button>

                {{-- ✅ FIX: pakai model binding -> kirim $p bukan $p->id --}}
                <form action="{{ route('admin.kp.destroy', $p) }}" method="POST"
                      onsubmit="return confirm('Hapus produk ini?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                </form>
              </div>
            </div>

            <div class="modal fade" id="{{ $modalPreviewId }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <div>
                      <div class="modal-title">{{ $nama }}</div>
                      <div class="small text-secondary">{{ $path }}</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body p-0">
                    <img src="{{ asset($path) }}" alt="{{ $nama }}" class="preview-img">
                  </div>
                </div>
              </div>
            </div>

            <div class="modal fade" id="{{ $modalEditId }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <div>
                      <div class="modal-title">Edit Produk</div>
                      <div class="small text-secondary">Ubah nama / ganti gambar (opsional)</div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                  </div>

                  <div class="modal-body">
                    {{-- ✅ FIX: route update pakai $p (model binding) --}}
                    <form action="{{ route('admin.kp.update', $p) }}" method="POST" enctype="multipart/form-data" class="vstack gap-2">
                      @csrf
                      @method('PUT')

                      <label class="small fw-semibold">Nama Produk</label>
                      <input type="text" name="nama" value="{{ $nama }}" class="form-control" required>

                      <label class="small fw-semibold mt-1">Gambar Baru (opsional)</label>
                      <input type="file" name="gambar" class="form-control" accept="image/*">

                      <div class="small text-secondary mt-1">Gambar saat ini:</div>
                      <img src="{{ asset($path) }}" alt="current" style="width:100%; border-radius:12px; border:1px solid #e5e7eb">

                      <div class="d-grid mt-2">
                        <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>

          @endforeach
        </div>
      @endif
    </div>
  </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  const q = document.getElementById('q');
  const btnClear = document.getElementById('btnClear');
  const items = Array.from(document.querySelectorAll('.item'));
  const shown = document.getElementById('shown');

  function applyFilter(){
    const key = (q.value || '').trim().toLowerCase();
    let count = 0;

    items.forEach(el => {
      const name = el.getAttribute('data-name') || '';
      const ok = !key || name.includes(key);
      el.style.display = ok ? '' : 'none';
      if(ok) count++;
    });

    if(shown) shown.textContent = count;
  }

  if(shown) shown.textContent = items.length;

  q.addEventListener('input', applyFilter);
  btnClear.addEventListener('click', () => {
    q.value = '';
    applyFilter();
    q.focus();
  });
</script>
</body>
</html>
