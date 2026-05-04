@extends('layouts.public')

@section('content')
<div class="container my-4" style="max-width:800px;">
  <h3 class="mb-3">Edit Desa</h3>

  @include('admin.partials.alert')

  <form method="POST" action="{{ route('admin.desa.update', $desa->id) }}">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Kecamatan</label>
      <select name="kecamatan_id" class="form-select" required>
        @foreach($kecamatans as $k)
          <option value="{{ $k->id }}" @selected(old('kecamatan_id', $desa->kecamatan_id) == $k->id)>
            {{ $k->nama_kecamatan }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Nama Desa</label>
      <input name="nama_desa" class="form-control" value="{{ old('nama_desa', $desa->nama_desa) }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.desa.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection
