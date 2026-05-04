@extends('layouts.public')

@section('content')
<div class="container my-4" style="max-width:900px;">
  <h3 class="mb-3">Tambah BUMDes</h3>

  @include('admin.partials.alert')

  <form method="POST" action="{{ route('admin.bumdes.store') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Desa</label>
      <select name="desa_id" class="form-select" required>
        <option value="">- pilih -</option>
        @foreach($desas as $d)
          <option value="{{ $d->id }}" @selected(old('desa_id') == $d->id)>
            {{ $d->nama_desa }} - ({{ $d->kecamatan->nama_kecamatan ?? '-' }})
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama BUMDes</label>
      <input name="nama_bumdes" class="form-control" value="{{ old('nama_bumdes') }}" required>
    </div>

    <div class="row g-3">
      <div class="col-md-4">
        <label class="form-label">Direktur</label>
        <input name="direktur" class="form-control" value="{{ old('direktur') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Status Hukum</label>
        <input name="status_hukum" class="form-control" value="{{ old('status_hukum') }}">
      </div>
      <div class="col-md-4">
        <label class="form-label">Klasifikasi</label>
        <input name="klasifikasi" class="form-control" value="{{ old('klasifikasi') }}">
      </div>
    </div>

    <div class="mt-3 d-flex gap-2">
      <button class="btn btn-primary">Simpan</button>
      <a href="{{ route('admin.bumdes.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
  </form>
</div>
@endsection
