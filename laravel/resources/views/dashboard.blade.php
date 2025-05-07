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
            <span class="navbar-brand mx-auto mx-lg-0">Petify</span>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-lg-5">
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_1">Create</a></li>
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_2">Projects</a></li>
                    <li class="nav-item"><a class="nav-link click-scroll" href="#section_3">Templates</a></li>
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
                    <div class="hero-text-container">
                        <div class="section-title-wrap d-flex justify-content-center align-items-center mb-5">
                    <h2 class="create-text text-white mb-0">Create Project</h2>
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
                    </div>
                </div>
            </div>
        </section>

        <!-- PROJECTS -->
        <section class="contact section-projects" id="section_2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="text-white mb-4">Your Projects</h2>

                        @if(Auth::user()->projects->isEmpty())
                            <div class="text-center">
                                <img src="{{ asset('images/dog-question.gif') }}" alt="No Projects" class="img-fluid no-projects-image">
                                <p class="no-projects-text mt-3">
                                    You have no projects yet...? Create one!
                                </p>
                            </div>
                        @else
                            <div class="row">
                                @foreach(Auth::user()->projects as $project)
                                    <div class="col-md-4 mb-4">
                                        <div class="card-project h-100 shadow-sm position-relative">

                                            {{-- Clickable Wrapper --}}
                                            <a href="{{ route('project.editor', $project->id) }}" class="stretched-link"></a>

                                            {{-- Poster Thumbnail --}}
                                            @if ($project->poster_path)
                                                <img src="{{ asset('images/templates/template-1.png') }}"
                                                    class="card-img-top img-fluid"
                                                    alt="Poster thumbnail of {{ $project->title }}">
                                            @else
                                                <img src="{{ asset('images/templates/template-1.png') }}"
                                                    class="card-img-top img-fluid"
                                                    alt="Default thumbnail">
                                            @endif

                                            {{-- Card Body --}}
                                            <div class="card-body">
                                                <h5 class="card-title mb-1">{{ Str::limit($project->title, 50) }}</h5>
                                                <p class="card-text">{{ Str::limit($project->description, 100) }}</p>
                                            </div>

                                            {{-- Card Footer --}}
                                            <div class="card-footer d-flex justify-content-between align-items-center bg-white border-0 position-relative">
                                                <small class="text-muted">{{ $project->created_at->format('M d, Y') }}</small>

                                                <form id="delete-form-{{ $project->id }}"
                                                    action="{{ route('project.destroy', $project->id) }}"
                                                    method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <button type="button"
                                                        class="btn btn-sm btn-outline-danger z-3 position-relative"
                                                        onclick="event.preventDefault(); event.stopPropagation(); confirmDelete({{ $project->id }})">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>


           <section class="gallery section-padding" id="section_3">
            <div class="container">
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

        
    </main>

    <footer class="site-footer" style="background: linear-gradient(to right, #430021, #C4196D); color: white;">
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
        <div class="modal-content" style="padding-right: 30px; padding-left: 30px;">
            <div class="modal-header justify-content-center">
                <h5 style="font-size: 40px" class="modal-title text-center">Profile</h5>
            </div>

            <!-- Profile Update Form -->
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row g-4">
                        <!-- Profile Picture -->
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
                                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}">
                            </div>

                            <!-- Change Password Fields -->
                            <h6 class="fw-bold">Change Password</h6>

                            <!-- Old password -->
                            <div class="mb-3 position-relative">
                                <input type="password" name="old_password" id="old_password" class="form-control pe-5" placeholder="Enter Old Password" minlength="8">
                                <span id="password-status-icon" class="position-absolute top-50 end-0 translate-middle-y me-3">
                                </span>
                            </div>

                            <!-- New password -->
                            <div class="mb-3">
                                <input type="password" name="new_password" class="form-control pe-5" placeholder="Enter New Password" minlength="8">
                            </div>

                            <!-- Re-enter password -->
                            <div class="mb-4 position-relative">
                                <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Re-enter Password" oninput="checkPasswordMatch()" minlength="8">

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
    const delay = 600;  // Delay before making the request
    const input = document.getElementById('old_password');  // The old password input field
    const icon = document.getElementById('password-status-icon');  // The icon element to show validation feedback

    input.addEventListener('input', () => {
        clearTimeout(typingTimer);
        icon.innerHTML = `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div>`;  // Show spinner while checking

        typingTimer = setTimeout(() => {
            checkOldPassword(input.value);  // Call password checking function after delay
        }, delay);
    });

    function checkOldPassword(password) {
    const saveButton = document.getElementById('saveButton');
    const icon = document.getElementById('password-status-icon');
    const spinner = document.querySelector('.spinner-border');  // Spinner element (if any)

    // If the old password is empty, enable the button and hide the spinner
    if (password.trim() === '') {
        saveButton.classList.remove('btn-secondary');  // Remove gray color
        saveButton.classList.add('btn-primary');  // Restore the normal color
        saveButton.removeAttribute('disabled');  // Enable the button
        icon.innerHTML = '';  // Clear the status icon
        if (spinner) spinner.style.display = 'none';  // Hide the spinner
        return;  // Stop further execution
    }

    // Show the spinner while checking the password
    icon.innerHTML = `<div class="spinner-border spinner-border-sm text-secondary" role="status"></div>`;
    if (spinner) spinner.style.display = 'inline-block';

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
            icon.innerHTML = `<i class="bi bi-check-circle-fill text-success"></i>`;  // Success icon
            saveButton.classList.remove('btn-secondary');  // Remove gray class if password matches
            saveButton.classList.add('btn-primary');  // Keep the normal color
            saveButton.removeAttribute('disabled');  // Enable the button
        } else {
            icon.innerHTML = `<i class="bi bi-x-circle-fill text-danger"></i>`;  // Error icon (wrong password)
            saveButton.classList.remove('btn-primary');  // Remove normal color
            saveButton.classList.add('btn-secondary');  // Apply gray color
            saveButton.setAttribute('disabled', 'true');  // Make the button unclickable
        }
        if (spinner) spinner.style.display = 'none';  // Hide the spinner after the check
    })
    .catch(() => {
        icon.innerHTML = `<i class="bi bi-exclamation-circle-fill text-warning"></i>`;  // Warning icon for any error
        saveButton.classList.remove('btn-primary');  // Remove normal color
        saveButton.classList.add('btn-secondary');  // Apply gray color
        saveButton.setAttribute('disabled', 'true');  // Make the button unclickable
        if (spinner) spinner.style.display = 'none';  // Hide the spinner if there's an error
    });
}

    //new pass confirmation
    let matchTimer;

    function checkPasswordMatch() {
        const newPassword = document.querySelector('input[name="new_password"]').value;
        const confirmation = document.getElementById('new_password_confirmation').value;
        const loading = document.getElementById('match-loading');
        const success = document.getElementById('match-success');
        const error = document.getElementById('match-error');
        const icon = document.getElementById('match-icon');
        const saveButton = document.getElementById('saveButton');  // The "Save Changes" button

        icon.style.display = 'block';
        loading.style.display = 'inline-block';
        success.style.display = 'none';
        error.style.display = 'none';

        clearTimeout(matchTimer);
        matchTimer = setTimeout(() => {
            loading.style.display = 'none';
            if (confirmation === '') {
                icon.style.display = 'none';
                saveButton.disabled = true;  // Disable the button if the confirmation is empty
                saveButton.classList.add('btn-secondary');  // Add gray color class
                saveButton.classList.remove('btn-primary');  // Remove original color class
            } else if (newPassword === confirmation) {
                success.style.display = 'inline-block';
                error.style.display = 'none';
                saveButton.disabled = false;  // Enable the button when passwords match
                saveButton.classList.add('btn-primary');  // Revert to original color
                saveButton.classList.remove('btn-secondary');  // Remove gray color class
            } else {
                success.style.display = 'none';
                error.style.display = 'inline-block';
                saveButton.disabled = true;  // Disable the button when passwords do not match
                saveButton.classList.add('btn-secondary');  // Add gray color class
                saveButton.classList.remove('btn-primary');  // Remove original color class
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
