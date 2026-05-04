@extends('layouts.public')

@section('content')
<style>
    :root{
        --blue:#0d6efd;
        --shadow:0 8px 18px rgba(0,0,0,.08);
        --radius:14px;
    }

    .org-wrap{ display:flex; justify-content:center; padding:10px 0; }
    .org-chart{ width:100%; max-width:1050px; text-align:center; }

    .org-box{
        width:100%;
        max-width:420px;
        margin:0 auto 12px auto;
        display:flex;
        align-items:center;
        gap:14px;
        padding:14px 16px;
        border:2px solid var(--blue);
        border-radius:var(--radius);
        background:#fff;
        box-shadow:var(--shadow);
        text-align:left;
    }

    .org-photo{
        width:58px;
        height:58px;
        border-radius:12px;
        object-fit:cover;
        border:2px solid var(--blue);
        flex-shrink:0;
        background:#fff;
    }

    .org-text{ display:flex; flex-direction:column; gap:2px; line-height:1.25; min-width:0; }
    .org-title{ font-size:13px; font-weight:800; text-transform:uppercase; letter-spacing:.3px; color:#111; margin:0; }
    .org-sub{ font-size:13px; font-weight:500; color:#555; margin:0; word-wrap:break-word; }

    .org-line{ width:2px; height:24px; background:var(--blue); margin:0 auto; }
    .org-arrow{ font-size:18px; color:var(--blue); margin:6px 0; line-height:1; }

    .org-split{
        display:flex;
        justify-content:center;
        align-items:center;
        gap:70px;
        margin:0 auto;
        max-width:760px;
    }

    .org-split .hline{ height:2px; background:var(--blue); flex:1; }

    .org-branch{
        display:grid;
        grid-template-columns:1fr 1fr;
        gap:30px;
        align-items:start;
        margin-top:12px;
    }

    .org-branch-col{ display:flex; flex-direction:column; align-items:center; }

    .org-members{
        width:100%;
        max-width:420px;
        display:flex;
        flex-direction:column;
        gap:10px;
        margin-top:6px;
    }

    .org-box.member{ max-width:420px; padding:12px 14px; margin:0; }
    .org-box.member .org-photo{ width:46px; height:46px; border-radius:10px; }
    .org-box.member .org-title{ font-size:12px; }
    .org-box.member .org-sub{ font-size:12.5px; }

    @media (max-width: 992px){
        .org-split{ max-width:620px; gap:40px; }
        .org-box{ max-width:460px; }
    }

    @media (max-width: 768px){
        .org-branch{ grid-template-columns:1fr; }
        .org-split{ max-width:420px; gap:30px; }
        .org-box, .org-members{ max-width:100%; }
    }
</style>

<div class="container my-5 pb-5" style="max-width: 980px;">

    {{-- PROFIL --}}
    <div class="row g-4 align-items-start">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="{{ asset('direktur.jpeg') }}" class="img-fluid rounded" alt="Foto Profil">
            </div>
        </div>

        <div class="col-md-8">
            <h3 class="fw-bold mb-1">Profil BUM Desa</h3>
            <div class="text-primary fw-semibold mb-2">
                Dinas Pemberdayaan Masyarakat Sumenep
            </div>

            <div class="text-muted small">
                Jl. Trunojoyo, Dalem Anyar, Bangselok, Kec. Kota Sumenep, Kabupaten Sumenep, Jawa Timur 69416
            </div>
        </div>
    </div>

    <hr class="my-4">

    {{-- SEJARAH SINGKAT --}}
    <div class="mb-4">
        <h5 class="fw-bold mb-3 text-center">Sejarah Singkat</h5>
        <p class="text-muted mb-0" style="line-height: 1.8; text-align: justify;">
            Badan Usaha Milik Desa (BUMDes) resmi diatur sejak UU No. 32 Tahun 2004,
            berakar dari inisiatif peningkatan ekonomi desa melalui pengelolaan potensi
            lokal secara swadaya. Lembaga ini diperkuat oleh PP No. 71 Tahun 2005 dan
            Permendagri No. 39 Tahun 2010, sebelum akhirnya mendapatkan status badan
            hukum mandiri melalui PP No. 11 Tahun 2021.

            <br><br>

            <strong>Awal Mula (Pra-2004):</strong> Konsep pengelolaan ekonomi lokal oleh desa
            sudah lama ada, namun secara formal disuarakan melalui UU No. 32 Tahun 2004
            tentang Pemerintahan Daerah Pasal 213, yang membolehkan desa mendirikan badan usaha.

            <br><br>

            <strong>Penguatan (2005–2010):</strong> Pemerintah mengeluarkan PP Nomor 71
            Tahun 2005 tentang Desa, yang kemudian diperjelas melalui Permendagri Nomor 39
            Tahun 2010 tentang BUMDes sebagai usaha desa berbasis musyawarah desa.

            <br><br>

            <strong>Era UU Desa (2014–2020):</strong> UU Nomor 6 Tahun 2014 tentang Desa
            memberikan legitimasi kuat bagi BUMDes untuk mengelola aset, jasa pelayanan,
            dan usaha lainnya guna meningkatkan pendapatan asli desa.

            <br><br>

            <strong>Status Badan Hukum (2021):</strong> Melalui PP Nomor 11 Tahun 2021,
            BUMDes diakui secara resmi sebagai badan hukum yang memudahkan kerja sama bisnis.
        </p>
    </div>

    <hr class="my-4">

    <h5 class="fw-bold mb-3">Struktur Bidang Pemberdayaan Usaha Ekonomi dan Kerjasama Desa (PUEKD)</h5>

    <div class="org-wrap">
        <div class="org-chart">

            {{-- KEPALA BIDANG --}}
            <div class="org-box">
                <img src="{{ $img('struktur/Bapak Fadholi.png') }}"
                     class="org-photo"
                     alt="Foto Kepala Bidang"
                     onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                <div class="org-text">
                    <div class="org-title">Kepala Bidang</div>
                    <div class="org-sub">Fadholi, ST., MT.</div>
                </div>
            </div>

            <div class="org-line"></div>

            {{-- GARIS BERCABANG --}}
            <div class="org-split">
                <div class="hline"></div>
                <div class="hline"></div>
            </div>

            <div class="org-arrow">▼</div>

            {{-- CABANG 2 TIM --}}
            <div class="org-branch">

                {{-- TIM KERJA 1 --}}
                <div class="org-branch-col">

                    <div class="org-box">
                        <div class="org-text">
                            <div class="org-title">Tim Kerja 1</div>
                            <div class="org-sub">Fasilitasi Kerjasama Antar Desa Dalam Kabupaten/Kota</div>
                        </div>
                    </div>

                    <div class="org-line"></div>
                    <div class="org-arrow">▼</div>

                    <div class="org-box">
                        <img src="{{ $img('struktur/Bapak Uji.jpg') }}"
                             class="org-photo"
                             alt="Foto Ketua Tim 1"
                             onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                        <div class="org-text">
                            <div class="org-title">Ketua (Merangkap Anggota)</div>
                            <div class="org-sub">R. UJIANA FAKHROSSADID, ST</div>
                        </div>
                    </div>

                    <div class="org-line"></div>
                    <div class="org-arrow">▼</div>

                    <div class="org-members">

                        <div class="org-box member">
                            <img src="{{ $img('struktur/Bapak Upek.png') }}"
                                 class="org-photo"
                                 alt="Foto Anggota"
                                 onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                            <div class="org-text">
                                <div class="org-title">Anggota</div>
                                <div class="org-sub">TAUFIQURRAHMAN, SE</div>
                            </div>
                        </div>

                        <div class="org-box member">
                            <img src="{{ $img('struktur/Bapak Pram.jpeg') }}"
                                 class="org-photo"
                                 alt="Foto Anggota"
                                 onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                            <div class="org-text">
                                <div class="org-title">Anggota</div>
                                <div class="org-sub">R. ACHMAD MUZAMMIL F, S.Sos</div>
                            </div>
                        </div>

                        <div class="org-box member">
                            <img src="{{ $placeholder }}"
                                 class="org-photo"
                                 alt="Foto Anggota"
                                 onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                            <div class="org-text">
                                <div class="org-title">Anggota</div>
                                <div class="org-sub">EDO PERDANA PS, ST</div>
                            </div>
                        </div>

                    </div>
                </div>

                {{-- TIM KERJA 2 --}}
                <div class="org-branch-col">

                    <div class="org-box">
                        <div class="org-text">
                            <div class="org-title">Tim Kerja 2</div>
                            <div class="org-sub">Fasilitasi Pembangunan Kawasan Perdesaan</div>
                        </div>
                    </div>

                    <div class="org-line"></div>
                    <div class="org-arrow">▼</div>

                    <div class="org-box">
                        <img src="{{ $img('struktur/Bapak Uji.jpg') }}"
                             class="org-photo"
                             alt="Foto Ketua Tim 2"
                             onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                        <div class="org-text">
                            <div class="org-title">Ketua (Merangkap Anggota)</div>
                            <div class="org-sub">R. UJIANA FAKHROSSADID, ST</div>
                        </div>
                    </div>

                    <div class="org-line"></div>
                    <div class="org-arrow">▼</div>

                    <div class="org-members">

                        <div class="org-box member">
                            <img src="{{ $img('struktur/Bapak Upek.png') }}"
                                 class="org-photo"
                                 alt="Foto Anggota"
                                 onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                            <div class="org-text">
                                <div class="org-title">Anggota</div>
                                <div class="org-sub">TAUFIQURRAHMAN, SE</div>
                            </div>
                        </div>

                        <div class="org-box member">
                            <img src="{{ $img('struktur/Bapak Firman.jpg') }}"
                                 class="org-photo"
                                 alt="Foto Anggota"
                                 onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                            <div class="org-text">
                                <div class="org-title">Anggota</div>
                                <div class="org-sub">ACH. SABRINI FIRMANSYAH, SE</div>
                            </div>
                        </div>

                        <div class="org-box member">
                            <img src="{{ $img('struktur/Bapak Agus.jpg') }}"
                                 class="org-photo"
                                 alt="Foto Anggota"
                                 onerror="this.onerror=null;this.src='{{ $placeholder }}';">

                            <div class="org-text">
                                <div class="org-title">Anggota</div>
                                <div class="org-sub">AGUS HARYANTO, SE</div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    {{-- TOMBOL KEMBALI --}}
    <div class="mt-4">
        <a href="{{ route('home') }}" class="btn btn-outline-secondary">← Kembali</a>
    </div>

</div>
@endsection