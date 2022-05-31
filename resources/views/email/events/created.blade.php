<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>
<h2>Hi, new event has been created as below:</h2>
<p>Name: {{ $event->name }}</p>
<p>Slug: {{ $event->slug }}</p>
<p>Click <span><a href="{{ route('events.show', $event) }}">here</a> to view the details.</span></p>
</body>
</html>
