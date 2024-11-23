<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pathway.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>Edit {{ $event->title }} | Al-Jisr</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
        nav {
            font-family: 'Montserrat', sans-serif;
        }
        .closed-event {
            color: red;
            font-weight: bold;
        }
        .alert {
            position: relative;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: 0.25rem;
            top: 10px;
            right: 10px;
            width: 90%;
        }
        .alert-success {
            color: #0f5132;
            background-color: #d1e7dd;
            border-color: #badbcc;
        }
        .alert-info {
            color: #055160;
            background-color: #cff4fc;
            border-color: #b6effb;
        }
        .alert button {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.5rem;
            border: none;
            background: none;
            color: inherit;
            font-size: 1.5rem;
        }
        .btn1 {
            height: 70px;
            margin-top: 20px;
            margin-left: 850px;
            background: #222;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: .3s;
            color: white;
            padding: 0 30px;
        }
        .banner-content {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }
        .banner-left, .banner-right {
            display: flex;
            flex-direction: column;
        }
        .banner-left input, .banner-left textarea {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        .textarea-large {
            height: 300px;
            width: 100%;
            overflow: auto;
            resize: none;
        }
        .ticket-section {
            display: flex;
            flex-direction: column;
            width: 100%;
        }
        .ticket-type, .ticket-details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
            padding: 10px;
        }
        .ticket-details .form-control {
            width: auto;
            box-sizing: border-box;
        }
        .banner-content input,
        .banner-content textarea {
            border-radius: 10px;
        }

        body {
            line-height: 1.2;
            font-family: 'Poppins', sans-serif;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        .footer-col {
            width: 25%;
            padding: 0 15px;
        }

        .footer .container1 {
            display: flex !important;
            justify-content: space-between !important;
            width: 100% !important;
            max-width: 1200px !important;
        }
    </style>
</head>
<body>
    
    <nav>
        <div class="nav__header1">
            <div class="nav__logo1">
                <a href="{{ url('/') }}">Al'Jisr</a>
            </div>
        </div>
        <ul class="nav__links1" id="nav-links1">
            <li><a href="/events-admin">EVENTS</a></li>
            <li><a href="/admin/customers">CUSTOMERS</a></li>
            <li><a href="/user-event">USER EVENT</a></li>
            <li><a href="/admin/comments">COMMENTS</a></li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
            </li>
        </ul>
    </nav>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    <form action="{{ route('event-admin.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <header>
            <section class="banner-wrapper">
                <div class="banner-content">
                    <div class="banner-left">
                        <input type="text" name="title" value="{{ $event->title }}" class="form-control" style="font-size: 2em; font-weight: bold; color: #333;">
                        <textarea name="description" class="form-control textarea-large" rows="10">{{ $event->description }}</textarea>
                    </div>
                    <div class="banner-right">
                        <img src="{{ asset($event->image_path) }}" alt="Image of {{ $event->title }}" onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';"> <br>
                        <input type="file" name="image" class="form-control">
                    </div>
                </div>
            </section>
        </header>

        <section>
            <div class="section__container">
                <div class="container">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1>Heure et lieu</h1>
                    <br>
                    <div class="details-container">
                        Date de l'event : <input type="datetime-local" name="event_date" value="{{ $event->event_date->format('Y-m-d\TH:i') }}" class="form-control"> <br> <br>
                        Durée de l'event : <input type="number" name="duration" value="{{ $event->duration }}" class="form-control" placeholder="Duration (minutes)">
                        <br> <br>
                        Adresse de l'event : <input type="text" name="location" value="{{ $event->location }}" class="form-control"> <br>
                        <br>  Map URL : <input type="text" name="map_url" value="{{ $event->map_url }}" class="form-control"> <!-- Add map_url field -->
                    </div>
                    <br>
                    <h1>Billets</h1> <br>
                    <div class="ticket-section">
                        <div class="ticket-type">
                            <div><b>Type de billet</b></div>
                            <div><b>Prix</b></div>
                            <div><b>Quantité</b></div>
                            <div><b>Max Subscribers</b></div>
                        </div>
                        <div class="ticket-details">
                            <input type="text" name="Type_de_billet" value="{{ $event->Type_de_billet }}" class="form-control" style="width: 160px;">
                            <input type="text" name="price" value="{{ number_format($event->price, 2) }}" class="form-control" style="width: 80px;">
                            <select id="quantity" name="quantity" class="form-control" style="width: 80px;">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <input type="number" name="max_subscribers" value="{{ $event->max_subscribers }}" class="form-control" style="width: 80px;">
                        </div>
                    </div>
                    <div class="total" id="orderSection">
                        <span>Total</span>
                        <button class="btn1">Save Changes</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="map">
            <div>
                <h1>Lieu</h1>
                    <iframe
                    width="1000"
                    height="500"
                    style="border:2rem;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    src="{{ $event->map_url }}">
                </iframe>
            </div>
        </section>
    </form>
    
    @include('components.footer')

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            function updateTotalPrice() {
                var quantity = parseInt(document.getElementById("quantity").value);
                var pricePerTicket = parseFloat('{{ $event->price }}');
                var totalPrice = quantity * pricePerTicket;
                document.getElementById("totalPrice").textContent = totalPrice.toFixed(2) + ' DH';
            }

            document.getElementById("quantity").addEventListener("change", function() {
                updateTotalPrice();
            });
            updateTotalPrice();
        });
    </script>
</body>
</html>
