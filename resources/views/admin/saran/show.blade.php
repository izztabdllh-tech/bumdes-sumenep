@extends('layouts.public')
@section('title','Detail Saran')

@section('content')
<div class="container container-narrow py-5">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h3 class="fw-bold mb-0">Detail Saran</h3>
            <div class="text-muted small">Kelola status dan tulis tanggapan resmi.</div>
        </div>
        <a href="{{ route('admin.saran.index') }}" class="btn btn-outline-primary btn-sm">← Kembali</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="row g-3">
        <div class="col-lg-6">
            <div class="card shadow-sm" style="border-radius:16px;">
                <div class="card-body">
                    <div class="fw-semibold">Pengirim</div>
                    <div class="mb-2">{{ $saran->nama }}</div>

                    <div class="fw-semibold">Kontak</div>
                    <div class="mb-2">{{ $saran->kontak ?? '-' }}</div>

                    <div class="fw-semibold">Kategori</div>
                    <div class="mb-2">{{ $saran->kategori }}</div>

                    <div class="fw-semibold">Pesan</div>
                    <div class="p-3 bg-light" style="border-radius:12px;">
                        {{ $saran->pesan }}
                    </div>

                    <div class="text-muted small mt-3">
                        Dikirim: {{ $saran->created_at->format('d M Y H:i') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card shadow-sm" style="border-radius:16px;">
                <div class="card-body">
                    <h6 class="fw-bold mb-3">Tanggapan Admin</h6>

                    <form method="POST" action="{{ route('admin.saran.update', $saran->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Baru" @selected($saran->status=='Baru')>Baru</option>
                                <option value="Diproses" @selected($saran->status=='Diproses')>Diproses</option>
                                <option value="Selesai" @selected($saran->status=='Selesai')>Selesai</option>
                            </select>
                        </div>

                        <div class="mb-2">
                            <label class="form-label fw-semibold">Tanggapan</label>
                            <textarea name="tanggapan" class="form-control" rows="6"
                                placeholder="Tulis tanggapan resmi...">{{ old('tanggapan', $saran->tanggapan) }}</textarea>
                            @error('tanggapan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button class="btn btn-primary w-100">Simpan</button>
                    </form>

                    @if($saran->ditanggapi_pada)
                        <div class="text-muted small mt-3">
                            Ditanggapi: {{ \Carbon\Carbon::parse($saran->ditanggapi_pada)->format('d M Y H:i') }}
                            @if($saran->ditanggapi_oleh) — oleh <b>{{ $saran->ditanggapi_oleh }}</b> @endif
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.saran.destroy', $saran->id) }}"
                          onsubmit="return confirm('Hapus saran ini?')" class="mt-3">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100">Hapus</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection
