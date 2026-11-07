<aside class="sidebar col-md-3 col-lg-2 p-3 position-fixed top-0 start-0">
    <div class="sidebar-brand pb-3 mb-3">
        <div class="text-white fw-bold fs-5">BEM ABSENSI</div>
        <div class="text-white-50 small">UKM &amp; UKK Directory</div>
    </div>
    <nav class="nav flex-column gap-2">
        <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
            <i class="bi bi-grid me-2"></i> Home
        </a>
        <a href="{{ route('organizations.ukm') }}" class="nav-link {{ request()->routeIs('organizations.ukm') ? 'active' : '' }}">
            <i class="bi bi-people me-2"></i> Daftar UKM
        </a>
        <a href="{{ route('organizations.ukk') }}" class="nav-link {{ request()->routeIs('organizations.ukk') ? 'active' : '' }}">
            <i class="bi bi-heart me-2"></i> Daftar UKK
        </a>
    </nav>
</aside>
