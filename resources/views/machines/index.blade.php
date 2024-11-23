<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parc Machine</title>
    <link rel="stylesheet" href="{{ asset('css/machine.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto:wght@400&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Montserrat", sans-serif;
            text-decoration: none;
        }
        h1 {
            font-family: 'Montserrat', sans-serif;
        }
        .machine-card {
            background-color: #0d2234;
            color: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .machine-card img {
            width: 200px;
            height: auto;
            border-radius: 8px;
            margin-right: 20px;
        }
        .machine-details {
            flex-grow: 1;
        }
        .machine-details h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .machine-details p {
            margin-bottom: 5px;
            font-size: 1rem;
        }
    </style>
</head>
<body>
<header>
    @include('components.navbar')
    </header>
    <div class="container">
        <h1 class="text-center my-5">Parc Machine</h1>
        
        <div class="row">
            @foreach($machines as $machine)
                <div class="col-12 mb-4">
                    <div class="machine-card">
                        <img src="{{asset('images/' .$machine->image_path)}}" alt="{{ $machine->name }}" onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">
                        <div class="machine-details">
                            <h3 class="mt-3">{{ $machine->name }}</h3>
                            <p>Marque: {{ $machine->brand }}</p>
                            <p>Capacité: {{ $machine->capacity }}</p>
                            <p>Puissance: {{ $machine->power }}</p>
                            <p>Matériaux: {{ $machine->materials }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
