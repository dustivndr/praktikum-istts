<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'BEM ABSENSI')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root { --yellow:#f4c430; --ink:#171717; --surface:#f4f5f7; }
        body { background:var(--surface); color:var(--ink); }
        .sidebar { background:#151515; min-height:100vh; }
        .sidebar-brand { border-bottom:1px solid #554716; }
        .sidebar .nav-link { color:#c7c7c7; border-radius:.6rem; }
        .sidebar .nav-link:hover,.sidebar .nav-link.active { background:var(--yellow); color:#111; }
        .topbar { background:var(--yellow); min-height:64px; }
        .content { min-height:calc(100vh - 64px); }
        .card,.section-card { border:0; border-radius:1rem; }
        .icon-box { width:52px;height:52px;display:grid;place-items:center;border-radius:14px;background:#fff2bf;color:#8e6e10;font-size:1.4rem; }
        .stat-icon { width:46px;height:46px;display:grid;place-items:center;border-radius:50%; }
        .btn-yellow { background:var(--yellow); border-color:var(--yellow); color:#111; }
        .btn-yellow:hover { background:#dcae1a; border-color:#dcae1a; color:#111; }
        .table > :not(caption) > * > * { padding:.8rem 1rem; }
        .table tbody tr { border-bottom:1px solid #ededed; }
        @media (max-width:767.98px) { .sidebar { min-height:auto; } .sidebar.position-fixed { position:static!important; } }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        @include('partials.sidebar')
        <main class="col-md-9 col-lg-10 px-0 ms-auto">
            <header class="topbar px-4 py-3 d-flex justify-content-between align-items-center">
                <h1 class="h5 mb-0">@yield('pageTitle', 'BEM ABSENSI')</h1>
                @if (session('auth_user_id'))
                    <span class="small fw-semibold">{{ session('auth_user_name', 'Pengguna') }}</span>
                @endif
            </header>
            <div class="content p-3 p-lg-4">
                @include('partials.flash')
                @yield('content')
            </div>
        </main>
    </div>
</div>
</body>
</html>
