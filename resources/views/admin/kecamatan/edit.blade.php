@extends('layouts.public')

@section('content')
<div class="container my-4" style="max-width:700px;">
  <h3 class="mb-3">Edit Kecamatan</h3>

  @include('admin.partials.alert')

  <form method="POST" action="{{ route('admin.kecamatan.update', $kecamatan->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Nama Kecamatan</label>
      <input name="nama_kecamatan" class="form-control" value="{{ old('nama_kecamatan', $kecamatan->nama_kecamatan) }}" required>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.kecamatan.index') }}" class="btn btn-secondary">Kembali</a>
  </form>
</div>
@endsection