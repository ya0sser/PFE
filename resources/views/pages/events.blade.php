<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Events</title>
    <style>
        body {
            font-family: "Montserrat", sans-serif;
        }
        h1 {
            width: 100%;
            position: relative;
            top: 0%;
            font-size: 40px;
            text-align: center;
            margin-bottom: 2rem;
            font-size: 3.5rem;
            font-weight: 700;
            line-height: 4.5rem;
            color: var(--text-dark);
        }
    </style>
</head>
<body>
    <header>
        @include('components.navbar')
    </header>
    <br><br><br><br>
    <h1>Nos ateliers publics</h1>
    <br><br><br><br>
    <div class="container1">
        <div class="container__events1">
            @forelse($events as $event)
                @include('components.event', ['event' => $event])
            @empty
                <p>No events available at the moment. Please check back later.</p>
            @endforelse
            {{ $events->links() }} 
        </div>
    </div>
    @include('components.footer')

    <script src="https://unpkg.com/scrollreveal"></script>

</body>
</html>
