<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calendar | Al-Jisr</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <style>
        body {
            flex-direction: column; 
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #dfdfdf;
        }
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'montserrat',sans-serif;
        }
        header{
            width:100%;
            position: relative;
            top:0%;
            padding-bottom:30px;
        }    
        #calendar {
            width: 100%; 
            margin: 0 auto;
            color: #000000;
        }
        .fc-day, .fc-day-top {
            cursor: pointer; 
        }
        .fc-event {
            border-color: #0056b3; 
            background-color: black; 
            color: white; 
            border: none; 
            font-size: 16px; 
            padding: 5px 10px; 
            border-radius: 5px; 
        }
        .fc {
            background-color: #dfdfdf;
        }
        .fc th, .fc td {
            border-color: #000000 !important; 
        }
        .fc-event {
            background-color: black; 
            color: white; 
            border: none;
            font-size: 16px; 
            padding: 5px 10px; 
            border-radius: 5px; 
        }
        a, a:hover, a:focus, a:visited {
            text-decoration: none !important;
            color: #000000; 
        }
    </style>
</head>
<body>
<header>
    @include('components.navbar')
</header>
<section id="calendar-section">
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-body">
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</section>

<script>
$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
        defaultView: 'month',
        eventLimit: true,
        navLinks: true,
        events: '/api/events',
    });

    // Scroll to the calendar section after a delay
    setTimeout(() => {
        const calendarSection = document.getElementById('calendar-section');
        if (calendarSection) {
            const offset = 50; // Adjust this value to scroll a bit higher or lower
            const bodyRect = document.body.getBoundingClientRect().top;
            const elementRect = calendarSection.getBoundingClientRect().top;
            const elementPosition = elementRect - bodyRect;
            const offsetPosition = elementPosition - offset;

            window.scrollTo({
                top: offsetPosition,
                behavior: 'smooth'
            });
        }
    }, 500); // Adjust the delay as needed
});
</script>
</body>
</html>
