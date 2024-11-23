<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/askus.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Ask Us | Al-Jisr</title>
    <style>
        .alert-success, .alert-error {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }

        .alert-error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }

        .errors-list {
            list-style-type: none;
            padding: 0;
            margin-top: 20px;
            color: #721c24;
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px;
            text-align: left;
        }

        .errors-list li {
            margin: 5px 0;
        }
        h1 {
            width: 100%;
            position: relative;
            top: 0%;
            font-size: 40px;
            color: #000;
        }
        body, html {
            scroll-behavior: smooth; /* Added for smooth scrolling */
        }
    </style>
</head>
<body>
    <header>
        @include('components.navbar')
    </header>
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <section id="askus-section"> <!-- Added id to target the ask us section -->
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf 
            <div class="login-box">
                <div class="login-header">
                    <h1>Contact Nous</h1>
                </div>
                <div class="input-box">
                    <input type="text" class="input-field" placeholder="Your Name" name="name" required>
                </div>
                <div class="input-box">
                    <input type="email" class="input-field" placeholder="Your Email" name="email" required>
                </div>
                <div class="input-box">
                    <textarea class="input-field" id="text" placeholder="Your Message" name="content" required></textarea>
                </div>
                <div class="input-submit">
                    <button class="submit-btn" id="submit"></button>
                    <label for="submit">Send</label>
                </div>
            </div>
        </form>
    </section>
    <script>
        window.onload = function() {
            document.getElementById('askus-section').scrollIntoView(); /* Added to scroll to ask us section on page load */
        };
    </script>
    <br><br><br><br><br><br><br><br>
</body>
</html>
