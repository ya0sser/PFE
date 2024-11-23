<!DOCTYPE html>
<html>
<head>
    <title>Event Reminder</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>This is a reminder that the event <strong>{{ $event->title }}</strong> is happening on <strong>{{ $event->event_date->format('d M Y H:i') }}</strong>.</p>
    <p>Location: {{ $event->location }}</p>
    <p>We look forward to seeing you there!</p>
</body>
</html>