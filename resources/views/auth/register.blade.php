<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Sign Up</title>
    <style>
        body, html {
            scroll-behavior: smooth; /* Added for smooth scrolling */
        }
        .error{
                color:red;
        }
    </style>
</head>
<body>
    <header>
        @include('components.navbar')
    </header>
    <section id="register-section"> <!-- Added id to target the registration section -->
        <form class="login-box" action="{{ route('register') }}" method="POST">
            @csrf
            <input type="hidden" name="intended_url" value="{{ session('url.intended', request()->query('intended_url', url()->previous())) }}">
            <div class="login-header">
                <h1>Sign up</h1>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="name" placeholder="Username" :value="old('name')" required autofocus autocomplete="off">
                @error('name')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <input type="email" class="input-field" name="email" placeholder="Email" :value="old('email')" required autocomplete="off">
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="phone" placeholder="Phone" :value="old('phone')" required autocomplete="off"> <!-- Added phone field -->
                @error('phone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="password" placeholder="Password" required autocomplete="off">
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="password_confirmation" placeholder="Confirm Password" required autocomplete="off">
                @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-submit">
                <button type="submit" class="submit-btn" id="submit">Sign Up</button>
            </div>
            <div class="sign-up-link">
                <p>Back to <a href="{{ route('login', ['intended_url' => session('url.intended', request()->query('intended_url', url()->previous()))]) }}">Login</a></p>
            </div>
        </form>
    </section>
    <script>
        window.onload = function() {
            document.getElementById('register-section').scrollIntoView(); /* Added to scroll to registration section on page load */
        };
    </script>
    <br><br><br><br><br><br><br><br>
</body>
</html>
