<div class="item-container1">
    <div class="img-container1">
        <img src="{{ asset($event->image_path) }}" alt="Image of {{ $event->title }}" onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';">
    </div>
    <div class="body-container1">
        <div class="overlay1"></div>
        <div class="event-info1">
            @if ($event->hasMultipleDates())
                <p class="multi-dates-btn">Plusieurs Dates</p>
            @endif
            <p class="title1">{{ Str::limit($event->title, 17) }}</p>
            <div class="separator1"></div>
            <div class="additional-info">
                <p class="info1">
                    <i class="far fa-calendar-alt"></i> 
                    {{ \Carbon\Carbon::parse($event->event_date)->locale('fr')->translatedFormat('d F Y, H:i') }} – 
                    {{ \Carbon\Carbon::parse($event->event_date)->addMinutes($event->duration)->locale('fr')->translatedFormat('H:i') }}  
                </p> 
                <br>
            </div>
            @if ($event->closed)
                <p class="price1 closed-event">
                    Closed 
                </p>
            @endif
            <div class="additional-info1">
                <p class="info description">{{ Str::limit($event->description, 204) }}</p>
            </div>
        </div>
        <button class="action1"><a href="{{ route('events.show', $event->id) }}">S'inscrire</a></button>
    </div>
</div>
