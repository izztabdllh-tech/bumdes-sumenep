<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin')</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- CSS kamu -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">

  <!-- ✅ TARUH DI SINI -->
  @stack('styles')
</head>
<body>

  <main>
    @yield('content')
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ✅ INI YANG KURANG -->
  @stack('scripts')

</body>
</html>