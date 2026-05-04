<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Saran</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{ background:#f4f6fb; }
    .box{
      background:#fff;
      border:1px solid #e5e7eb;
      border-radius:16px;
      box-shadow:0 12px 28px rgba(0,0,0,.08);
      padding:16px;
    }

    .notif-toast{
      min-width: 320px;
      max-width: 420px;
      border-radius: 14px;
      overflow: hidden;
      box-shadow: 0 14px 34px rgba(0,0,0,.18);
      animation: slideIn .35s ease;
    }

    @keyframes slideIn{
      from{
        opacity:0;
        transform:translateY(-10px) translateX(20px);
      }
      to{
        opacity:1;
        transform:translateY(0) translateX(0);
      }
    }
  </style>
</head>
<body>

@php
  $notifikasi = \App\Models\Saran::whereNotNull('tanggapan')
      ->where('is_read_user', false)
      ->latest()
      ->first();
@endphp

<div class="container py-4">
  <div class="box mb-3 d-flex justify-content-between align-items-center flex-wrap gap-2">
    <div>
      <h4 class="mb-0 fw-bold">Form Saran</h4>
      <small class="text-muted">Masukan Anda sangat membantu pengembangan sistem.</small>
    </div>
    <div class="d-flex gap-2">
      <a href="{{ url()->previous() }}" class="btn btn-outline-primary btn-sm">← Kembali</a>
      <a href="{{ url('/') }}" class="btn btn-primary btn-sm">Home</a>
    </div>
  </div>

  @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0 ps-3">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="box">
    <form method="POST" action="{{ route('saran.store') }}">
      @csrf

      <div class="mb-3">
        <label class="form-label fw-semibold">Nama</label>
        <input
          type="text"
          name="nama"
          class="form-control"
          value="{{ old('nama') }}"
          placeholder="Masukkan nama Anda..."
        >
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Kontak (opsional)</label>
        <input
          type="text"
          name="kontak"
          class="form-control"
          value="{{ old('kontak') }}"
          placeholder="Masukkan email / nomor HP..."
        >
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Kategori</label>
        <select name="kategori" class="form-select">
          <option value="">-- Pilih kategori --</option>
          <option value="Umum" {{ old('kategori') == 'Umum' ? 'selected' : '' }}>Umum</option>
          <option value="Pelayanan" {{ old('kategori') == 'Pelayanan' ? 'selected' : '' }}>Pelayanan</option>
          <option value="Sistem" {{ old('kategori') == 'Sistem' ? 'selected' : '' }}>Sistem</option>
          <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label fw-semibold">Saran / Masukan</label>
        <textarea
          name="pesan"
          class="form-control"
          rows="5"
          placeholder="Tuliskan saran Anda..."
        >{{ old('pesan') }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">Kirim Saran</button>
    </form>
  </div>
</div>

@if($notifikasi)
  <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="notifToast" class="toast show text-bg-primary border-0 notif-toast">
      <div class="d-flex">
        <div class="toast-body">
          🔔 <strong>Balasan Admin</strong><br>
          {{ $notifikasi->tanggapan }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" aria-label="Close" onclick="hideToast()"></button>
      </div>
    </div>
  </div>

  <audio id="notifSound" autoplay>
    <source src="https://www.soundjay.com/buttons/sounds/button-3.mp3" type="audio/mpeg">
  </audio>

  @php
    \App\Models\Saran::where('id', $notifikasi->id)
        ->update(['is_read_user' => true]);
  @endphp
@endif

<script>
function hideToast() {
  const toast = document.getElementById('notifToast');
  if (toast) {
    toast.style.display = 'none';
  }
}

setTimeout(() => {
  hideToast();
}, 5000);
</script>

</body>
</html>