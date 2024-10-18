<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'atterrissage - RescueFood</title>
    <!-- Add necessary styles (Bootstrap, custom styles) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        /* Custom CSS */
        /* Apply background image to the whole body */
        body {
            background: url('{{ asset('img/carousel-1.jpg') }}') no-repeat center center/cover;
            height: 100%;
            position: relative;
        }

        /* Blur effect using ::before pseudo-element */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: inherit;
            filter: blur(4px);
            z-index: -1;
            /* Make sure it's behind other content */
        }

        /* Hero Section */
        .hero-section {
            height: 100vh;
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }

        .hero-section h1 {
            font-size: 4rem;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.25rem;
            margin-bottom: 30px;
        }

        .btn-custom {
            background-color: #28a745;
            color: white;
            border-radius: 50px;
            padding: 10px 25px;
            font-size: 1.1rem;
        }

        /* Section Titles */
        .section-title {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        /* Feature Cards */
        .feature-card {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        /* About Section */
        .about-section {
            padding: 60px 0;
        }

        /* Contact Section */
        .contact-section {
            background-color: rgba(40, 167, 69, 0.5);

            color: white;
            padding: 40px 0;
            border-radius: 15px;
            /* Rounded corners */
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Light shadow */
        }

        /* Footer */
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }

        .text-green {
            color: #28a745;
            /* Green */
        }

        .text-orange {
            color: #fd7e14;
            /* Orange */
        }
    </style>
</head>

<body>

    <!-- Navbar Start -->
    <div class="container-fluid fixed-top px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="top-bar row gx-0 align-items-center d-none d-lg-flex">
        </div>

        <nav class="navbar navbar-expand-lg navbar-light py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
            <a href="{{ url('/home') }}" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="fw-bold text-green m-0">Res<span class="text-orange">cueF</span>ood</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="{{ url('/home') }}" class="nav-item nav-link active">Accueil</a>
                    <a href="#about" class="nav-item nav-link">À propos</a>
                    <a href="#contact" class="nav-item nav-link">Contact</a>
                    @auth
                        <a href="{{ url('/reservations') }}" class="nav-item nav-link">Réservations</a>
                        <a href="{{ url('/demandes') }}" class="nav-item nav-link">Demandes</a>
                        <a href="{{ url('/Dons') }}" class="nav-item nav-link">Dons</a>
                    @else
                        <a href="{{ route('login') }}" class="nav-item nav-link">Se connecter</a>
                        <a href="{{ route('register') }}" class="nav-item nav-link">S'inscrire</a>
                    @endauth
                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar End -->

    <!-- Hero Section -->
    <div class="hero-section">
        <div>
            <h1 class="animate__animated animate__fadeIn">Bienvenue sur <span class="fw-bold text-green m-0">Res<span class="text-orange">cueF</span>ood</span></h1>
            <p class="animate__animated animate__fadeIn animate__delay-1s">Relier les restaurants, les organisations et
                les bénévoles pour réduire le gaspillage alimentaire et lutter contre la faim.</p>
            <a href="#about" class="btn btn-custom animate__animated animate__fadeIn animate__delay-2s">En savoir plus</a>
        </div>
    </div>

    <!-- About Section -->
    <div class="container about-section" id="about">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-title">À propos de nous</h2>
                <p>RescueFood est une plateforme qui relie les établissements alimentaires aux organisations afin de prévenir
                    le gaspillage alimentaire et d'aider ceux qui en ont besoin. Nous visons à avoir un impact positif sur la
                    société et l'environnement.</p>
            </div>
        </div>
        <div class="row text-center ">
            <div class="col-md-4">
                <div class="feature-card p-4 mb-4 bg-white">
                    <h5>Pour les Restaurants</h5>
                    <p>Faites don de vos surplus alimentaires, réduisez le gaspillage et aidez ceux qui
                        en ont besoin.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 mb-4 bg-white">
                    <h5>Pour les Bénévoles</h5>
                    <p>Rejoignez-nous pour livrer des repas et soutenir la cause en offrant votre temps et vos efforts.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card p-4 mb-4 bg-white">
                    <h5>Pour les Organisations</h5>
                    <p>Recevez des dons de restaurants et de fournisseurs alimentaires pour soutenir ceux qui en ont besoin.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Section -->
    <div class="container contact-section" id="contact">
        <div class="row text-center">
            <div class="col-12">
                <h2 class="section-title">Contactez-nous</h2>
                <p>Si vous souhaitez collaborer avec nous ou en savoir plus sur la plateforme, n'hésitez pas à nous contacter !</p>
                <a href="mailto:contact@rescuefood.com" class="btn btn-light btn-custom">Contactez-nous</a>
            </div>
        </div>
    </div>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h1 class="fw-bold text-primary mb-4">F<span class="text-secondary">oo</span>dy</h1>
                    <p>Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed
                        stet lorem sit clita</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                                class="fab fa-twitter"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                                class="fab fa-youtube"></i></a>
                        <a class="btn btn-square btn-outline-light rounded-circle me-1" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Liens utiles</h5>
                    <ul class="list-unstyled">
                        <li><a class="text-white" href="">Accueil</a></li>
                        <li><a class="text-white" href="">À propos</a></li>
                        <li><a class="text-white" href="">Services</a></li>
                        <li><a class="text-white" href="">Réservations</a></li>
                        <li><a class="text-white" href="">Demandes</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Contact</h5>
                    <p><i class="fa fa-map-marker-alt me-3"></i>123 Street, City, Country</p>
                    <p><i class="fa fa-phone-alt me-3"></i>+123 456 7890</p>
                    <p><i class="fa fa-envelope me-3"></i>contact@rescuefood.com</p>
                </div>

                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Newsletter</h5>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input type="text" class="form-control border-light ps-4 pe-5" placeholder="Votre email"
                            style="height: 48px;">
                        <button type="button"
                            class="position-absolute top-0 end-0 btn btn-primary py-2 px-4"><i
                            class="fa fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow.js/1.1.2/wow.min.js"></script>
    <script>
        new WOW().init();
    </script>
</body>

</html>
