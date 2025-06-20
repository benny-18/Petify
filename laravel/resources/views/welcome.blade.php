<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Petify</title>

    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&family=Poppins&display=swap" rel="stylesheet">

    <!-- CSS assets -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css" rel="stylesheet">
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">

</head>
<body>

    <section class="preloader">
        <div class="spinner">
            <span class="spinner-rotate"></span>
        </div>
    </section>

    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand mx-auto mx-lg-0">Petify</span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-5">
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_1">Home</a></li>
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_3">About</a></li>
                </ul>
                <!-- redirect to login -->
                <div class="d-flex align-items-center flex-wrap gap-2 ms-auto">
                    <ul class="navbar-nav ms-lg-5">
                        <li class="nav-item"><a class="nav-link click-scroll" href="{{ route('login')}}">Login or Sign Up</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <main>
        <section class="hero d-flex justify-content-center align-items-center" id="section_1"
                 style="background: linear-gradient(to right, #000000, #000000, #C4196D, #000000);">
            <div class="container position-relative">

                <div class="background">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>

                <div style="position: relative" class="row align-items-center">
                    <div class="col-lg-6 hero-text-container">
                        <h1 style="gap: 20px;" class="hero-heading"><a style="font-size: 65px; font-family: 'Instagram Sans', sans-serif;">Easily generate pet posters with </a>Petify</h1>
                        <div class="hero-body-container">
                            <p class="hero-body">Use Petify to easily create beautiful, ready-to-print pet posters that help spread the word fast. Easily customize and download missing pet posters—no design skills needed.</p>
                            <hr class="hero-divider">
                            <a href="{{ route('login') }}" class="btn generate-btn">Generate now</a>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @for($i = 0; $i < 5; $i++)
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}" aria-label="Slide {{ $i+1 }}"></button>
                                @endfor
                            </div>
                            <div class="carousel-inner">
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="carousel-item {{ $i == 1 ? 'active' : '' }}">
                                        <img src="{{ asset("images/carousel/Pet $i.png") }}" class="d-block w-100 rounded" alt="Slide {{ $i }}">
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="about section-padding" id="section_3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <img src="{{ asset('images/About.png') }}" class="about-image img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 col-12 mt-5 mt-lg-0">
                        <div class="about-thumb">
                            <div class="section-title-wrap d-flex justify-content-end align-items-center mb-4">
                                <h2 class="text-white me-4 mb-0">About Us</h2>
                            </div>
                            <h3 class="pt-2 mb-3">A glimpse of Petify.</h3>
                            <p style="text-align: justify;">Petify is designed to help pet owners quickly create lost and found posters using a simple and user-friendly editor. Whether it’s for a missing pet or adoption, making a poster takes just minutes.</p>
                            <p style="text-align: justify;">With a variety of customizable templates, Petify ensures your pet’s details are clear and easy to spot—helping you reach the right people fast.</p>
                            <hr class="hero-divider">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- testimonies keme -->
        <section class="testimonies section-padding" id="section_4"
            style="overflow:hidden; background: linear-gradient(180deg,rgba(196, 25, 109, 1) 0%, rgba(56, 10, 35, 1) 85%, rgba(196, 25, 109, 1) 100%);">
            <div id="marquee-wrapper" class="container">
                <h1 class="text-white text-center mb-5">What Our Users Say</h>
                <div id="carousel" class=" marquee-track gap-4" style="margin-top: 50px; scrollbar-width: none; animation: scroll 24s linear infinite; transition: all 0.6s cubic-bezier(0.68, -0.55, 0.27, 1.55);">

                    @php
                        $testimonials = [
                            [
                                'quote' => '"I LOVE PETIFY!!! #THEbestbest!!"',
                                'name' => 'Joyce Pabo',
                                'role' => 'Pet owner',
                            ],
                            [
                                'quote' => '"I am Tung Tung Sahur, and I love PETIFY!"',
                                'name' => 'Mr. Tung Sahur',
                                'role' => 'Comedian',
                            ],
                            [
                                'quote' => '"Petify helped me create a poster of my dog in minutes! #SLAY"',
                                'name' => 'Taylor Swift',
                                'role' => 'Singer',
                            ],
                            [
                                'quote' => '"Petify helped me find myself when I feel lost."',
                                'name' => 'Koda',
                                'role' => 'Dog',
                            ],
                            [
                                'quote' => '"YOU TELL ME!! I love PETIFY for my posters!"',
                                'name' => 'Yanna',
                                'role' => 'Vlogger',
                            ],
                            [
                                'quote' => '"Mi mi mi mi mi~ Mi love PETIFY! Solid! 10/10."',
                                'name' => 'Ms. Ballerina Capuccina',
                                'role' => 'Vlogger',
                            ],
                        ];
                    @endphp

                    @foreach ($testimonials as $testimonial)
                        <div class="card flex-shrink-0" style="border: 2px solid #C50565; width: 28rem; border-radius: 30px">
                            <div class="card-body">
                                <div class="card-top">
                                    <img src="{{ asset('images/card/taylorshesh.webp') }}"
                                        class="rounded-circle img-fluid"
                                        style="border: 2px solid #C50565; width: 75px; height: 75px; margin-bottom: 4px; object-fit: cover;">
                                </div>
                                <p class="card-text mt-2">{{ $testimonial['quote'] }}</p>
                                <div class="card-profile">
                                    <img src="{{ asset('images/icons/quotation_mark.png') }}" width="30px" alt="Quotation mark">
                                    <p class="card-title mb-0">{{ $testimonial['name'] }}</p>
                                    <p class="card-title mb-0" style="font-size: 16px; margin-top: 4px">{{ $testimonial['role'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

          <!-- start designing keme keme -->
        <section class="last section-padding animated-bg-section" id="section_5" style="position: relative; height: 480px; display: flex; align-content: center; flex-wrap: wrap; overflow: hidden;">
            <ul class="section-5-bubbles">
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>

            <div class="container" style="display: flex; flex-direction: column; flex-wrap: nowrap; align-items: center; z-index: 1; position: relative;">
                <div class="section-5-text" style="display: flex; gap: 20px; align-items: center;">
                    <h1 style="font-family: 'Instagram Sans', sans-serif; font-size: 66px;">Start designing with </h1>
                    <h1 style="font-size: 75px; color: #C50565;">Petify</h1>
                </div>
                <a href="{{ route('login') }}" style="border: 2px solid #FFFFFF; border-radius: 30px" class="btn btn-primary btn-lg mt-4">
                    Discover templates
                </a>
            </div>

        </section>

    </main>

    <footer class="site-footer" style="background: linear-gradient(to right, #430021, #C4196D); color: white;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p style="color: #FFFFFF">&copy; 2025 Petify. All Rights Reserved.
                        <a href="{{ route('terms') }}" target="_blank" style="color: #FFFFFF" class="text-decoration-underline">Terms and Conditions</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
        </div>
    </div>
</div>

    <!-- JS assets -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
    <script src="{{ asset('js/clickscroll.js') }}"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs" type="module"></script>
</body>
</html>
