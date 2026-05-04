@extends('layouts.admin')

@section('content')
<style>
.berita-admin-page {
    background: #f6f8fc;
    min-height: 100vh;
    padding: 36px 52px;
}

.berita-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 26px;
}

.breadcrumb {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 12px;
}

.page-title {
    font-size: 36px;
    font-weight: 900;
    color: #0f172a;
    margin: 0;
}

.page-subtitle {
    color: #64748b;
    margin-top: 6px;
}

.btn-add {
    background: #1f6feb;
    color: white;
    padding: 15px 24px;
    border-radius: 12px;
    font-weight: 800;
    text-decoration: none;
    box-shadow: 0 12px 24px rgba(31,111,235,.22);
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 22px;
}

.stat-box {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    padding: 24px;
    display: flex;
    gap: 16px;
    align-items: center;
    box-shadow: 0 10px 24px rgba(15,23,42,.04);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
}

.stat-blue { background:#eaf2ff; color:#1f6feb; }
.stat-green { background:#eafaf1; color:#16a34a; }
.stat-orange { background:#fff4df; color:#f59e0b; }
.stat-purple { background:#f2eafe; color:#7c3aed; }

.stat-label {
    color:#475569;
    font-weight:700;
    margin-bottom:6px;
}

.stat-number {
    font-size:28px;
    font-weight:900;
    color:#0f172a;
    line-height:1;
}

.stat-small {
    color:#64748b;
    font-size:14px;
    margin-top:6px;
}

.table-card {
    background:white;
    border:1px solid #e5e7eb;
    border-radius:20px;
    padding:18px;
    box-shadow: 0 12px 32px rgba(15,23,42,.05);
}

.filter-row {
    display:grid;
    grid-template-columns: 2fr 1fr 1fr 1fr auto;
    gap:14px;
    margin-bottom:20px;
}

.filter-row input,
.filter-row select {
    height:48px;
    border:1px solid #dbe3ef;
    border-radius:12px;
    padding:0 14px;
    outline:none;
    color:#334155;
}

.btn-filter {
    height:48px;
    border:none;
    border-radius:12px;
    background:#1f6feb;
    color:white;
    padding:0 20px;
    font-weight:800;
}

.berita-table {
    width:100%;
    border-collapse:collapse;
}

.berita-table th {
    text-align:left;
    color:#64748b;
    font-size:13px;
    padding:14px 10px;
    border-bottom:1px solid #eef2f7;
}

.berita-table td {
    padding:16px 10px;
    border-bottom:1px solid #eef2f7;
    vertical-align:middle;
    color:#334155;
}

.thumb {
    width:96px;
    height:66px;
    border-radius:12px;
    object-fit:cover;
}

.news-title {
    font-weight:900;
    color:#0f172a;
    margin-bottom:6px;
}

.news-summary {
    color:#64748b;
    font-size:14px;
    max-width:420px;
}

.badge-publish {
    background:#dcfce7;
    color:#16a34a;
    padding:7px 12px;
    border-radius:999px;
    font-weight:800;
    font-size:13px;
}

.badge-draft {
    background:#fef3c7;
    color:#f59e0b;
    padding:7px 12px;
    border-radius:999px;
    font-weight:800;
    font-size:13px;
}

.action-group {
    display:flex;
    gap:8px;
}

.action-btn {
    width:38px;
    height:38px;
    border-radius:10px;
    border:none;
    display:flex;
    align-items:center;
    justify-content:center;
    text-decoration:none;
    cursor:pointer;
}

.btn-view { background:#eaf2ff; color:#1f6feb; }
.btn-edit { background:#fff4df; color:#f59e0b; }
.btn-delete { background:#fee2e2; color:#ef4444; }

.empty-row {
    text-align:center;
    padding:40px;
    color:#64748b;
}

.table-footer {
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-top:18px;
    color:#64748b;
    font-size:14px;
}

@media(max-width: 992px) {
    .berita-admin-page { padding:24px; }
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .filter-row { grid-template-columns: 1fr; }
}
</style>

<div class="berita-admin-page">

    <div class="berita-header">
        <div>
            <div class="breadcrumb">Dashboard / Berita</div>
            <h1 class="page-title">Kelola Berita</h1>
            <div class="page-subtitle">Daftar berita yang tampil di halaman publik</div>
        </div>

        <a href="{{ route('admin.berita.create') }}" class="btn-add">
            + Tambah Berita
        </a>
    </div>

    <div class="stats-row">
        <div class="stat-box">
            <div class="stat-icon stat-blue">📰</div>
            <div>
                <div class="stat-label">Total Berita</div>
                <div class="stat-number">{{ $beritas->count() }}</div>
                <div class="stat-small">Semua berita</div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon stat-green">✓</div>
            <div>
                <div class="stat-label">Dipublikasikan</div>
                <div class="stat-number">{{ $beritas->where('is_published', 1)->count() }}</div>
                <div class="stat-small">Berita aktif</div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon stat-orange">📄</div>
            <div>
                <div class="stat-label">Draft</div>
                <div class="stat-number">{{ $beritas->where('is_published', 0)->count() }}</div>
                <div class="stat-small">Belum dipublikasikan</div>
            </div>
        </div>

        <div class="stat-box">
            <div class="stat-icon stat-purple">👁</div>
            <div>
                <div class="stat-label">Total Dilihat</div>
                <div class="stat-number">0</div>
                <div class="stat-small">Total views</div>
            </div>
        </div>
    </div>

    <div class="table-card">
        <form method="GET" action="{{ route('admin.berita.index') }}" class="filter-row">
    <input type="text" name="search" placeholder="Cari judul berita..." value="{{ request('search') }}">

    <select name="status">
        <option value="">Semua Status</option>
        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Dipublikasikan</option>
        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Draft</option>
    </select>

    <select name="penulis">
        <option value="">Semua Penulis</option>
        <option value="Admin DPMD Sumenep" {{ request('penulis') === 'Admin DPMD Sumenep' ? 'selected' : '' }}>
            Admin DPMD Sumenep
        </option>
    </select>

    <input type="date" name="tanggal" value="{{ request('tanggal') }}">

    <button type="submit" class="btn-filter">Filter</button>
</form>

        <table class="berita-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Judul Berita</th>
                    <th>Penulis</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($beritas as $berita)
                    <tr>
                        <td>{{ $loop->iteration }}</td>

                        <td>
                            @if($berita->gambar)
                                <img src="{{ asset('uploads/' . $berita->gambar) }}" class="thumb">
                            @else
                                <img src="{{ asset('dpmd.jpeg') }}" class="thumb">
                            @endif
                        </td>

                        <td>
                            <div class="news-title">{{ $berita->judul }}</div>
                            <div class="news-summary">
                                {{ Str::limit($berita->ringkasan ?? $berita->isi, 95) }}
                            </div>
                        </td>

                        <td>{{ $berita->penulis ?? 'Admin DPMD Sumenep' }}</td>

                        <td>
                            {{ $berita->tanggal 
                                ? \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') 
                                : $berita->created_at->format('d M Y') }}
                        </td>

                        <td>
                            @if($berita->is_published)
                                <span class="badge-publish">Dipublikasikan</span>
                            @else
                                <span class="badge-draft">Draft</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-group">
                                <a href="{{ route('berita.index') }}" class="action-btn btn-view">👁</a>

                                <a href="{{ route('admin.berita.edit', $berita->id) }}" class="action-btn btn-edit">✎</a>

                                <form action="{{ route('admin.berita.destroy', $berita->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Yakin ingin menghapus berita ini?')"
                                            class="action-btn btn-delete">
                                        🗑
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="empty-row">
                            Belum ada berita.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="table-footer">
            <div>Menampilkan {{ $beritas->count() }} berita</div>
            <div>Halaman 1</div>
        </div>
    </div>
</div>
@endsection