<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BEM ABSENSI')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --mustard: #e8bd3f; --ink: #171717; --surface: #f5f6f8; }
        body { background: var(--surface); color: var(--ink); }
        .sidebar { background: #171717; min-height: 100vh; }
        .sidebar-brand { border-bottom: 1px solid var(--mustard); }
        .sidebar .nav-link { color: #bfc0c2; border-radius: .5rem; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: var(--mustard); color: #111; }
        .topbar { background: var(--mustard); }
        .content { min-height: calc(100vh - 64px); }
        .icon-box { width: 52px; height: 52px; display: grid; place-items: center; border-radius: 14px; background: #fff3c4; color: #9c7411; font-size: 1.5rem; }
        .stat-icon { width: 46px; height: 46px; display: grid; place-items: center; border-radius: 50%; }
        .bg-purple-subtle { background: #eee5ff; }
        .text-purple { color: #7048b8; }
        .organization-card, .section-card, .welcome-card { border: 0; border-radius: 1rem; }
        .table > :not(caption) > * > * { padding: .85rem 1rem; }
        .table tbody tr:nth-child(even) { background: #fafafa; }
        @media (max-width: 767.98px) { .sidebar { min-height: auto; } }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <main class="col-md-9 col-lg-10 px-0 ms-auto">
            <header class="topbar px-4 py-3 d-flex align-items-center">
                <h1 class="h5 mb-0">@yield('pageTitle', 'Dashboard Overview')</h1>
            </header>
            <div class="content p-3 p-lg-4">
                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
