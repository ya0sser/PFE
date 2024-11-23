<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Login | Al-Jisr</title>
</head>
<body>
    <header>
        @include('components.navbar')
    </header>
    <section>
        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="login-box">
                <div class="login-header">
                    <header>Admin Login</header>
                </div>

                <div class="input-box">
                    <input type="email" name="email" class="input-field" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="off">
                </div>
                <div class="input-box">
                    <input type="password" id="password" name="password" class="input-field" placeholder="Password" required autocomplete="off">
                    <button type="button" onclick="togglePassword()" class="show-password-button">
                        <i class="fa fa-eye" id="togglePasswordIcon"></i>
                    </button>
                </div>

                @if ($errors->any())
                    <div class="error-message">
                        The provided credentials are incorrect. Please try again.
                    </div>
                @endif

                <div class="input-submit">
                    <button class="submit-btn" id="submit">Sign In</button>
                </div>
            </div>
        </form>
    </section>
    <script>
        function togglePassword() {
            var passwordInput = document.getElementById('password');
            var toggleIcon = document.getElementById('togglePasswordIcon');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.className = 'fa fa-eye-slash';
            } else {
                passwordInput.type = 'password';
                toggleIcon.className = 'fa fa-eye';
            }
        }
    </script>
</body>
</html>
