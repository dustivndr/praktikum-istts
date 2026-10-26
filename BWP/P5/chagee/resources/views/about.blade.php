<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - CHAGEE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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

    <main class="w-100 overflow-x-hidden">

        <!-- hero -->
        <section class="position-relative w-100 text-white d-flex align-items-end overflow-hidden" style="min-height: 85vh; padding-bottom: 5rem;">
            <img src="{{ $data['hero_bg'] }}"
                alt="Hero Background"
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1">

            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-25 z-n1"></div>

            <div class="container px-4 px-lg-5 position-relative z-1">
                <h1 class="display-3 fw-bolder text-uppercase mb-0" style="letter-spacing: 2px;">
                    {{ $data['hero_title'] }}
                </h1>
            </div>
        </section>

        <section class="w-100 py-5 bg-white text-center">
            <div class="container py-5 px-4" style="max-width: 900px;">
                <h2 class="fw-bolder mb-4 text-uppercase" style="color: #0b1a30; font-size: 2.2rem; letter-spacing: 2px;">
                    {{ $data['intro_title'] }}
                </h2>
                <p class="text-secondary fs-6 mx-auto" style="line-height: 1.8; max-width: 800px;">
                    {{ $data['intro_desc'] }}
                </p>
            </div>
        </section>

        <!-- the Beginning -->
        <section class="position-relative w-100 text-white d-flex align-items-center overflow-hidden" style="min-height: 80vh;">
            <img src="{{ $data['beginning_bg'] }}"
                alt="The Beginning Background"
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1">

            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50 z-n1"></div>

            <div class="container px-4 px-lg-5 position-relative z-1">
                <div style="max-width: 550px;">
                    <h2 class="display-4 fw-bolder text-uppercase mb-4" style="letter-spacing: 2px;">
                        {{ $data['beginning_title'] }}
                    </h2>
                    <p class="lead opacity-90 fs-5" style="line-height: 1.8;">
                        {{ $data['beginning_desc'] }}
                    </p>
                </div>
            </div>
        </section>

        <!-- bradn mission -->
        <section class="w-100 p-0 bg-white">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6">
                    <img src="{{ $data['mission_img'] }}"
                        alt="Brand Mission"
                        class="w-100 h-100 object-fit-cover"
                        style="min-height: 60vh;">
                </div>

                <div class="col-lg-6 d-flex align-items-center bg-white text-center">
                    <div class="p-5 w-100" style="max-width: 600px; margin: 0 auto;">
                        <h2 class="fw-bolder mb-4 text-uppercase" style="color: #0b1a30; font-size: 2.2rem; letter-spacing: 2px;">
                            {{ $data['mission_title'] }}
                        </h2>

                        <h1 class="fw-bold mb-3" style="color: #0b1a30; font-size: 2.8rem; letter-spacing: 3px;">
                            {{ $data['mission_cn'] }}
                        </h1>

                        <p class="text-secondary fw-semibold text-uppercase" style="letter-spacing: 2px;">
                            {{ $data['mission_en'] }}
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- goal -->
        <section class="position-relative w-100 text-white bg-black d-flex align-items-center overflow-hidden" style="min-height: 80vh;">
            <div class="container-fluid p-0">
                <div class="row g-0 align-items-center">
                    <div class="col-lg-6 px-4 px-lg-5 py-5">
                        <div style="max-width: 500px; margin: 0 auto;">
                            <h2 class="display-4 fw-bolder text-uppercase mb-5" style="letter-spacing: 2px;">
                                {{ $data['goal_title'] }}
                            </h2>

                            <ul class="list-unstyled">
                                @foreach ($data['goals'] as $goal)
                                <li class="lead fs-6 mb-4 opacity-90" style="line-height: 1.6;">
                                    {{ $goal }}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-6 position-relative d-none d-lg-block" style="min-height: 80vh;">
                        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1600&q=80"
                            alt="Our Goal World View"
                            class="position-absolute top-0 end-0 h-100 w-100 object-fit-cover"
                            style="border-top-left-radius: 500px; border-bottom-left-radius: 500px;">
                    </div>
                </div>
            </div>
        </section>

    </main>

    <footer class="w-100 bg-white border-top py-3 text-secondary" style="font-size: 0.9rem;">
        <div class="container-fluid px-4 px-lg-5">
            <div class="row align-items-center gy-3">

                <div class="col-md-4 d-flex align-items-center justify-content-start">
                    <a href="#" class="text-secondary text-decoration-none d-flex align-items-center gap-2">
                        &#128205; <span>Global Sites</span>
                    </a>
                </div>

                <div class="col-md-4 text-center">
                    <span class="d-inline-flex align-items-center gap-1">
                        <span style="font-size: 1.1rem;">©</span> 225117159 Dustin Ivander
                    </span>
                </div>

                <div class="col-md-4 d-flex align-items-center justify-content-end gap-2">
                    <a href="{{ url('/contact') }}" class="text-secondary text-decoration-none text-uppercase fw-medium">
                        Contact
                    </a>
                    <span class="text-muted">|</span>
                    <a href="" class="text-secondary text-decoration-none text-uppercase fw-medium">
                        Privacy & Legal
                    </a>
                </div>

            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>