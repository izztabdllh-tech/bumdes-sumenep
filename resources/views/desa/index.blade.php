@extends('layouts.public')

@section('content')
<div class="container my-5">
    <h3 class="fw-bold mb-3">Data Desa</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th>Nama Desa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($desa as $i => $d)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ $d->nama_desa ?? $d->nama }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center text-muted">Data tidak ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
@endsection
