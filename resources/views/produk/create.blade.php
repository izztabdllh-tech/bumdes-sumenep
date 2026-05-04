@extends('layouts.app') {{-- sesuaikan layout admin kamu --}}

@section('content')
<div class="container my-4">
    <h4 class="fw-bold mb-3">Tambah Produk</h4>

    <form action="{{ route('admin.produk.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Produk</label>
            <input type="text" name="nama_produk" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">BUMDes</label>
            <select name="bumdes_id" class="form-select" required>
                <option value="">-- pilih --</option>
                @foreach($bumdes as $b)
                    <option value="{{ $b->id }}">{{ $b->nama_bumdes }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto Produk</label>
            <input type="file" name="foto" class="form-control" accept="image/*">
        </div>

        <div class="row g-2">
            <div class="col-md-4">
                <label class="form-label">Kategori</label>
                <input type="text" name="kategori" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Jenis Usaha</label>
                <input type="text" name="jenis_usaha" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Tahun</label>
                <input type="text" name="tahun" class="form-control">
            </div>
        </div>

        <div class="mb-3 mt-2">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4"></textarea>
        </div>

        <button class="btn btn-primary">Simpan</button>
        <a href="{{ route('admin.produk.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </form>
</div>
@endsection
