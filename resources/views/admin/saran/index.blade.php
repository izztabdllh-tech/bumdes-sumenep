@extends('layouts.public')
@section('title','Admin - Saran')

@section('content')
<div class="container container-narrow py-5">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
        <div>
            <h3 class="fw-bold mb-0">Kotak Saran</h3>
            <div class="text-muted small">Kelola masukan dari masyarakat (status, tanggapan, arsip).</div>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary btn-sm">← Dashboard</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form class="row g-2 mb-3">
        <div class="col-md-7">
            <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Cari nama/kontak/kategori/pesan...">
        </div>
        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Semua Status</option>
                <option value="Baru" @selected($status=='Baru')>Baru</option>
                <option value="Diproses" @selected($status=='Diproses')>Diproses</option>
                <option value="Selesai" @selected($status=='Selesai')>Selesai</option>
            </select>
        </div>
        <div class="col-md-2 d-grid">
            <button class="btn btn-primary">Filter</button>
        </div>
    </form>

    <div class="card shadow-sm" style="border-radius:16px; overflow:hidden;">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th class="d-none d-md-table-cell">Tanggal</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $s)
                        <tr>
                            <td>
                                <div class="fw-semibold">{{ $s->nama }}</div>
                                <div class="text-muted small">{{ $s->kontak ?? '-' }}</div>
                            </td>
                            <td>{{ $s->kategori }}</td>
                            <td>
                                @php
                                    $badge = match($s->status){
                                        'Baru' => 'bg-warning',
                                        'Diproses' => 'bg-primary',
                                        'Selesai' => 'bg-success',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $badge }}">{{ $s->status }}</span>
                            </td>
                            <td class="d-none d-md-table-cell text-muted small">
                                {{ $s->created_at->format('d M Y H:i') }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('admin.saran.show', $s->id) }}" class="btn btn-sm btn-outline-primary">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-4">
                                Belum ada saran masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-3">
        {{ $items->links() }}
    </div>

</div>
@endsection
