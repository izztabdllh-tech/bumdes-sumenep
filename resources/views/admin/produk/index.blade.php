@extends('layouts.public')

@section('content')
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produk Ketahanan Pangan</title>

  <!-- STYLE (pakai style cerah yang kemarin kamu minta) -->
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
      padding: 20px;
    }

    h2{ margin:0 0 14px; font-size:22px; font-weight:800; color:#1e3a8a; }
    .top-actions{ display:flex; justify-content:space-between; align-items:center; gap:10px; margin-bottom:14px; flex-wrap:wrap; }

    .btn-back{
      border:1px solid var(--stroke);
      background:#fff;
      padding:8px 12px;
      border-radius:12px;
      text-decoration:none;
      color:#111827;
      box-shadow: var(--shadow);
      font-size:13px;
      font-weight:700;
    }

    .grid{
      display:grid;
      grid-template-columns:repeat(auto-fill, minmax(240px, 1fr));
      gap:15px;
    }

    .card{
      background: var(--card);
      border: 1px solid var(--stroke);
      padding:10px;
      border-radius:12px;
      box-shadow: var(--shadow);
      transition:.18s ease;
    }

    .card:hover{
      transform: translateY(-3px);
      box-shadow:0 18px 36px rgba(13,110,253,.16);
    }

    img{
      width:100%;
      height:220px;
      object-fit:cover;
      border-radius:10px;
      display:block;
      background:#eef2ff;
    }

    .name{
      margin-top:8px;
      font-size:12px;
      color:#374151;
      word-break:break-word;
      font-weight:700;
    }
  </style>
</head>
<body>

<div class="top-actions">
  <h2>Produk Ketahanan Pangan</h2>
  <a class="btn-back" href="{{ route('produk.index') }}">← Kembali</a>
</div>

@if(empty($images))
  <p>Gambar kosong. Pastikan file ada di <b>public/produk/ketahanan-pangan</b></p>
@else
  <div class="grid">
    @foreach($images as $img)
      <div class="card">
        <img src="{{ asset($img['path']) }}" alt="produk">
        <div class="name">{{ $img['nama'] }}</div>
      </div>
    @endforeach
  </div>
@endif

</body>
</html>
@endsection
