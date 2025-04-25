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
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
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
            <a href="{{ url('/') }}" class="navbar-brand mx-auto mx-lg-0">Petify</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-5">
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_1">Home</a></li>
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_2">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_3">About</a></li>
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_4">Generate</a></li>
                </ul>
                <div class="d-flex align-items-center flex-wrap gap-2 ms-auto">
                    <a href="#" class="profile-photo-link" data-bs-toggle="modal" data-bs-target="#profileModal">
                        <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/pfp.jpg') }}" alt="Profile" class="profile-photo">
                    </a>
                </div>   
            </div>
        </div>
    </nav>

    <main>
        <section class="hero d-flex justify-content-center align-items-center" id="section_1"
                 style="background: linear-gradient(to right, #000000, #000000, #C4196D, #000000);">
            <div class="container position-relative">
                <div class="row align-items-center">
                    <div class="col-lg-6 hero-text-container">
                        <h1 class="hero-heading">Greetings Furpies!</h1>
                        <div class="hero-body-container">
                            <p class="hero-body">Welcome to our website, where we help you create the perfect poster for your furry friends...</p>
                            <hr class="hero-divider">
                            <a href="#section_4" class="btn generate-btn">Generate Now</a>
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
                <div class="background">
                    @for($i = 0; $i < 15; $i++)
                        <span></span>
                    @endfor
                </div>
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
                            <p style="text-align: justify;">Petify is designed to help pet owners easily create lost and found posters...</p>
                            <p style="text-align: justify;">With a variety of templates to choose from, Petify ensures your pet's information...</p>
                            <hr class="hero-divider">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CREATE PROJECT -->
        <section class="contact section-padding" id="section_4">
            <div class="container">
                <div class="section-title-wrap d-flex justify-content-center align-items-center mb-5">                       
                    <h2 class="text-white mb-0">Create Project</h2>
                </div>

                <!-- CREATE FORM -->
                 <form action="{{ route('project.store') }}" method="POST" class="row g-3 mb-5">
                    @csrf
                    <div class="col-md-4">
                            <input type="text" name="title" class="form-control" placeholder="Project Title" required>
                    </div>
                    <div class="col-md-5">
                            <input type="text" name="description" class="form-control" placeholder="Project Description">
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary w-100 rounded">Create Project</button>
                    </div>
                </form>

                <!-- PROJECTS SECTION -->
                 <div class="row">
                    <div class="col-12">
                            <h2 class="text-white- mb-3">Your Projects</h2>

                            @if(Auth::user()->projects->isEmpty())
                                <div class="alert alert-info text-center">
                                    You have no projects yet.
                                </div>
                            @else
                            <ul class="list-group">
                                @foreach(Auth::user()->projects as $project)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <a href="{{ route('project.editor', $project->id) }}" class="text-decoration-none text-dark">
                                        <div>
                                            <strong style="font-size: 20px; font-weight: bold">{{ $project->title }}</strong><br>
                                            <small>{{ $project->description }}</small>
                                        </div>
                                         </a>

                                        <!-- DELETE BUTTON FOR PROJECTS and DATE -->
                                         <div class="d-flex align-items-center ms-3">
                                            <small class="me-3">{{ $project->created_at->format('M d, Y') }}</small>

                                        <form id="delete-form-{{ $project->id }}" action="{{ route('project.destroy', $project->id) }}#section_4" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <button type="button" class="btn btn-sm btn-outline-danger rounded"
                                            onclick="event.stopPropagation(); confirmDelete({{ $project->id }})">
                                            Delete
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                    </div>
                </div>

            </div>
        </section>
    </main>

    <footer class="site-footer" style="background: linear-gradient(to right, #000000, #000000, #C4196D); color: white;">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <a>&copy; 2025 Petify. All Rights Reserved.</a>
                </div>
            </div>
        </div>
    </footer>

  
 <!-- Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center w-100 mb-3">Profile</h5>
            </div>

            <!-- Profile Update Form -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Left: Profile Picture -->
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/pfp.jpg') }}" 
                                alt="Profile Picture"
                                class="rounded-circle img-fluid"
                                style="width: 200px; height: 200px; object-fit: cover;">
                            <input type="file" name="profile_picture" class="form-control mt-2" id="profilePictureInput">
                            <p id="picError" style="color: red; font-size: 14px; display:none;">File is too large. Maximum size is 2MB.</p>
                        </div>

                        <!-- Right: Form -->
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="firstname" class="form-label">First Name</label>
                                    <input type="text" id="firstname" name="firstname" class="form-control"
                                           value="{{ Auth::user()->firstname }}">
                                </div>
                                <div class="col">
                                    <label for="lastname" class="form-label">Last Name</label>
                                    <input type="text" id="lastname" name="lastname" class="form-control"
                                           value="{{ Auth::user()->lastname }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" value="{{ Auth::user()->email }}" disabled>
                            </div>

                            <!-- Change Password Fields -->
                            <h6 class="fw-bold">Change Password</h6>

                            <!-- Old password -->
                            <div class="mb-3 position-relative">
                                <input type="password" name="old_password" id="old_password" class="form-control pe-5" placeholder="Enter Old Password">
                                <span id="password-status-icon" class="position-absolute top-50 end-0 translate-middle-y me-3">
                                </span>
                            </div>

                            <!-- New password -->
                            <div class="mb-3">
                                <input type="password" name="new_password" class="form-control pe-5" placeholder="Enter New Password">
                            </div>

                            <!-- Re-enter password -->
                            <div class="mb-4 position-relative">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Re-enter Password" oninput="checkPasswordMatch()">
                                
                                <span id="match-icon" class="position-absolute top-50 end-0 translate-middle-y me-3" style="display: none;">
                                    <div class="spinner-border spinner-border-sm text-secondary" role="status" id="match-loading" style="display: none;"></div>
                                    <i class="bi bi-check-circle-fill text-success" id="match-success" style="display: none;"></i>
                                    <i class="bi bi-x-circle-fill text-danger" id="match-error" style="display: none;"></i>
                                </span>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary rounded-pill px-4" id="saveButton">Save Changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Logout Form-->
            <div class="modal-footer d-flex justify-content-between w-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger rounded-pill px-4">LOG OUT</button>
                </form>
                <!-- Close Button -->
                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div> 

    <!-- JS Assets -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script src="{{ asset('js/clickscroll.js') }}"></script>


