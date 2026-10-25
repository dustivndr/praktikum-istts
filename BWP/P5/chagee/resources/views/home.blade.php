<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - CHAGEE</title>
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

        .scrollable-tea-container {
            scrollbar-width: thin;
            scrollbar-color: #cbd5e1 #f1f5f9;
        }

        .scrollable-tea-container::-webkit-scrollbar {
            height: 8px;
        }

        .scrollable-tea-container::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 10px;
        }

        .scrollable-tea-container::-webkit-scrollbar-thumb {
            background-color: #cbd5e1;
            border-radius: 10px;
        }
    </style>
</head>

<body class="overflow-x-hidden">

    <header class="position-relative vh-100 w-100 overflow-hidden text-center text-white d-flex align-items-center justify-content-center">

        <video autoplay loop muted playsinline class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1">
            <source src="https://prod-chagee-official-vietnam.chagee.com/web/uploads/20240902/b543a77a-4b2f-4786-a948-74b951ce7113.mp4" type="video/mp4">
        </video>

        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50 z-n1"></div>

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

        <section class="w-100 p-0 bg-white">
            <div class="row g-0">
                <!-- Left Image -->
                <div class="col-lg-6">
                    <img src="https://global.chagee.com/_next/image?url=https%3A%2F%2Fprod-chagee-official-vietnam.chagee.com%2Fweb%2Fid%2Fuploads%2F20260713%2Fa28435f3-2e4b-4c54-beea-dc0c5ce67ef9.jpeg&w=3840&q=100"
                        alt="About Chagee"
                        class="w-100 h-100 object-fit-cover"
                        style="min-height: 60vh;">
                </div>

                <div class="col-lg-6 d-flex align-items-center bg-white">
                    <div class="p-5 w-100" style="max-width: 650px; margin: 0 auto;">
                        <h1 class="fw-bolder mb-4 text-uppercase" style="color: #0b1a30; font-size: 2.5rem; letter-spacing: 2px;">
                            About Us
                        </h1>
                        <p class="text-secondary mb-5 fs-5" style="line-height: 1.8;">
                            CHAGEE is from Yunnan, the birthplace of tea. Guided by our mission to bring people together and forge relationships via a good cup of tea, we are committed to providing healthy and low-calorie tea beverages suitable for everyday.[cite: 2]
                        </p>
                        <a href="{{ url('/about') }}" class="btn btn-light bg-white rounded-pill px-4 py-2 fw-medium text-secondary shadow-sm" style="border: 1px solid #dee2e6;">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="w-100 py-5 bg-white">
            <div class="row align-items-center g-0">

                <!-- Left Column -->
                <div class="col-lg-4 px-4 px-lg-5 mb-4 mb-lg-0">
                    <div style="max-width: 400px; margin: 0 auto;">
                        <h1 class="fw-bolder mb-4 text-uppercase" style="color: #0b1a30; font-size: 2.5rem; letter-spacing: 2px;">
                            About Our Tea
                        </h1>
                        <p class="text-secondary mb-5 fs-5" style="line-height: 1.8;">
                            Made from quality tea leaves and handpicked ingredients,
                            each cup of CHAGEE tea is made fresh to order.
                        </p>
                        <a href="{{ url('/menu') }}" class="btn btn-light bg-white rounded-pill px-4 py-2 fw-medium text-secondary shadow-sm" style="border: 1px solid #dee2e6;">
                            Learn More
                        </a>
                    </div>
                </div>

                <div class="col-lg-8 ps-lg-3 pe-5">
                    <div class="d-flex flex-nowrap overflow-x-auto pb-4 gap-4 scrollable-tea-container" style="padding-right: 2rem;">
                        @forelse ($teaCards ?? [] as $card)
                        <div class="flex-shrink-0" style="width: 280px;">
                            <div class="card border-0 rounded-4 overflow-hidden shadow-sm h-100">
                                <img src="{{ $card['image'] }}"
                                    class="card-img-top object-fit-cover"
                                    alt="{{ $card['title'] }}"
                                    style="height: 380px;">
                            </div>
                        </div>
                        @empty
                        <p class="text-muted">No tea items available.</p>
                        @endforelse
                    </div>
                </div>

            </div>
        </section>

        <section class="position-relative w-100 text-center text-white d-flex align-items-center justify-content-center overflow-hidden" style="min-height: 90vh;">

            <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=1600&q=80"
                alt="Global Growth Background"
                class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover z-n1">

            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50 z-n1"></div>

            <div class="container py-5 px-4 position-relative z-1" style="max-width: 900px;">

                <h1 class="fw-bolder mb-3 text-uppercase display-4" style="letter-spacing: 3px;">
                    GLOBAL GROWTH
                </h1>

                <h5 class="fw-medium mb-3 text-light" style="letter-spacing: 1px;">
                    From Yunnan to the World:
                </h5>

                <p class="lead mb-5 text-light opacity-90 mx-auto" style="max-width: 780px; line-height: 1.8; font-size: 1.1rem;">
                    CHAGEE has expanded across Asia Pacific - in Malaysia, Singapore, Thailand, Indonesia, Vietnam and Philippines to become an international tea beverage company with over 6,000+ stores worldwide.[cite: 4]
                </p>

                <a href="" class="btn btn-outline-light rounded-pill px-4 py-2 fw-medium shadow-sm">
                    Learn More
                </a>

            </div>
        </section>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>