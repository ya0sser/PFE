<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Welcome to Our Workshops</title>
    <style>
        body, html {
            scroll-behavior: smooth; /* Enable smooth scrolling */
        }
        .no-break {
            white-space: nowrap; /* Prevents the text from breaking into multiple lines */
        }
    </style>
</head>
<body>
    @include('components.navbar')

    <div class="container1" id="main-content"> <!-- Added id to target the main content area -->
        <div class="container__left1">
            <h1>Welcome To Our Workshops</h1>
            <div class="container__btn1">
                @guest
                <a href="/login" class="btn1">Se connecter</a>
                <a href="{{ route('redirect.register') }}" class="btn1">S'inscrire</a>
                @endguest
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn1 no-break">Se Deconnecter</button>
                    </form>
                @endauth
            </div>
        </div>
        <div class="container__right1">
            <div class="images1">
                <img src="{{ asset('images/nous-aider.jpg') }}" alt="tent-1" class="tent-11" />
                {{-- <img src="{{ asset('images/WhatsApp Image 2024-06-05 à 17.28.50_a58c4a39.jpg') }}" alt="tent-1" class="tent-11" /> --}}

            </div>
            <div class="content1">
                <h4>9h00 | 16h00</h4>
                <h2>FabLab</h2>
                <h3>Association Al-jisr</h3>
                <p>Le Fab Lab Al Jisr est un espace de co-construction et d’auto-formation, entièrement dédié à l’innovation, à la création numérique, à l’informatique, situé sur Casablanca</p>
            </div>
        </div>  
    </div>

    @include('components.footer')

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        const scrollRevealOption = {
            distance: "50px",
            origin: "bottom",
            duration: 1000,
        };

        ScrollReveal().reveal(".container__left1 h1", {
            ...scrollRevealOption,
        });
        ScrollReveal().reveal(".container__left1 .container__btn1", {
            ...scrollRevealOption,
            delay: 500,
        });

        ScrollReveal().reveal(".container__right1 h4", {
            ...scrollRevealOption,
            delay: 1000,
        });
        ScrollReveal().reveal(".container__right1 h2", {
            ...scrollRevealOption,
            delay: 1000,
        });
        ScrollReveal().reveal(".container__right1 h3", {
            ...scrollRevealOption,
            delay: 1000,
        });
        ScrollReveal().reveal(".container__right1 p", {
            ...scrollRevealOption,
            delay: 1100,
        });

        ScrollReveal().reveal(".container__right1 .tent-11", {
            duration: 1000,
            delay: 1200,
        });

        ScrollReveal().reveal(".location1", {
            ...scrollRevealOption,
            origin: "left",
            delay: 1000,
        });

        ScrollReveal().reveal(".socials1 span", {
            ...scrollRevealOption,
            origin: "top",
            delay: 1000,
            interval: 500,
        });
        ScrollReveal().reveal(".item-container1", {
            ...scrollRevealOption,
            delay: 700,
        });


    </script>
</body>
</html>
