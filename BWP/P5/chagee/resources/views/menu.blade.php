<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - CHAGEE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html {
            scroll-behavior: smooth;
        }

        nav.navbar.chagee-navbar {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7) 0%, rgba(0, 0, 0, 0) 100%) !important;
            transition: background 0.3s ease, box-shadow 0.3s ease;
        }

        nav.navbar.chagee-navbar:hover {
            background: #ffffff !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        nav.navbar.chagee-navbar:hover .navbar-brand,
        nav.navbar.chagee-navbar:hover .nav-link {
            color: #000000 !important;
        }

        nav.navbar.chagee-navbar:hover .nav-link:hover {
            color: #666666 !important;
        }

        .sticky-menu-nav {
            position: sticky;
            top: 100px;
            /* Offset for fixed navbar */
            z-index: 10;
        }

        .menu-sidebar-link {
            color: #6c757d;
            font-weight: 400;
            text-decoration: none;
            transition: color 0.2s ease, font-weight 0.2s ease;
            display: block;
            font-size: 0.95rem;
        }

        .menu-sidebar-link:hover,
        .menu-sidebar-link:focus {
            color: #0b1a30;
            font-weight: 700;
        }

        .menu-card-section {
            scroll-margin-top: 110px;
        }
    </style>
</head>

<body class="overflow-x-hidden">

    <header class="position-relative w-100 overflow-hidden text-center text-white d-flex align-items-center justify-content-center">

        <!-- Navbar -->
        <nav id="hoverNavbar" class="navbar navbar-expand-lg fixed-top bg-transparent navbar-dark py-3 chagee-navbar">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <img src="https://upload.wikimedia.org/wikipedia/en/7/70/Chagee_logo.svg" alt="" style="height: 50px;">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav gap-4 fw-bold">
                        <li class="nav-item"><a class="nav-link text-uppercase" href="{{ url('/about') }}">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase" href="{{ url('/menu') }}">Menu</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase" href="{{ url('/media') }}">Media Centre</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase" href="{{ url('/contact') }}">Contact</a></li>
                    </ul>
                </div>

                <div class="d-none d-lg-flex align-items-center">
                    <a href="#" class="nav-link d-flex align-items-center gap-1">
                        🌐 English
                    </a>
                </div>
            </div>
        </nav>

    </header>

    <main class="w-100">

        <section class="position-relative w-100 text-white d-flex align-items-end overflow-hidden" style="min-height: 85vh; background-color: #000; padding-bottom: 5rem;">

            <img src="https://images.unsplash.com/photo-1576092768241-dec231879fc3?auto=format&fit=crop&w=1920&q=80"
                alt="Our Menu Background"
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                style="z-index: 0; pointer-events: none;">

            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.4); z-index: 1;"></div>

            <div class="container px-4 px-lg-5 position-relative" style="z-index: 2;">
                <h1 class="display-3 fw-bolder text-uppercase mb-0" style="letter-spacing: 2px;">
                    OUR MENU
                </h1>
            </div>
        </section>

        <section class="container py-5">
            <div class="row g-4">

                <!-- left menu -->
                <div class="col-lg-3">
                    <div class="sticky-menu-nav pe-lg-4">
                        <h4 class="fw-bolder text-uppercase mb-4" style="color: #0b1a30; letter-spacing: 1px;">
                            TEA SERIES
                        </h4>

                        <nav class="nav flex-column gap-3">
                            @foreach ($menuSeries as $index => $item)
                            <a class="menu-sidebar-link"
                                href="#{{ $item['id'] }}">
                                {{ $item['title'] }}
                            </a>
                            @endforeach
                        </nav>
                    </div>
                </div>

                <!-- cards -->
                <div class="col-lg-9">
                    <div class="d-flex flex-column gap-5">

                        @foreach ($menuSeries as $item)
                        <div id="{{ $item['id'] }}" class="menu-card-section card border-0 rounded-4 overflow-hidden text-white position-relative shadow-sm" style="min-height: 480px; background-color: #000;">

                            <img src="{{ $item['image'] }}"
                                alt="{{ $item['title'] }}"
                                referrerpolicy="no-referrer"
                                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                                style="z-index: 0;">

                            <div class="position-absolute top-0 start-0 w-100 h-100"
                                style="background: linear-gradient(to bottom, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.75) 100%); z-index: 1;"></div>

                            <div class="position-relative d-flex flex-column h-100 w-100 p-4 p-md-5" style="z-index: 2; min-height: 480px;">

                                <div>
                                    <h2 class="display-5 fw-bold mb-0">
                                        {{ $item['title'] }}
                                    </h2>
                                </div>

                                <div class="mt-auto text-center">
                                    <a href="#" class="btn btn-outline-light rounded-pill px-4 py-2 mb-4 fw-medium shadow-sm">
                                        Explore
                                    </a>

                                    <p class="mb-0 mx-auto text-light opacity-90 fs-6" style="max-width: 650px; line-height: 1.6;">
                                        {{ $item['desc'] }}
                                    </p>
                                </div>

                            </div>

                        </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>