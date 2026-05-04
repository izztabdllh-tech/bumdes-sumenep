<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Berita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            background: #f4f7fb;
            color: #1f2937;
        }

        .page {
            padding: 32px 42px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
            color: #111827;
        }

        .header p {
            margin-top: 8px;
            color: #6b7280;
        }

        .breadcrumb {
            color: #6b7280;
            font-size: 14px;
        }

        .breadcrumb span {
            color: #2563eb;
            font-weight: 600;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.08);
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }

        .card-header {
            padding: 24px 32px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #3b82f6;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 22px;
        }

        .card-header h2 {
            margin: 0;
            font-size: 22px;
        }

        .card-header p {
            margin: 4px 0 0;
            color: #6b7280;
        }

        .form-body {
            padding: 28px 32px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px 36px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .required {
            color: #ef4444;
        }

        input,
        textarea,
        select {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 13px 15px;
            font-size: 15px;
            outline: none;
            background: #fff;
        }

        textarea {
            min-height: 90px;
            resize: vertical;
        }

        input:focus,
        textarea:focus,
        select:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .upload-box {
            border: 1.5px dashed #cbd5e1;
            border-radius: 10px;
            padding: 18px;
            min-height: 140px;
            display: flex;
            align-items: center;
            gap: 28px;
            background: #fbfdff;
        }

        .preview-wrap {
            position: relative;
            width: 170px;
            height: 120px;
        }

        .preview-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .remove-img {
            position: absolute;
            top: -10px;
            right: -10px;
            width: 28px;
            height: 28px;
            background: #ef4444;
            color: #fff;
            border-radius: 50%;
            text-align: center;
            line-height: 28px;
            font-weight: bold;
        }

        .upload-info {
            flex: 1;
            text-align: center;
            color: #374151;
        }

        .upload-info strong {
            display: block;
            margin-bottom: 6px;
        }

        .upload-info small {
            color: #6b7280;
        }

        .upload-info input {
            margin-top: 12px;
            max-width: 320px;
        }

        .section-title {
            margin-top: 28px;
            padding-top: 22px;
            border-top: 1px solid #e5e7eb;
            font-size: 22px;
            font-weight: 700;
        }

        .section-title span {
            color: #6b7280;
            font-size: 16px;
            font-weight: 400;
        }

        .social-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 24px;
            margin-top: 18px;
        }

        .actions {
            margin-top: 30px;
            padding-top: 24px;
            border-top: 1px solid #e5e7eb;
            display: flex;
            gap: 12px;
        }

        .btn-primary {
            background: #2563eb;
            color: #fff;
            border: none;
            padding: 13px 22px;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-secondary {
            background: #f9fafb;
            color: #374151;
            border: 1px solid #d1d5db;
            padding: 13px 22px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
        }

        @media (max-width: 900px) {
            .grid,
            .social-grid {
                grid-template-columns: 1fr;
            }

            .header {
                flex-direction: column;
                gap: 12px;
            }

            .page {
                padding: 20px;
            }

            .upload-box {
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
</head>
<body>

<div class="page">
    <div class="header">
        <div>
            <h1>Edit Berita</h1>
            <p>Perbarui informasi berita pada form di bawah ini.</p>
        </div>

        <div class="breadcrumb">
            Dashboard / Berita / <span>Edit Berita</span>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="icon">📝</div>
            <div>
                <h2>Informasi Berita</h2>
                <p>Lengkapi data berita dengan benar.</p>
            </div>
        </div>

        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-body">
                <div class="grid">
                    <div>
                        <div class="form-group">
                            <label>Judul <span class="required">*</span></label>
                            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                        </div>

                        <div class="form-group">
                            <label>Ringkasan</label>
                            <textarea name="ringkasan">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Isi Berita <span class="required">*</span></label>
                            <textarea name="isi" id="isi" required>{{ old('isi', $berita->isi) }}</textarea>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label>Penulis</label>
                            <input type="text" name="penulis" value="{{ old('penulis', $berita->penulis) }}">
                        </div>

                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" value="{{ old('tanggal', $berita->tanggal) }}">
                        </div>

                        <div class="form-group">
                            <label>Status</label>
                            <select name="is_published" required>
                                <option value="1" {{ old('is_published', $berita->is_published) == 1 ? 'selected' : '' }}>
                                    Published
                                </option>
                                <option value="0" {{ old('is_published', $berita->is_published) == 0 ? 'selected' : '' }}>
                                    Draft
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Gambar</label>

                    <div class="upload-box">
                        @if($berita->gambar)
                            <div class="preview-wrap">
                                <img src="{{ asset('uploads/' . $berita->gambar) }}" alt="Gambar Berita">
                                <div class="remove-img">×</div>
                            </div>
                        @endif

                        <div class="upload-info">
                            <strong>Klik untuk mengganti gambar</strong>
                            <small>PNG, JPG, JPEG, WEBP (Max. 2MB)</small>
                            <input type="file" name="gambar" accept="image/*">
                        </div>
                    </div>
                </div>

                <div class="section-title">
                    🌐 Link Media Sosial <span>(Opsional)</span>
                </div>

                <div class="social-grid">
                    <div class="form-group">
                        <label>Instagram</label>
                        <input type="url" name="link_instagram" placeholder="https://instagram.com/..."
                               value="{{ old('link_instagram', $berita->link_instagram) }}">
                    </div>

                    <div class="form-group">
                        <label>TikTok</label>
                        <input type="url" name="link_tiktok" placeholder="https://tiktok.com/@..."
                               value="{{ old('link_tiktok', $berita->link_tiktok) }}">
                    </div>

                    <div class="form-group">
                        <label>Facebook</label>
                        <input type="url" name="link_facebook" placeholder="https://facebook.com/..."
                               value="{{ old('link_facebook', $berita->link_facebook) }}">
                    </div>

                    <div class="form-group">
                        <label>YouTube</label>
                        <input type="url" name="link_youtube" placeholder="https://youtube.com/..."
                               value="{{ old('link_youtube', $berita->link_youtube) }}">
                    </div>
                </div>

                <div class="actions">
                    <button type="submit" class="btn-primary">💾 Update Berita</button>
                    <a href="{{ route('admin.berita.index') }}" class="btn-secondary">← Kembali</a>
                </div>
            </div>
        </form>
    </div>
</div>
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
</script>

</body>
</html>