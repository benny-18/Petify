<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Petify - Login</title>
	<link rel="stylesheet" href="{{ asset('css/login.css') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Special+Gothic&display&family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body class="background">

    <li></li><li></li><li></li><li></li><li></li>
    <li></li><li></li><li></li><li></li><li></li>

    <h2>Petify</h2>

    <div class="container" id="container">
        {{-- REGISTER Form --}}
        <div class="form-container sign-up-container">
            <form id="registrationForm" method="POST" action="{{ route('register') }}">
                @csrf
                <h1 style="margin-top: 40px">Sign up</h1>
                <div class="social-container"></div>
                <span>Create a Petify account</span>
                <div class="names-form" style="display: flex; gap: 10px">
                    <input type="text" name="firstname" placeholder="First Name" required />
                    <input type="text" name="lastname" placeholder="Last Name" required />
                </div>
                <input type="email" name="email" placeholder="Email" required />
                <div class="password-wrapper">
                    <input id="register-password" type="password" name="password" placeholder="Password" minlength="8" required />
                    <span class="toggle-password" onclick="togglePassword('register-password', this)">
                        Show
                    </span>
                </div>

                <input type="checkbox" id="termsCheckbox" name="terms" style="display: none;">
                <label for="termsCheckbox" id="termsLabel" style="font-size: 11px; cursor: pointer;">
                    <span id="termsCheckmark" style="display: none; color: green; font-weight: bold; margin-right: 5px;">✔</span>
                    <span id="termsText" style="font-size: 14px; text-decoration: underline; color: black;">
                        I agree to the Terms and Conditions
                    </span>
                </label><br>

                <button style="margin-bottom: 20px" type="submit">Create account</button>
            </form>
        </div>

        {{-- sign in form --}}
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1 style="margin-top: 20px">Welcome</h1>
                <div class="social-container"></div>

                @if ($errors->has('email'))
                    <span style="color: red; font-size: 0.9rem;">
                        {{ $errors->first('email') }}
                    </span>
                @else
                    <span>Login to Petify</span>
                @endif

                <input type="email" name="email" placeholder="Email address" required />
                <div class="password-wrapper">
                    <input id="login-password" type="password" name="password" placeholder="Password" minlength="8" required />
                    <span class="toggle-password" onclick="togglePassword('login-password', this)">
                        Show
                    </span>
                </div>

                <button type="submit">Login</button>

                <!-- back to welcome from login -->
                <div style="margin-top: 12px;" class="flex justify-end p-4">
                    <a href="{{ url('/') }}" style="font-size: 14px;" class="text-white text-sm">
                        🏠︎ Back to Home
                    </a>
                </div>
            </form>
        </div>

        {{-- overlay panel chuchu --}}
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <img style="max-width: 55%; padding-bottom: 40px; padding-top: 40px" src="https://media3.giphy.com/media/v1.Y2lkPTc5MGI3NjExdXh1anpnMjdmdWlnZDcxd2dtZmx6aHg1bHpjejM2M2RmODJ2dWhzMSZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9cw/AM0vh25MfVxTgL8UeR/giphy.gif">
                    <h1>Welcome Back!</h1>
                    <p>To stay connected with us, please log in using your personal information.</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <img src="{{ asset('images/dog_running.gif') }}">
                    <h1>Oh, Fur Parent!</h1>
                    <p>Provide your personal information and begin your journey with us.</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <p style="margin-top: 50px">Powered by Swifties</p>

	<script src="{{ asset('js/login.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function togglePassword(inputId, toggleIcon) {
            const input = document.getElementById(inputId);
            const isPassword = input.type === 'password';
            input.type = isPassword ? 'text' : 'password';
            toggleIcon.textContent = isPassword ? 'Hide' : 'Show';
        }
    </script>

    <script>
        // terms and conditions popup
        document.getElementById('termsLabel').addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Terms and Conditions',
                html: 'By clicking ACCEPT, you agree to our <a href="{{ route('terms') }}" target="_blank" style="text-decoration: underline; color: #3085d6;">Terms and Conditions</a>.',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'ACCEPT',
                cancelButtonText: 'DECLINE'
            }).then((result) => {
                const checkbox = document.getElementById('termsCheckbox');
                const checkmark = document.getElementById('termsCheckmark');
                const termsText = document.getElementById('termsText');
                if (result.isConfirmed) {
                    checkbox.checked = true;
                    checkmark.style.display = "inline";
                    termsText.style.color = "green";
                    termsText.style.textDecoration = "none";
                } else {
                    checkbox.checked = false;
                    checkmark.style.display = "none";
                    termsText.style.color = "black";
                    termsText.style.textDecoration = "underline";
                }
                document.getElementById('termsCheckbox').checked = result.isConfirmed;
            });
        });

        document.getElementById('registrationForm').addEventListener('submit', function (e) {
            const checkbox = document.getElementById('termsCheckbox');

            // bawal submission kun t&c isn't accepted
            if (!checkbox.checked) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You must accept the Terms and Conditions to register.'
                });
            }
        });
    </script>

    @if (session('registered'))
    <script>
        Swal.fire({
            title: "Account Created!",
            text: "You can now log in.",
            icon: "success",
            customClass: {
                popup: 'swal2-popup'
            }
        });
    </script>
    @endif

    @if ($errors->has('emailExists'))
    <script>
        document.getElementById('container').classList.add('right-panel-active');
        Swal.fire({
            icon: 'error',
            title: 'Registration Error!',
            text: '{{ $errors->first('emailExists') }}',
            confirmButtonColor: '#d33',
        });
    </script>
    @endif

</body>
</html>
