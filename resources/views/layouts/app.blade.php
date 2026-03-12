<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Notes App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">
                    <a href="{{ route('notes.index') }}">Notes</a>
                </h1>
                <a href="{{ route('notes.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                    + New Note
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12">
        @if($message = Session::get('success'))
            <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
                {{ $message }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
