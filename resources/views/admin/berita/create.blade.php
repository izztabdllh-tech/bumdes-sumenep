@extends('layouts.admin')

@section('content')
<style>
/* CSS kamu tetap sama, hanya bagian editor ditambah sedikit */
.news-create-page{
    background:#f6f8fc;
    min-height:100vh;
    padding:34px 36px;
    color:#0f172a;
}

.news-create-head{
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    margin-bottom:28px;
}

.news-breadcrumb{
    color:#64748b;
    font-size:14px;
    margin-bottom:14px;
}

.news-title{
    font-size:34px;
    font-weight:900;
    margin:0;
    color:#0f172a;
}

.news-subtitle{
    color:#64748b;
    margin-top:8px;
    font-size:16px;
}

.btn-back{
    background:#fff;
    border:1px solid #dbe3ef;
    color:#0f172a;
    padding:14px 22px;
    border-radius:12px;
    font-weight:800;
    text-decoration:none;
    box-shadow:0 8px 22px rgba(15,23,42,.04);
}

.news-form-grid{
    display:grid;
    grid-template-columns:1.45fr .95fr;
    gap:22px;
}

.news-card{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:18px;
    padding:26px;
    box-shadow:0 12px 30px rgba(15,23,42,.05);
}

.news-card-title{
    display:flex;
    align-items:center;
    gap:10px;
    font-size:20px;
    font-weight:900;
    margin-bottom:24px;
}

.news-card-icon{
    width:32px;
    height:32px;
    border-radius:10px;
    background:#eaf2ff;
    color:#1f6feb;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
}

.form-group{
    margin-bottom:22px;
}

.form-label{
    display:block;
    font-weight:800;
    color:#0f172a;
    margin-bottom:9px;
}

.required{
    color:#ef4444;
}

.form-input,
.form-select,
.form-textarea{
    width:100%;
    border:1px solid #dbe3ef;
    border-radius:10px;
    background:#fff;
    padding:14px 16px;
    font-size:15px;
    outline:none;
    color:#0f172a;
}

.form-input:focus,
.form-select:focus,
.form-textarea:focus{
    border-color:#1f6feb;
    box-shadow:0 0 0 4px rgba(31,111,235,.08);
}

.form-textarea{
    min-height:125px;
    resize:vertical;
}

.counter{
    text-align:right;
    color:#64748b;
    font-size:13px;
    margin-top:7px;
}

.upload-box{
    border:2px dashed #93c5fd;
    background:#f8fbff;
    border-radius:14px;
    min-height:145px;
    display:flex;
    flex-direction:column;
    justify-content:center;
    align-items:center;
    text-align:center;
    color:#64748b;
    cursor:pointer;
    padding:20px;
}

.upload-icon{
    font-size:42px;
    color:#1f6feb;
    margin-bottom:8px;
}

.upload-box strong{
    color:#1f6feb;
    font-size:16px;
}

.upload-box input{
    margin-top:14px;
}

.two-col{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:16px;
}

.action-bar{
    background:#fff;
    border:1px solid #e5e7eb;
    border-radius:18px;
    margin-top:22px;
    padding:22px 24px;
    display:flex;
    justify-content:flex-end;
    gap:14px;
    box-shadow:0 12px 30px rgba(15,23,42,.05);
}

.btn-cancel{
    background:#f1f5f9;
    border:1px solid #dbe3ef;
    color:#0f172a;
    padding:14px 30px;
    border-radius:10px;
    font-weight:900;
    text-decoration:none;
}

.btn-save{
    background:#1f6feb;
    border:0;
    color:#fff;
    padding:14px 30px;
    border-radius:10px;
    font-weight:900;
    box-shadow:0 12px 24px rgba(31,111,235,.25);
}

@media(max-width:992px){
    .news-create-page{
        padding:24px;
    }

    .news-create-head{
        flex-direction:column;
        gap:18px;
    }

    .news-form-grid,
    .two-col{
        grid-template-columns:1fr;
    }
}
</style>

