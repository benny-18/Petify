<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>Petify</title>

        <!-- google fonts chuchu -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps&family=Poppins&display=swap" rel="stylesheet">

        <!-- CSS assets -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/magnific-popup@1.1.0/dist/magnific-popup.css" rel="stylesheet">
        <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
        <link href="{{ asset('css/dashboard-new.css') }}" rel="stylesheet">
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
                    <div class="d-flex align-items-center flex-wrap gap-2 ms-auto">
                        <a href="#" class="profile-photo-link" data-bs-toggle="modal" data-bs-target="#profileModal">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : asset('images/pfp.jpg') }}" alt="Profile" class="profile-photo">
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <main>
            <section class="hero d-flex justify-content-center align-items-center" id="section_1" style="background: linear-gradient(to right, #000000, #000000, #C4196D, #000000);">
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

                    <main class="project-container">
                        <section class="creation-panel">
                        <img
                            src="{{ asset('images/petify-templates-large.png') }}"
                            alt="Missing Pet Templates"
                            class="template-image"
                        />

                        <h1 class="panel-title">What will you design today?</h1>
                        <div class="create-project-divider"></div>

                        <form action="{{ route('project.store') }}" method="POST" class="creation-form">
                            @csrf
                            <input type="text" name="title" placeholder="Project title" required class="title-input"/>
                            <textarea name="description" placeholder="Project description (optional)" class="description-textarea"></textarea>
                            <button type="submit" class="generate-button">Generate new project</button>
                        </form>

                        </section>
                        <section class="projects-panel">
                        <header class="projects-header">
                            <div class="projects-title">YOUR PROJECTS</div>
                            <div class="header-line"></div>
                        </header>

                        @if(Auth::user()->projects->isEmpty())
                                <div class="no-projects">
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
                                                @if ($project->thumbnail_path)
                                                    <img src="{{ asset($project->thumbnail_path) }}"
                                                        class="card-img-top img-fluid"
                                                        alt="Poster thumbnail of {{ $project->title }}">
                                                @else
                                                    <img src="{{ asset('images/templates/thumbs/template-1.webp') }}"
                                                        class="card-img-top img-fluid"
                                                        alt="Default thumbnail">
                                                @endif

                                                {{-- Card Body --}}
                                                <div class="card-body">
                                                    <h5 style="color: #c50565" class="card-title mb-1">{{ Str::limit($project->title, 15) }}</h5>
                                                    <p style="font-size: 18px" class="card-text">{{ Str::limit($project->description, 16) }}</p>
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
                                                            style="border-radius: 12px"
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
                        </section>
                        </main>
                        </div>
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


        <!-- profile modal -->
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

        <!-- JS assets -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script src="{{ asset('js/click-scroll.js') }}"></script>


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

        <!-- confirm delete -->
        <script>
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

            // reload
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
            const saveButton = document.getElementById('saveButton');
            const icon = document.getElementById('password-status-icon');
            const spinner = document.querySelector('.spinner-border');

            if (password.trim() === '') {
                saveButton.classList.remove('btn-secondary');
                saveButton.classList.add('btn-primary');
                saveButton.removeAttribute('disabled');
                icon.innerHTML = '';
                if (spinner) spinner.style.display = 'none';
                return;
            }

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
                    icon.innerHTML = `<i class="bi bi-check-circle-fill text-success"></i>`;
                    saveButton.classList.remove('btn-secondary');
                    saveButton.classList.add('btn-primary');
                    saveButton.removeAttribute('disabled');
                } else {
                    icon.innerHTML = `<i class="bi bi-x-circle-fill text-danger"></i>`;
                    saveButton.classList.remove('btn-primary');
                    saveButton.classList.add('btn-secondary');
                    saveButton.setAttribute('disabled', 'true');
                }
                if (spinner) spinner.style.display = 'none';
            })
            .catch(() => {
                icon.innerHTML = `<i class="bi bi-exclamation-circle-fill text-warning"></i>`;
                saveButton.classList.remove('btn-primary');
                saveButton.classList.add('btn-secondary');
                saveButton.setAttribute('disabled', 'true');
                if (spinner) spinner.style.display = 'none';
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
                const saveButton = document.getElementById('saveButton');

                icon.style.display = 'block';
                loading.style.display = 'inline-block';
                success.style.display = 'none';
                error.style.display = 'none';

                clearTimeout(matchTimer);
                matchTimer = setTimeout(() => {
                    loading.style.display = 'none';
                    if (confirmation === '') {
                        icon.style.display = 'none';
                        saveButton.disabled = true;
                        saveButton.classList.add('btn-secondary');
                        saveButton.classList.remove('btn-primary');
                    } else if (newPassword === confirmation) {
                        success.style.display = 'inline-block';
                        error.style.display = 'none';
                        saveButton.disabled = false;
                        saveButton.classList.add('btn-primary');
                        saveButton.classList.remove('btn-secondary');
                    } else {
                        success.style.display = 'none';
                        error.style.display = 'inline-block';
                        saveButton.disabled = true;
                        saveButton.classList.add('btn-secondary');
                        saveButton.classList.remove('btn-primary');
                    }
                }, 500);
            }

            // SHOW/HIDE PASSWORDD
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
