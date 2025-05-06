<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Petify</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&family=Poppins&display=swap" rel="stylesheet">

    <!-- CSS Assets -->
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
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_2">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_3">About</a></li>
                </ul>
                <!-- redirect to login -->
                <div class="d-flex align-items-center flex-wrap gap-2 ms-auto">
                    <a href="{{ route('login')}}" class="text" hover="underline">Login or Sign Up</a>
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
                        <h1 class="hero-heading">Generate posters with Petify</h1>
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

                <!-- <div class="background">
                    @for($i = 0; $i < 12; $i++)
                        <span></span>
                    @endfor
                </div> -->

            </div>
        </section>

        <section class="gallery section-padding" id="section_2">
            <div class="container">
                <div class="banner-wrapper mb-4">
                    <img src="{{ asset('images/Banner.png') }}" class="banner-image" alt="Banner">
                </div>
                <div class="section-title-wrap text-center mb-4">
                    <h2 class="gallery-heading mb-0">Template Gallery</h2>
                </div>
                <div class="row">
                    @php
                        $gallery = [
                            ['tag' => 'Lost / Found Templates', 'title' => 'Find Your Babies!', 'img' => 'p1.png'],
                            ['tag' => 'Birthday Templates', 'title' => 'Celebrate Online', 'img' => 'p2.png'],
                            ['tag' => 'Pet ID Templates', 'title' => 'Introduce Your Babies', 'img' => 'p3.png'],
                        ];
                    @endphp
                    @foreach ($gallery as $item)
                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="gallery-thumb">
                                <div class="gallery-info">
                                    <small class="gallery-tag">{{ $item['tag'] }}</small>
                                    <h3 class="gallery-title">{{ $item['title'] }}</h3>
                                </div>
                                <img src="{{ asset("images/gallery/{$item['img']}") }}" class="gallery-image img-fluid" alt="">
                            </div>
                        </div>
                    @endforeach
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
            style="background: linear-gradient(to right, #000000, #000000, #C4196D, #000000);">
            <div class="container">
                <h1 class="text-white text-center mb-5">What Our Users Say</h>
                    <div class="d-flex overflow-auto gap-4 px-2 pb-4">
                    {{-- card 1--}}
                    <div class="card flex-shrink-0" style="width: 18rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/card/taylorshesh.webp') }}" class="rounded-circle img-fluid"
                                style="width: 200px; height: 200px; object-fit: cover;">
                            <h5 class="card-title mb-0">Taylor Swift</h5>
                            <small class="text-muted">Singer</small>
                            <p class="card-text mt-2">"Petify helped me create a poster of my dog in minutes! #SwiftieApproved #Slay!"</p>
                        </div>
                    </div>
                    {{-- card 2--}}
                    <div class="card flex-shrink-0" style="width: 18rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/card/taylorshesh.webp') }}" class="rounded-circle img-fluid"
                                style="width: 200px; height: 200px; object-fit: cover;">
                            <h5 class="card-title mb-0">Joyce Pabo</h5>
                            <small class="text-muted">Pet owners</small>
                            <p class="card-text mt-2">"I LOVE PETIFY!!! #THEbestbest!!"</p>
                        </div>
                    </div>
                    {{-- card 3--}}
                    <div class="card flex-shrink-0" style="width: 18rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/card/taylorshesh.webp') }}" class="rounded-circle img-fluid"
                                style="width: 200px; height: 200px; object-fit: cover;">
                            <h5 class="card-title mb-0">Mr. Tung Sahur</h5>
                            <small class="text-muted">Comedian</small>
                            <p class="card-text mt-2">"I am Tung Tung Sahur, and I love PETIFY!"</p>
                        </div>
                    </div>
                    {{-- card 4--}}
                    <div class="card flex-shrink-0" style="width: 18rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/card/taylorshesh.webp') }}" class="rounded-circle img-fluid"
                                style="width: 200px; height: 200px; object-fit: cover;">
                            <h5 class="card-title mb-0">Koda</h5>
                            <small class="text-muted">Dog</small>
                            <p class="card-text mt-2">"Petify helped me find myself when I feel lost."</p>
                        </div>
                    </div>
                    {{-- card 5--}}
                    <div class="card flex-shrink-0" style="width: 18rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/card/taylorshesh.webp') }}" class="rounded-circle img-fluid"
                                style="width: 200px; height: 200px; object-fit: cover;">
                            <h5 class="card-title mb-0">Yanna</h5>
                            <small class="text-muted">Vlogger</small>
                            <p class="card-text mt-2">"YOU TELL ME!! I love PETIFY for my posters!"</p>
                        </div>
                    </div>
                    {{-- card 6--}}
                    <div class="card flex-shrink-0" style="width: 18rem;">
                        <div class="card-body">
                            <img src="{{ asset('images/card/taylorshesh.webp') }}" class="rounded-circle img-fluid"
                                style="width: 200px; height: 200px; object-fit: cover;">
                            <h5 class="card-title mb-0">Ms. Ballerina Capuccina</h5>
                            <small class="text-muted">Dancer</small>
                            <p class="card-text mt-2">"Mi mi mi mi mi~ Mi love PETIFY! Solid! 10/10."</p>
                        </div>
                    </div>


                </div>
            </div>
        </section>

          <!-- start designing keme keme -->
        <section class="last section-padding" id="section_5">
            <div class="container">
                <div class="row">
                    <h1> start desigingin w us bro </h>
                </div>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg mt-4">
                    Start desiginigg
                </a>
            </div>
        </section>
    </main>

    <footer class="site-footer" style="background: linear-gradient(to right, #430021, #C4196D); color: white;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <p>&copy; 2025 Petify. All Rights Reserved. 
                        <br><a href="{{ route('terms') }}" target="_blank" class="text-decoration-underline">Terms and Conditions</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
        </div>
    </div>
</div>

    <!-- JS Assets -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/welcome.js') }}"></script>
    <script src="{{ asset('js/clickscroll.js') }}"></script>
</body>
</html>
