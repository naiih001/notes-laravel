<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Notezilla') }} | Create Note</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    
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

        .note-card {
            background: white;
            border: 2px solid rgba(65, 54, 32, 0.05);
            box-shadow: 0 20px 50px -12px rgba(65, 54, 32, 0.05);
        }

        .input-field {
            background: white;
            border: 2px solid rgba(135, 151, 175, 0.15);
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
            opacity: 0.95;
            transform: translateY(-1px);
        }

        .btn-outline {
            border: 2px solid rgba(135, 151, 175, 0.2);
            color: var(--color-steel);
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            border-color: var(--color-earth);
            color: var(--color-earth);
        }

        ::placeholder {
            color: var(--color-steel);
            opacity: 0.5;
        }
    </style>
</head>
<body class="selection:bg-[rgb(186,212,170)] selection:text-[rgb(65,54,32)] min-h-screen flex flex-col hero-pattern">

    <!-- Global Navigation -->
    <nav class="p-6 border-b border-[rgb(65,54,32)]/5 bg-white/50 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="/" class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-[rgb(65,54,32)] rounded flex items-center justify-center">
                    <svg class="text-[rgb(186,212,170)] w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-[rgb(65,54,32)]">notezilla</span>
            </a>
            
            <div class="flex items-center space-x-6">
                <span class="text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] hidden md:inline">{{ auth()->user()->name ?? 'User' }}'s Vault // Write Mode</span>
                <a href="{{ route('notes.index') }}" class="text-sm font-bold text-[rgb(135,151,175)] hover:text-[rgb(65,54,32)] transition-colors">Cancel</a>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="flex-1 py-12 px-6">
        <div class="max-w-3xl mx-auto">
            
            <!-- Header Section -->
            <header class="mb-10">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="h-px w-8 bg-[rgb(186,212,170)]"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[rgb(135,151,175)]">Commit to Vault</span>
                </div>
                <h1 class="text-4xl font-black text-[rgb(65,54,32)] tracking-tight">Create Note</h1>
            </header>

            <div class="note-card rounded-[2.5rem] p-8 md:p-12">
                
                <!-- Error State -->
                @if ($errors->any())
                    <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-400 rounded-r-xl">
                        <div class="flex items-center mb-2">
                            <svg class="w-4 h-4 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                            <p class="text-red-800 text-xs font-black uppercase tracking-widest">Validation Error</p>
                        </div>
                        <ul class="text-red-700 text-sm space-y-1 ml-6 list-disc font-medium">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('notes.store') }}" method="POST" class="space-y-8">
                    @csrf

                    <!-- Title Input -->
                    <div>
                        <label for="title" class="block text-[10px] font-black uppercase tracking-[0.2em] text-[rgb(135,151,175)] mb-3 ml-1">
                            Note Heading
                        </label>
                        <input 
                            type="text" 
                            id="title" 
                            name="title" 
                            placeholder="e.g. Protocol analysis for Web3 bridge..."
                            value="{{ old('title') }}"
                            class="w-full px-6 py-4 rounded-2xl input-field font-bold text-[rgb(65,54,32)] text-lg tracking-tight @error('title') border-red-500 @enderror"
                            required
                        >
                        @error('title')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content Input -->
                    <div>
                        <div class="flex justify-between items-center mb-3 ml-1">
                            <label for="content" class="block text-[10px] font-black uppercase tracking-[0.2em] text-[rgb(135,151,175)]">
                                Markdown Content
                            </label>
                            <span class="text-[9px] font-bold text-[rgb(186,212,170)] mono uppercase">Helix-compatible editor</span>
                        </div>
                        <textarea 
                            id="content" 
                            name="content" 
                            rows="12"
                            placeholder="Begin your documentation..."
                            class="w-full px-6 py-6 rounded-2xl input-field font-medium text-[rgb(65,54,32)] text-base leading-relaxed mono @error('content') border-red-500 @enderror"
                            required
                        >{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <button 
                            type="submit" 
                            class="flex-1 btn-earth py-4 rounded-2xl font-black uppercase tracking-widest text-sm shadow-xl flex items-center justify-center"
                        >
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Secure to Vault
                        </button>
                        <a 
                            href="{{ route('notes.index') }}"
                            class="btn-outline px-10 py-4 rounded-2xl font-black uppercase tracking-widest text-sm flex items-center justify-center"
                        >
                            Discard
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer Meta -->
            <div class="mt-8 text-center mono">
                <p class="text-[10px] text-[rgb(135,151,175)]/60 font-bold uppercase tracking-[0.2em]">
                    Buffer: <span class="text-[rgb(186,212,170)]">Encrypted</span> // Session: <span class="text-[rgb(186,212,170)]">Write-Only</span>
                </p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="p-8 border-t border-[rgb(65,54,32)]/5 mt-auto">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)]/40">
            <div class="mono">Notezilla v1.0.4-stable // {{ auth()->user()->name ?? 'User' }}</div>
            <div class="flex space-x-6">
                <a href="#" class="hover:text-[rgb(65,54,32)] transition-colors">Privacy</a>
                <a href="#" class="hover:text-[rgb(65,54,32)] transition-colors">Encryption Docs</a>
                <a href="#" class="hover:text-[rgb(65,54,32)] transition-colors">GitHub</a>
            </div>
        </div>
    </footer>

</body>
</html>
