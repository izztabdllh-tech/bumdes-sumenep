@extends('layouts.public')

@section('content')
<div class="container my-4" style="max-width:800px;">
  <h3 class="mb-3">Tambah Desa</h3>

  @include('admin.partials.alert')

  <form method="POST" action="{{ route('admin.desa.store') }}">
    @csrf

    <div class="mb-3">
      <label class="form-label">Kecamatan</label>
      <select name="kecamatan_id" class="form-select" required>
        <option value="">- pilih -</option>
        @foreach($kecamatans as $k)
          <option value="{{ $k->id }}" @selected(old('kecamatan_id') == $k->id)>{{ $k->nama_kecamatan }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Desa</label>
      <input name="nama_desa" class="form-control" value="{{ old('nama_desa') }}" required>
    </div>

    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.desa.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
