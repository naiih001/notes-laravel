<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Notezilla') }} | Secure Access</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --color-sage: rgb(186, 212, 170);
                --color-earth: rgb(65, 54, 32);
                --color-steel: rgb(135, 151, 175);
                --color-paper: #f9faf7;
            }
            body {
                font-family: 'Inter', sans-serif;
                background-color: var(--color-paper);
                color: var(--color-earth);
                overflow-x: hidden;
            }
            .mono { font-family: 'JetBrains Mono', monospace; }
            
            .hero-pattern {
                background-image: radial-gradient(var(--color-sage) 0.5px, transparent 0.5px);
                background-size: 24px 24px;
            }

            .login-card {
                box-shadow: 0 20px 50px -12px rgba(65, 54, 32, 0.1);
                border: 2px solid rgba(65, 54, 32, 0.05);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .input-field {
                background: white;
                border: 2px solid rgba(135, 151, 175, 0.2);
                transition: all 0.2s ease;
            }

            .input-field:focus {
                border-color: var(--color-sage);
                outline: none;
                box-shadow: 0 0 0 4px rgba(186, 212, 170, 0.2);
            }

            .btn-earth {
                background-color: var(--color-earth);
                color: var(--color-paper);
                transition: all 0.2s ease;
            }

            .btn-earth:hover {
                transform: translateY(-1px);
                opacity: 0.95;
            }

            .hidden { display: none; }
        </style>
    </head>
    <body class="selection:bg-[rgb(186,212,170)] selection:text-[rgb(65,54,32)] min-h-screen flex flex-col hero-pattern">

        <!-- Simple Nav -->
        <nav class="p-6">
            <div class="max-w-7xl mx-auto flex justify-between items-center">
                <a href="/" class="flex items-center space-x-2">
                    <div class="w-8 h-8 bg-[rgb(65,54,32)] rounded flex items-center justify-center">
                        <svg class="text-[rgb(186,212,170)] w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                    </div>
                    <span class="text-xl font-extrabold tracking-tight text-[rgb(65,54,32)]">notezilla</span>
                </a>
                <a href="/" class="text-sm font-bold text-[rgb(135,151,175)] hover:text-[rgb(65,54,32)] transition-colors">Back to Home</a>
            </div>
        </nav>

        <!-- Main Container -->
        <main class="flex-1 flex items-center justify-center px-6 pb-12">
            <div class="w-full max-w-md">
                {{ $slot }}

                <div class="mt-8 text-center mono">
                    <p class="text-[10px] text-[rgb(135,151,175)] font-bold uppercase tracking-[0.2em]">
                        Node: <span class="text-[rgb(186,212,170)]">Localhost</span> // Status: <span class="text-[rgb(186,212,170)]">Ready</span>
                    </p>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="p-8 text-center mt-auto">
            <div class="flex justify-center space-x-6 text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)]/40">
                <a href="#" class="hover:text-[rgb(65,54,32)] transition-colors">Privacy Policy</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-[rgb(65,54,32)] transition-colors">Terms of Service</a>
                <span>&bull;</span>
                <a href="#" class="hover:text-[rgb(65,54,32)] transition-colors">Security Manifest</a>
            </div>
        </footer>
    </body>
</html>
