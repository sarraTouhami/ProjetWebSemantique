<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RescueFood') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="{{ asset('img/favicon.ico') }}" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500&family=Lora:wght@600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
</head>
<body>
    <div id="app">
        <!-- Navbar Start -->
        <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
            <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
            </div>

            <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5">
                <a href="{{ url('/home') }}" class="navbar-brand ms-4 ms-lg-0">
                    <h1 class="fw-bold text-primary m-0">Res<span class="text-secondary">cueF</span>ood</h1>
                </a>
                <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        @auth
                        <!-- Reservations Menu -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="reservationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Réservations
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="reservationsDropdown">
                                <li><a class="dropdown-item" href="{{ url('/reservation/search') }}">Toutes les Réservations</a></li>
                                <li><a class="dropdown-item" href="{{ url('/demande/search') }}">Demandes</a></li>
                                <li><a href="{{ url('/donations/search') }}" class="dropdown-item">Dons</a></li>
                            </ul>
                        </div>

                        <!-- Donations Menu -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="donationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Inventaires
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="donationsDropdown">
                                <li><a class="dropdown-item" href="{{ url('/inventairebe/list') }}">Inventaire Bénéficiaire</a></li>
                                <li><a class="dropdown-item" href="{{ url('/inventaireDonateur/search') }}">Inventaire Donateur</a></li>
                            </ul>
                        </div>

                        <!-- Users Menu -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="usersDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Utilisateurs
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="usersDropdown">
                                <li><a class="dropdown-item" href="{{ url('/utilisateurs/search') }}">Gestion des Utilisateurs</a></li>
                                <li><a class="dropdown-item" href="{{ url('/posts') }}">Publications</a></li>
                                <li><a class="dropdown-item" href="{{ url('/Recommendation/search') }}">Recommendations</a></li>
                                <li><a class="dropdown-item" href="{{ url('/evenemets/search') }}">Events</a></li>
                            </ul>
                        </div>

                        <!-- Miscellaneous Menu -->
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="miscDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Autres
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="miscDropdown">

                                <li><a class="dropdown-item" href="{{ url('/produit/calender') }}">Produits</a></li>
                                <li><a class="dropdown-item" href="{{ url('/certification/search') }}">Certifications</a></li>
                                <li><a class="dropdown-item" href="{{ url('/feedback/search') }}" >Feedback</a></li>
                            </ul>
                        </div>
                        @else
                        <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
                        <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
                        @endauth
                    </div>
                </div>
            </nav>

        </div>
        <!-- Navbar End -->

        <main class="py-4">
            @yield('content')
        </main>

        <!-- Footer Start -->
        <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h1 class="fw-bold text-primary mb-4">F<span class="text-secondary">oo</span>dy</h1>
                        <p>Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-square btn-outline-light rounded-circle me-0" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-4">Address</h4>
                        <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p><i class="fa fa-envelope me-3"></i>info@example.com</p>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-4">Quick Links</h4>
                        <a class="btn btn-link" href="">About Us</a>
                        <a class="btn btn-link" href="">Contact Us</a>
                        <a class="btn btn-link" href="">Our Services</a>
                        <a class="btn btn-link" href="">Terms & Condition</a>
                        <a class="btn btn-link" href="">Support</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h4 class="text-light mb-4">Newsletter</h4>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved.
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                            <br>Distributed By: <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->

    </div>
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('lib/wow/wow.min.js') }}"></script>
<script src="{{ asset('lib/easing/easing.min.js') }}"></script>
<script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
<script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>


<!-- Template Javascript -->
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
