@extends('layouts.public')

@section('content')
<div class="container my-4" style="max-width:900px;">
  <h3 class="mb-3">Tambah Produk</h3>

  @include('admin.partials.alert')

  <form method="POST" action="{{ route('admin.produk.store') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">BUMDes</label>
      <select name="bumdes_id" class="form-select" required>
        <option value="">- pilih -</option>
        @foreach($bumdes as $b)
          <option value="{{ $b->id }}" @selected(old('bumdes_id') == $b->id)>
            {{ $b->nama_bumdes }} - ({{ $b->desa->nama_desa ?? '-' }}, {{ $b->desa?->kecamatan?->nama_kecamatan ?? '-' }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Produk</label>
      <input name="nama_produk" class="form-control" value="{{ old('nama_produk') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Kategori</label>
      <input name="kategori" class="form-control" value="{{ old('kategori') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Jenis Usaha</label>
      <input name="jenis_usaha" class="form-control" value="{{ old('jenis_usaha') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Tahun</label>
      <input type="number" name="tahun" class="form-control" value="{{ old('tahun', date('Y')) }}" min="1900" max="{{ date('Y') }}" required>
    </div>

    <div class="d-flex gap-2">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.produk.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>
@endsection
