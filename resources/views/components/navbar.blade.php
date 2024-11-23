<!-- resources/views/components/navbar.blade.php -->
<div class="top-bar">
    <div class="nav__logo1">
    <div class="nav__header1">
        <button class="nav__toggle-btn" id="toggle-btn">☰</button>
    </div>
        <a href="{{ url('/') }}"><img src="{{ asset('images/aljisr.jpg') }}" alt="logo"></a>
    </div>
</div>
<nav class="main-nav">
    <ul class="nav__links1" id="nav-links1">
        <li><a href="{{ url('/') }}">ACCUEIL</a></li>
        <li><a href="{{ url('/events') }}">ATELIERS</a></li>
        <li><a href="https://fablab.aljisr.ma/" class="no-wrap">ABOUT US</a></li>
        <li><a href="{{ url('/calendar') }}" class="no-wrap">CALENDRIER</a></li>
        <li><a href="{{ url('/askus') }}">ASK-US</a></li>
        <li><a href="{{ url('/machine') }}" class="no-wrap">PARC MACHINE</a></li>
        <li><a href="{{ url('/contact') }}" class="no-wrap">CONTACT</a></li>
        <li>
            @if(Auth::check() && Auth::user()->is_admin)
                <a href="{{ route('event-admin.index') }}" class="no-wrap">ADMIN PANEL</a>
            @endif
        </li>
    </ul>   
</nav>

<script>
  document.getElementById('toggle-btn').addEventListener('click', function() {
    document.getElementById('nav-links1').classList.toggle('open');
});

let lastScrollTop = 0;
const navbar = document.querySelector('nav');
const navLinks = document.getElementById('nav-links1');

window.addEventListener('scroll', function() {
    let scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    if (scrollTop > lastScrollTop) {
        navbar.classList.add('hidden');
        navLinks.classList.remove('open'); // Close nav links on scroll down
    } else {
        navbar.classList.remove('hidden');
    }
    lastScrollTop = scrollTop;
});
</script>
