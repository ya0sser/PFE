<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pathway.css') }}">
    <link rel="stylesheet" href="{{ asset('css/card.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/remixicon@3.2.0/fonts/remixicon.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>{{ $event->title }} | Al-Jisr</title>
    <style>
        html {
            scroll-behavior: smooth;
        }
        .closed-event {
            color: red;
            font-weight: bold;
        }
        h1{
            color: black;
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

        /* Modal Custom CSS */
        .modal-header {
            background-color: #333;
            color: #fff;
        }
        .modal-content {
            border-radius: 15px;
            overflow: hidden;
        }
        .modal-body {
            padding: 20px;
        }
        .modal-footer {
            background-color: #f7f7f7;
            border-top: 1px solid #ddd;
        }
        .list-group-item {
            border: 1px solid #ddd;
            padding: 15px;
            background-color: #fff;
            margin-bottom: 10px;
            border-radius: 10px;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .list-group-item:hover {
            background-color: #f9f9f9;
            border-color: #ccc;
        }
        .list-group-item a {
            text-decoration: none;
            color: #333;
            display: block;
            width: 100%;
        }
        .list-group-item a:hover {
            color: #007bff;
        }
        .event-date {
    font-size: 1rem; /* Smaller font size */
    font-weight: bold;
    margin-right: 15px;
    display: inline-block;
}
.event-location {
    font-size: 0.9rem; /* Slightly smaller font size for consistency */
    color: #555;
}



.modal-header {
    background-color: #f8f9fa; /* Light header */
    color: #333; /* Dark text color */
    border-bottom: none; /* Remove bottom border */
    padding: 15px 20px; /* Padding for better spacing */
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    text-align: center; /* Centered text */
}
.modal-content {
    border-radius: 15px; /* Rounded corners */
    overflow: hidden;
    background-color: #fff; /* White background */
    color: #333; /* Dark text color */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1); /* Light drop shadow */
}
.modal-body {
    padding: 30px; 
}
.modal-footer {
    background-color: #f8f9fa; 
    border-top: none; 
    padding: 15px 20px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
    text-align: center; 
}
.modal-footer .btn {
    background-color: grey;
    color: #fff; 
    border-radius: 20px; 
    padding: 10px 20px; 
    transition: background-color 0.3s ease;
}
.modal-footer .btn:hover {
    background-color: black; 
}
.list-group-item {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    padding: 15px;
    border-radius: 10px;
    transition: all 0.3s ease;
    background-color: #ffffff;
    border: 1px solid #ddd;
    margin-bottom: 10px;
    border-bottom: 1px solid #ccc; 
}
.list-group-item:hover {
    background-color: #f1f1f1;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}
.list-group-item a {
    width: 100%;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: #333;
}
.list-group-item a .event-date {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 5px;
}
.list-group-item a .event-location {
    font-size: 1rem;
    color: #555;
}


        .new-date-btn {
    margin-left: 15px;
    font-size: 0.9rem;
    padding: 10px 20px; /* Slightly larger padding */
    background-color: #343a40; /* Dark background color */
    color: #fff; /* Text color */
    border: none;
    border-radius: 25px; /* Rounded corners */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transition */
    display: inline-block;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Subtle shadow */
    font-weight: bold; /* Bold text */
    text-transform: uppercase; /* Uppercase text */
    letter-spacing: 1px; /* Spacing between letters */
}
.new-date-btn:hover {
    background-color: #495057; /* Slightly lighter color on hover */
    transform: translateY(-2px); /* Slight lift effect on hover */
    color: #fff; /* Maintain text color on hover */
}




        @media (max-width: 768px) {
            .event-details {
                align-items: flex-start;
            }

            .new-date-btn {
                margin-top: 10px;
            }
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
        .closed-event {
    background-color: white;
    color: red;
    font-weight: bold;
    padding: 10px 20px;
    padding-right: 1px;
    border-radius: 5px;
    border: none;
    font-size: 20px;
    margin-top: 10px; 
    display: inline-block;
    }

    .closed-event:hover {
    background-color: white;
    color: red; 
    }

    </style>
</head>
<body>

    @include('components.navbar')

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

    <header>
        <section class="banner-wrapper">
            <div class="banner-content">
                <div class="banner-left">
                    <h2><span>{{ $event->title }}</span></h2>
                    <p>{{ $event->description }}</p>
                    @if(!$event->closed)
                    <br><button class="btn1" onclick="location.href='#orderSection'">S'inscrire</button>
                   @endif
                </div>
                <div class="banner-right">
                    <img src="{{ asset($event->image_path) }}" alt="Image of {{ $event->title }}" onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">
                </div>
            </div>
        </section>
    </header>

    <section>
        <div class="section__container">
            <div class="container">
                <h1>Heure et lieu</h1>
                <br>
                <div class="details-container">
                    <div class="event-details">
                        <p class="event-date">
                            <i class="far fa-calendar-alt"></i> 
                            {{ \Carbon\Carbon::parse($event->event_date)->locale('fr')->translatedFormat('d F Y, H:i') }} – 
                    {{ \Carbon\Carbon::parse($event->event_date)->addMinutes($event->duration)->locale('fr')->translatedFormat('H:i') }}
                            
                            @if($otherDates->isNotEmpty())
                            <button class="btn new-date-btn" data-bs-toggle="modal" data-bs-target="#otherDatesModal">Sélectionner une autre date</button>
                            @endif
                        </p>
                        <p class="event-location">
                            <i class="fas fa-map-marker-alt"></i> 
                            {{ $event->location }}
                        </p>
                    </div>
                </div>
                <br>
                <h1>Billets</h1> <br>
                <div class="ticket-section">
                    <div class="ticket-type">
                        <div><b>Type de billet</b></div>
                        <div><b>Prix</b></div>
                        <div><b>Quantité</b></div>
                    </div>
                    <div class="ticket-details">
                        <div class="badr">{{ $event->Type_de_billet }}</div>
                        <div class="badr">{{ number_format($event->price, 2) }} DH</div>
                        <div class="quant">
                            <select id="quantity">
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="total" id="orderSection">
                    <span>Total</span>
                    <span id="totalPrice">0,00 DH</span>
                </div>
                @if(auth()->check())
                @if($event->price > 0)
                    @if($isSubscribed)
                        <form id="unsubscribe-form" action="{{ route('events.unsubscribe', ['eventId' => $event->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="order-button">Annuler l'Inscription</button>
                        </form>
                    @else
                        <form id="subscribe-form" action="{{ route('components.payment.process', ['eventId' => $event->id]) }}" method="POST">
                            @csrf
                            @if(!$event->closed)
                                <button type="submit" class="order-button">Passer la commande</button>
                            @endif
                        </form>
                    @endif
                @else
                    @if($isSubscribed)
                        <form id="unsubscribe-form" action="{{ route('events.unsubscribe', ['eventId' => $event->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="order-button">Annuler l'Inscription</button>
                        </form>
                    @else
                        <form id="subscribe-form" action="{{ route('events.subscribe', ['eventId' => $event->id]) }}" method="POST">
                            @csrf
                            @if(!$event->closed)
                                <button type="submit" class="order-button">Subscribe</button>
                            @endif
                        </form>
                    @endif
                @endif
            @else
                @if(!$event->closed)
                    <button type="button" class="order-button" onclick="location.href='{{ route('subscribe.guest', ['eventId' => $event->id]) }}';">
                        Passer la commande
                    </button>
                @endif
            @endif
            
            
            
            </div>
        </div>
    </section>

    @if($otherDates->isNotEmpty())
    <div class="modal fade" id="otherDatesModal" tabindex="-1" aria-labelledby="otherDatesModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otherDatesModalLabel">Autres dates disponibles</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @foreach($otherDates as $otherEvent)
                        <li class="list-group-item">
                            <a href="{{ route('events.show', ['id' => $otherEvent->id]) }}">
                                <span class="event-date">{{ \Carbon\Carbon::parse($otherEvent->event_date)->locale('fr')->translatedFormat('d') }}</span>
                                <span class="event-date">{{ \Carbon\Carbon::parse($otherEvent->event_date)->locale('fr')->translatedFormat('M') }}</span>
                                <span class="event-location">{{ \Carbon\Carbon::parse($otherEvent->event_date)->locale('fr')->translatedFormat('Y, H:i') }} – {{ \Carbon\Carbon::parse($otherEvent->event_date)->addMinutes($otherEvent->duration)->format('H:i') }} - {{ $otherEvent->location }}</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                </div>
            </div>
        </div>
    </div>
    @endif

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
    

    @include('components.footer')

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Function to update total price
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
