@extends('layouts.public')

@section('content')
<div class="container my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="fw-bold m-0">Manajemen Wilayah Administratif</h3>

        <form method="GET" action="{{ route('kecamatan.index') }}" class="d-flex gap-2">
            <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Cari kecamatan / desa...">
            <button class="btn btn-primary">Cari</button>
        </form>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px;">No</th>
                            <th style="width:220px;">Nama Kecamatan</th>
                            <th>Daftar Desa</th>
                            <th style="width:130px;">Jumlah Desa</th>
                        </tr>
                    </thead>
                    <tbody>
@foreach ($kecamatans as $i => $k)
    <tr>
        <td>{{ $i + 1 }}</td>
        <td>{{ $k->nama_kecamatan }}</td>

        <td>
            <ul>
                @foreach ($k->desas as $d)
                    <li>{{ $d->nama_desa }}</li>
                @endforeach
            </ul>
        </td>

        {{-- INI tempatnya --}}
        <td>{{ $k->desas_count }}</td>
    </tr>
@endforeach
</tbody>

                </table>
            </div>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary mt-3">← Kembali</a>
        </div>
    </div>
</div>
@endsection
