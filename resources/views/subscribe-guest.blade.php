<!-- resources/views/subscribe-guest.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Subscribe to Event</title>
    <style>
        body, html {
            scroll-behavior: smooth; /* Added for smooth scrolling */
        }
    </style>
</head>
<body>
    <header>
        @include('components.navbar')
    </header>
    <section id="subscribe-section"> <!-- Added id to target the subscription section -->
        <form class="login-box" action="{{ route('subscribe.guest.submit', ['eventId' => $eventId]) }}" method="POST">
            @csrf
            <input type="hidden" name="intended_url" value="{{ session('url.intended', request()->query('intended_url', url()->previous())) }}">
            <div class="login-header">
                <h1>Subscribe to Event</h1>
            </div>
            <div class="input-box">
                <input type="text" class="input-field" name="username" placeholder="Username" :value="old('username')" required autofocus autocomplete="off">
                @error('username')
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
                <input type="text" class="input-field" name="phone" placeholder="Phone" :value="old('phone')" required autocomplete="off">
                @error('phone')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-submit">
                <button type="submit" class="submit-btn" id="submit">Subscribe</button>
            </div>
        </form>
    </section>
    <script>
        window.onload = function() {
            document.getElementById('subscribe-section').scrollIntoView(); /* Added to scroll to subscription section on page load */
        };
    </script>
    <br><br><br><br><br><br><br><br>
</body>
</html>
