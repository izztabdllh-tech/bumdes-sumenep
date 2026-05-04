@extends('layouts.public')
@section('title', 'Aktivitas Data')

@section('content')
<div class="container py-4">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                <div>
                    <h3 class="mb-1">Aktivitas Data</h3>
                    <p class="text-muted mb-0">Riwayat aktivitas admin dalam pengelolaan data</p>
                </div>
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <form method="GET" action="{{ route('admin.aktivitas.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari aktivitas..." value="{{ request('keyword') }}">
                </div>

                <div class="col-md-3">
                    <select name="module" class="form-select">
                        <option value="">Semua Modul</option>
                        <option value="Kecamatan" {{ request('module') == 'Kecamatan' ? 'selected' : '' }}>Kecamatan</option>
                        <option value="Desa" {{ request('module') == 'Desa' ? 'selected' : '' }}>Desa</option>
                        <option value="BUMDes" {{ request('module') == 'BUMDes' ? 'selected' : '' }}>BUMDes</option>
                        <option value="Produk" {{ request('module') == 'Produk' ? 'selected' : '' }}>Produk</option>
                        <option value="Saran" {{ request('module') == 'Saran' ? 'selected' : '' }}>Saran</option>
                        <option value="Login" {{ request('module') == 'Login' ? 'selected' : '' }}>Login</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="action" class="form-select">
                        <option value="">Semua Aksi</option>
                        <option value="LOGIN" {{ request('action') == 'LOGIN' ? 'selected' : '' }}>LOGIN</option>
                        <option value="CREATE" {{ request('action') == 'CREATE' ? 'selected' : '' }}>CREATE</option>
                        <option value="UPDATE" {{ request('action') == 'UPDATE' ? 'selected' : '' }}>UPDATE</option>
                        <option value="DELETE" {{ request('action') == 'DELETE' ? 'selected' : '' }}>DELETE</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filter</button>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Aksi</th>
                            <th>Modul</th>
                            <th>Deskripsi</th>
                            <th>IP</th>
                            <th>Waktu</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($logs as $index => $log)
                            <tr>
                                <td>{{ $logs->firstItem() + $index }}</td>
                                <td>{{ $log->username ?? '-' }}</td>
                                <td>{{ $log->action }}</td>
                                <td>{{ $log->module }}</td>
                                <td>{{ $log->description ?? '-' }}</td>
                                <td>{{ $log->ip_address ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d-m-Y H:i:s') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada aktivitas data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $logs->links() }}
            </div>
        </div>
    </div>
</div>
@endsection