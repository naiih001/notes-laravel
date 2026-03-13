<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes App - Simple Note Taking</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-b from-blue-50 to-white">
    <nav class="bg-white shadow-sm">
        <div class="max-w-4xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">
                    Notes
                </h1>
                <div class="flex gap-4">
                    @auth
                        <a href="{{ route('notes.index') }}" class="text-gray-700 hover:text-gray-900 font-medium">
                            My Notes
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-gray-900 font-medium">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-gray-900 font-medium">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-20">
        <div class="text-center">
            <h2 class="text-5xl font-bold text-gray-900 mb-6">
                Your Notes, <span class="text-blue-600">Simplified</span>
            </h2>
            
            <p class="text-xl text-gray-600 mb-12 max-w-2xl mx-auto">
                A clean, simple way to capture your thoughts and ideas. Create, edit, and organize your notes with ease.
            </p>

            @auth
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('notes.index') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition text-lg">
                        View My Notes
                    </a>
                    <a href="{{ route('notes.create') }}" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-medium py-3 px-8 rounded-lg transition text-lg">
                        Create New Note
                    </a>
                </div>
            @else
                <div class="flex gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-lg transition text-lg">
                        Get Started - Register
                    </a>
                    <a href="{{ route('login') }}" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-50 font-medium py-3 px-8 rounded-lg transition text-lg">
                        Login
                    </a>
                </div>
            @endauth

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-20">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                    <div class="text-3xl mb-4">✍️</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Create Easily</h3>
                    <p class="text-gray-600">Write down your thoughts with a simple and intuitive interface.</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                    <div class="text-3xl mb-4">📝</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Edit Anytime</h3>
                    <p class="text-gray-600">Update your notes whenever you need to add more details.</p>
                </div>
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                    <div class="text-3xl mb-4">🔐</div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Secure & Private</h3>
                    <p class="text-gray-600">Your notes are private and only accessible to you.</p>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-gray-50 border-t border-gray-200 mt-20">
        <div class="max-w-4xl mx-auto px-6 py-8">
            <p class="text-center text-gray-600">
                © 2026 Notes App. A simple note-taking application.
            </p>
        </div>
    </footer>
</body>
</html>
