<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Media Centre - CHAGEE</title>
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

        <nav id="hoverNavbar" class="navbar navbar-expand-lg fixed-top bg-transparent navbar-dark py-3 chagee-navbar">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                    <img src="https://upload.wikimedia.org/wikipedia/en/7/70/Chagee_logo.svg"
                        alt="CHAGEE Logo"
                        referrerpolicy="no-referrer"
                        style="height: 50px;">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav gap-4 fw-bold">
                        <li class="nav-item"><a class="nav-link text-uppercase" href="{{ url('/about') }}">About Us</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase" href="{{ url('/menu') }}">Menu</a></li>
                        <li class="nav-item"><a class="nav-link text-uppercase active" href="{{ url('/media') }}">Media Centre</a></li>
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

        <section class="position-relative w-100 text-white d-flex align-items-end overflow-hidden" style="min-height: 85vh; padding-bottom: 4rem; background-color: #000;">

            <img src="{{ $jumbotronBg }}"
                alt="Media Centre Jumbotron"
                referrerpolicy="no-referrer"
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover"
                style="z-index: 0; pointer-events: none;">

            <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.3); z-index: 1;"></div>

            <div class="container px-4 px-lg-5 position-relative" style="z-index: 2;">
                <h1 class="display-3 fw-bolder text-uppercase mb-0" style="letter-spacing: 2px;">
                    MEDIA CENTRE
                </h1>
            </div>
        </section>
        
        <!-- article -->
        <section class="container py-5 my-4">
            <div class="d-flex flex-column" style="max-width: 1050px; margin: 0 auto;">

                @foreach ($articles as $index => $article)
                <div class="py-4">
                    <div class="row align-items-center g-4 g-lg-5">

                        <div class="col-md-7">
                            <h3 class="fw-bold mb-3" style="color: #0b1a30; line-height: 1.4; font-size: 1.5rem;">
                                {{ $article['title'] }}
                            </h3>

                            <p class="text-secondary mb-0 fs-6" style="line-height: 1.7; font-weight: 400;">
                                {{ $article['desc'] }}
                            </p>
                        </div>

                        <div class="col-md-5">
                            <div class="rounded-4 overflow-hidden shadow-sm" style="height: 240px;">
                                <img src="{{ $article['image'] }}"
                                    alt="{{ $article['title'] }}"
                                    referrerpolicy="no-referrer"
                                    class="w-100 h-100 object-fit-cover">
                            </div>
                        </div>

                    </div>
                </div>

                @if (!$loop->last)
                <hr class="my-4 text-secondary opacity-25">
                @endif
                @endforeach

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