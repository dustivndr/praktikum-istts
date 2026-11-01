<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- manggil yang section ('title', ....) di movies/index.blade.php -->
    <title>@yield('title', 'M-TIX Bioskop')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4" href="{{ route('movies.index') }}">M-TIX</a>
                <span class="navbar-text text-white">
                    Wilayah: <strong>Surakarta</strong>
                </span>
            </div>
        </nav>
    </header>

    <main class="container my-4">
        <!-- manggilnya tinggal gini tok untuk sectionnya -->
        @yield('content')
    </main>

    <footer class="bg-dark text-white text-center py-3 mt-auto">
        <div class="container">
            <small>&copy; {{ date('Y') }} M-TIX Cinema - Tutorial Blade Templating</small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
