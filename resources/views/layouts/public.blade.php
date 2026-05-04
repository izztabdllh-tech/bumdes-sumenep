<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>
        @hasSection('title')
            @yield('title') — {{ config('app.name', 'Sistem Pendataan dan Digitalisasi Produk BUMDes') }}
        @else
            {{ config('app.name', 'Sistem Pendataan dan Digitalisasi Produk BUMDes') }}
        @endif
    </title>

    <meta name="description" content="Sistem Pendataan dan Digitalisasi Produk BUMDes — DPMD Kabupaten Sumenep.">
    <meta name="theme-color" content="#3b82f6">

    <link rel="icon" href="{{ asset('logo.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root{
            --primary:#3b82f6;
            --primary-dark:#2563eb;
            --text:#203864;
            --muted:#6b7280;
            --border:#dbeafe;
            --bg:#f3f8ff;
            --white:#ffffff;
            --warning:#f6c443;
            --shadow:0 10px 30px rgba(59,130,246,.10);
            --radius:22px;
        }

        *{
            box-sizing:border-box;
        }

        html, body{
            margin:0;
            padding:0;
            min-height:100%;
            scroll-behavior:smooth;
        }

        body{
            font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif;
            color:var(--text);
            background:
                radial-gradient(circle at left top, rgba(147,197,253,.28), transparent 30%),
                linear-gradient(180deg, #f8fbff 0%, #eef5ff 100%);
            overflow-x:hidden;
        }

        .container-narrow{
            max-width:1140px;
        }

        .site-header{
            position:sticky;
            top:0;
            z-index:1000;
            background:rgba(255,255,255,.90);
            backdrop-filter: blur(12px);
            border-bottom:1px solid rgba(219,234,254,.95);
            box-shadow:0 6px 18px rgba(15,23,42,.04);
        }

        .site-nav{
            min-height:86px;
        }

        .brand{
            display:flex;
            align-items:center;
            gap:12px;
            text-decoration:none;
            color:inherit;
        }

        .brand img{
            width:48px;
            height:48px;
            object-fit:contain;
        }

        .brand-title{
            margin:0;
            font-size:16px;
            font-weight:800;
            line-height:1.15;
            color:#203864;
        }

        .brand-sub{
            margin:2px 0 0;
            font-size:12px;
            color:var(--muted);
        }

        .main-menu{
            display:flex;
            align-items:center;
            justify-content:center;
            gap:30px;
        }

        .main-menu a{
            position:relative;
            text-decoration:none;
            color:#475569;
            font-weight:600;
            padding:8px 0;
            transition:.2s ease;
        }

        .main-menu a:hover,
        .main-menu a.active{
            color:var(--primary-dark);
        }

        .main-menu a.active::after,
        .main-menu a:hover::after{
            content:"";
            position:absolute;
            left:0;
            right:0;
            bottom:-8px;
            height:3px;
            border-radius:999px;
            background:var(--primary);
        }

        .btn-admin{
            display:inline-flex;
            align-items:center;
            justify-content:center;
            background:linear-gradient(135deg, #f8cf52, #f0b90b);
            color:#1f2937;
            text-decoration:none;
            font-weight:800;
            border:none;
            border-radius:14px;
            padding:12px 22px;
            box-shadow:0 10px 18px rgba(240,185,11,.20);
            transition:.2s ease;
        }

        .btn-admin:hover{
            transform:translateY(-1px);
            color:#111827;
        }

        main{
            min-height:calc(100vh - 86px);
        }

        @media (max-width: 991.98px){
            .site-nav{
                min-height:auto;
                padding:14px 0;
            }

            .main-menu{
                display:none;
            }

            .brand-title{
                font-size:14px;
            }

            .btn-admin{
                padding:10px 16px;
                font-size:14px;
            }
        }
    </style>

    @stack('styles')
</head>
<body>

<header class="site-header">
    <div class="container container-narrow">
        <div class="site-nav d-flex align-items-center justify-content-between gap-3">
            <a href="{{ route('home') }}" class="brand">
                <img src="{{ asset('logo.png') }}" alt="Logo DPMD">
                <div>
                    <p class="brand-title">Dinas Pemberdayaan Masyarakat dan Desa</p>
                    <p class="brand-sub">Kabupaten Sumenep</p>
                </div>
            </a>

            <a href="{{ route('admin.login') }}" class="btn-admin">
                Masuk Admin
            </a>
        </div>
    </div>
</header>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>