<!-- save changes -->
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if (session('show_profile_modal'))
        document.addEventListener('DOMContentLoaded', function () {
            let modal = new bootstrap.Modal(document.getElementById('profileModal'));
            modal.show();
        });
    @endif
</script>

<script>
  // CONFIRM DELETE PROJECT
  function confirmDelete(projectId) {
    Swal.fire({
      title: 'Are you sure?',
      text: "This project will be deleted permanently.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Yes, delete it!',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        document.getElementById(`delete-form-${projectId}`).submit();
      }
    });
  }
  
  // RELOAD ON BACK BUTTON
  window.addEventListener('pageshow', function (event) {
    if (event.persisted) {
      window.location.reload();
    }
  });
  
  // PASSWORD CHECKING SECTION
  let typingTimer;
  const delay = 600;
  const input = document.getElementById('old_password');
  const icon = document.getElementById('password-status-icon');
  
  input.addEventListener('input', () => {
    clearTimeout(typingTimer);
    icon.innerHTML = `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div>`;
  
    typingTimer = setTimeout(() => {
      checkOldPassword(input.value);
    }, delay);
  });
  
  function checkOldPassword(password) {
    fetch('{{ route('check.password') }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
      },
      body: JSON.stringify({ password })
    })
      .then(response => response.json())
      .then(data => {
        if (data.match) {
          icon.innerHTML = `<i class="bi bi-check-circle-fill text-success"></i>`;
        } else {
          icon.innerHTML = `<i class="bi bi-x-circle-fill text-danger"></i>`;
        }
      })
      .catch(() => {
        icon.innerHTML = `<i class="bi bi-exclamation-circle-fill text-warning"></i>`;
      });
  }
  
  // CHECK PASSWORD MATCH
  let matchTimer;
  
  function checkPasswordMatch() {
    const newPassword = document.querySelector('input[name="new_password"]').value;
    const confirmation = document.getElementById('new_password_confirmation').value;
    const loading = document.getElementById('match-loading');
    const success = document.getElementById('match-success');
    const error = document.getElementById('match-error');
    const icon = document.getElementById('match-icon');
  
    icon.style.display = 'block';
    loading.style.display = 'inline-block';
    success.style.display = 'none';
    error.style.display = 'none';
  
    clearTimeout(matchTimer);
    matchTimer = setTimeout(() => {
      loading.style.display = 'none';
      if (confirmation === '') {
        icon.style.display = 'none';
      } else if (newPassword === confirmation) {
        success.style.display = 'inline-block';
        error.style.display = 'none';
      } else {
        success.style.display = 'none';
        error.style.display = 'inline-block';
      }
    }, 500);
  }
  
  // SHOW/HIDE PASSWORD
  function togglePassword(inputId, btn) {
    const input = document.getElementById(inputId);
    if (input.type === "password") {
      input.type = "text";
      btn.textContent = "Hide";
    } else {
      input.type = "password";
      btn.textContent = "Show";
    }
  }
</script>


</body>
</html>
