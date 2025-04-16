<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Log in</title>
	<link rel="stylesheet" href="{{ asset('css/login.css') }}">
	<link href="https://fonts.googleapis.com/css2?family=Koulen&family=Oleo+Script+Swash+Caps&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <h2>Petify</h2>
    <div class="container" id="container">
        {{-- Sign Up Form --}}
        <div class="form-container sign-up-container">

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <h1>Create Account</h1>
                <div class="social-container">
                    {{-- Add social icons if needed --}}
                </div>
                <span>or use your email for registration</span>
                <input type="text" name="firstname" placeholder="First Name" required />
                <input type="text" name="lastname" placeholder="Last Name" required />
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" id="signup-password" placeholder="Password" minlength="8" required />
                <button type="submit">Create account</button>
            </form>
        </div>

        {{-- Sign In Form --}}
        <div class="form-container sign-in-container">
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Log in</h1>
                {{-- ERROR LOGIN --}}
                @if ($errors->has('email'))
                    <div class="alert alert-danger">
                        {{ $errors->first('email') }}
                    </div>
                @endif

        <div class="social-container">
            {{-- Add social icons if needed --}}
        </div>
                <div class="social-container">
                    {{-- Add social icons if needed --}}
                </div>
                <span>or use your account</span>
                <input type="email" name="email" placeholder="Email" required />
                <input type="password" name="password" placeholder="Password" minlength="8" required />
                <a href="#">Forgot your password?</a>
                <button type="submit">Log in</button>
            </form>
        </div>

        {{-- Overlay Panel --}}
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To stay connected with us, please log in using your personal information</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Ohh Fur Parent!</h1>
                    <p>Provide your personal information and begin your journey with us.</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
	<script src="{{ asset('js/login.js') }}"></script>

    @if (session('registered'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    @if ($errors->has('email'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('container').classList.add('right-panel-active');
        Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ $errors->first('email') }}',
            confirmButtonColor: '#d33',
        });
    </script>
    @endif
</body>
</html>