<div class="news-create-page">

    <div class="news-create-head">
        <div>
            <div class="news-breadcrumb">Dashboard / Berita / Tambah Berita</div>
            <h1 class="news-title">Tambah Berita</h1>
            <div class="news-subtitle">Buat berita baru untuk ditampilkan di halaman publik</div>
        </div>

        <a href="{{ route('admin.berita.index') }}" class="btn-back">
            ← Kembali ke Daftar Berita
        </a>
    </div>

    <form id="beritaForm" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="news-form-grid">

            <div class="news-card">
                <div class="news-card-title">
                    <span class="news-card-icon">📝</span>
                    Konten Berita
                </div>

                <div class="form-group">
                    <label class="form-label">Judul Berita <span class="required">*</span></label>
                    <input type="text" name="judul" class="form-input" placeholder="Masukkan judul berita" value="{{ old('judul') }}" required>
                </div>

                <div class="form-group">
                    <label class="form-label">Ringkasan</label>
                    <textarea name="ringkasan" class="form-textarea" placeholder="Tulis ringkasan singkat berita">{{ old('ringkasan') }}</textarea>
                </div>

                <div class="form-group">
                    <label class="form-label">Isi Berita <span class="required">*</span></label>
                    <textarea name="isi" id="isi">{{ old('isi') }}</textarea>
                </div>
            </div>

            <div class="news-card">
                <div class="news-card-title">
                    <span class="news-card-icon">⚙️</span>
                    Pengaturan Berita
                </div>

                <div class="form-group">
                    <label class="form-label">Gambar Utama</label>
                    <label class="upload-box">
                        <div class="upload-icon">☁️</div>
                        <strong>Klik untuk upload gambar</strong>
                        <div>Format: JPG, PNG, JPEG, WEBP. Maks 2MB</div>
                        <input type="file" name="gambar" accept="image/*">
                    </label>
                </div>

                <div class="form-group">
                    <label class="form-label">Penulis</label>
                    <input type="text" name="penulis" class="form-input" value="{{ old('penulis', 'Admin DPMD Sumenep') }}">
                </div>

                <div class="two-col">
                    <div class="form-group">
                        <label class="form-label">Tanggal</label>
                        <input type="date" name="tanggal" class="form-input" value="{{ old('tanggal', date('Y-m-d')) }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Status</label>
                        <select name="is_published" class="form-select">
                            <option value="1" {{ old('is_published') == '1' ? 'selected' : '' }}>Dipublikasikan</option>
                            <option value="0" {{ old('is_published') == '0' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                </div>

                <div class="two-col">
                    <div class="form-group">
                        <label class="form-label">Link Instagram <span style="color:#64748b;">(opsional)</span></label>
                        <input type="url" name="link_instagram" class="form-input" placeholder="https://instagram.com/username" value="{{ old('link_instagram') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Link TikTok <span style="color:#64748b;">(opsional)</span></label>
                        <input type="url" name="link_tiktok" class="form-input" placeholder="https://tiktok.com/@username" value="{{ old('link_tiktok') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Link Facebook <span style="color:#64748b;">(opsional)</span></label>
                        <input type="url" name="link_facebook" class="form-input" placeholder="https://facebook.com/username" value="{{ old('link_facebook') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Link YouTube <span style="color:#64748b;">(opsional)</span></label>
                        <input type="url" name="link_youtube" class="form-input" placeholder="https://youtube.com/@username" value="{{ old('link_youtube') }}">
                    </div>
                </div>
            </div>

        </div>

        <div class="action-bar">
            <a href="{{ route('admin.berita.index') }}" class="btn-cancel">Batal</a>
            <button type="submit" class="btn-save">💾 Simpan Berita</button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.2/tinymce.min.js"></script>

<script>
tinymce.init({
    selector: '#isi',
    height: 350,
    menubar: false,
    branding: false,
    plugins: 'lists advlist link image table code',
    toolbar: 'undo redo | fontselect fontsizeselect | bold italic underline | bullist numlist | alignleft aligncenter alignright alignjustify | link image | code',

    font_formats: `
        Arial=arial,helvetica,sans-serif;
        Times New Roman=times new roman,times;
        Courier New=courier new,courier;
        Georgia=georgia,serif;
        Verdana=verdana,geneva,sans-serif;
        Tahoma=tahoma,arial,helvetica,sans-serif;
    `,

    fontsize_formats: "8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt",

    advlist_bullet_styles: 'default,circle,square',
    advlist_number_styles: 'default,lower-alpha,upper-alpha,lower-roman,upper-roman'
});

document.getElementById('beritaForm').addEventListener('submit', function () {
    tinymce.triggerSave();
});
</script>
@endpush