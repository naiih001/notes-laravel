<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Home </title>
</head>
<body>
    <a href="{{ url('notes/create') }}">Add note</a>
    @foreach($notes as $note)
        <h2>{{ $note->title }}</h2>
        <p>{{ $note->content }}</p>
    @endforeach
</body>
</html>