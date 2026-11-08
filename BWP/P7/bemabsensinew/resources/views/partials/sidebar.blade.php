<aside class="sidebar col-md-3 col-lg-2 p-3 position-fixed top-0 start-0">
    <div class="sidebar-brand pb-3 mb-3">
        <div class="text-white fw-bold fs-5">BEM ABSENSI</div>
        <div class="text-white-50 small">UKM &amp; UKK Attendance System</div>
    </div>
    @if (session('auth_user_id'))
        @php($mode = session('active_mode'))
        @if ($mode === 'mahasiswa' || $mode === 'ketua')
            <div class="bg-dark border border-secondary rounded p-2 mb-3">
                <div class="text-white-50 small mb-2">Pilih Tampilan</div>
                @if ($mode === 'ketua' || session('active_mode') === 'mahasiswa' && session('can_switch'))
                    <form method="POST" action="{{ route('switch-mode', 'ketua') }}" class="mb-1">@csrf<button class="btn btn-sm w-100 {{ $mode === 'ketua' ? 'btn-yellow' : 'btn-outline-light' }}">Dashboard Ketua</button></form>
                @endif
                @if (session('can_switch'))
                    <form method="POST" action="{{ route('switch-mode', 'mahasiswa') }}">@csrf<button class="btn btn-sm w-100 {{ $mode === 'mahasiswa' ? 'btn-yellow' : 'btn-outline-light' }}">Dashboard Mahasiswa</button></form>
                @endif
            </div>
        @endif
        <nav class="nav flex-column gap-1">
            @if ($mode === 'admin')
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid me-2"></i>Dashboard</a>
                <a class="nav-link {{ request()->routeIs('admin.organizations*') ? 'active' : '' }}" href="{{ route('admin.organizations') }}"><i class="bi bi-building me-2"></i>Kelola UKM &amp; UKK</a>
                <a class="nav-link" href="{{ route('admin.organizations', 'UKM') }}"><i class="bi bi-people me-2"></i>Daftar UKM</a>
                <a class="nav-link" href="{{ route('admin.organizations', 'UKK') }}"><i class="bi bi-heart me-2"></i>Daftar UKK</a>
                <a class="nav-link {{ request()->routeIs('admin.schedules*') ? 'active' : '' }}" href="{{ route('admin.schedules') }}"><i class="bi bi-calendar3 me-2"></i>Jadwal Kegiatan</a>
            @elseif ($mode === 'ketua')
                <a class="nav-link active" href="{{ route('chairman.dashboard') }}"><i class="bi bi-bell me-2"></i>Notifikasi Permintaan</a>
            @else
                <a class="nav-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}" href="{{ route('student.dashboard') }}"><i class="bi bi-grid me-2"></i>Dashboard</a>
                <a class="nav-link {{ request()->routeIs('student.organizations') ? 'active' : '' }}" href="{{ route('student.organizations') }}"><i class="bi bi-people me-2"></i>Organisasi Saya</a>
                <a class="nav-link {{ request()->routeIs('student.explore') ? 'active' : '' }}" href="{{ route('student.explore') }}"><i class="bi bi-search me-2"></i>Jelajahi UKM &amp; UKK</a>
                <a class="nav-link {{ request()->routeIs('student.schedules') ? 'active' : '' }}" href="{{ route('student.schedules') }}"><i class="bi bi-calendar3 me-2"></i>Jadwal Kegiatan</a>
                <a class="nav-link {{ request()->routeIs('student.attendance') ? 'active' : '' }}" href="{{ route('student.attendance') }}"><i class="bi bi-clock-history me-2"></i>Riwayat Absensi</a>
            @endif
        </nav>
        <form method="POST" action="{{ route('logout') }}" class="mt-4">@csrf<button class="btn btn-link text-danger text-decoration-none px-3"><i class="bi bi-box-arrow-right me-2"></i>Logout</button></form>
    @endif
</aside>
