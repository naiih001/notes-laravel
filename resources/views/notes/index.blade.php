<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Notezilla') }} | My Vault</title>

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
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .note-card:hover {
            transform: translateY(-2px);
            border-color: var(--color-sage);
            box-shadow: 0 12px 30px -10px rgba(65, 54, 32, 0.08);
        }

        .btn-earth {
            background-color: var(--color-earth);
            color: var(--color-paper);
            transition: all 0.2s ease;
        }

        .btn-earth:hover {
            opacity: 0.9;
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
                <span class="text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] hidden md:inline">{{ auth()->user()->name ?? 'User' }}'s Vault // Active</span>
                <a href="{{ route('notes.create') }}" class="btn-earth px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"/></svg>
                    New Note
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] hover:text-[rgb(65,54,32)] transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Content Area -->
    <main class="flex-1 py-12 px-6">
        <div class="max-w-5xl mx-auto">
            
            <!-- Header Section -->
            <header class="mb-12">
                <div class="flex items-center space-x-3 mb-2">
                    <span class="h-px w-8 bg-[rgb(186,212,170)]"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-[rgb(135,151,175)]">Documentation Hub</span>
                </div>
                <h1 class="text-4xl font-black text-[rgb(65,54,32)] tracking-tight">My Notes</h1>
            </header>

            <!-- Notes Grid -->
            @forelse($notes as $note)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="note-card rounded-3xl p-8 flex flex-col h-full">
                        <div class="flex justify-between items-start mb-6">
                            <span class="px-3 py-1 bg-[rgb(186,212,170)]/20 text-[rgb(65,54,32)] text-[10px] font-black uppercase tracking-widest rounded-full">Note</span>
                            <span class="text-[10px] font-bold text-[rgb(135,151,175)] mono">{{ $note->created_at->format('d.m.Y') }}</span>
                        </div>
                        
                        <h2 class="text-xl font-black text-[rgb(65,54,32)] mb-3 tracking-tight">{{ $note->title }}</h2>
                        <p class="text-[rgb(135,151,175)] text-sm leading-relaxed mb-8 line-clamp-3">
                            {{ Str::limit(strip_tags($note->content), 150) }}
                        </p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex space-x-4">
                                <a href="{{ route('notes.show', $note) }}" class="text-[10px] font-black uppercase tracking-widest text-[rgb(65,54,32)] hover:text-[rgb(186,212,170)] transition-colors">View</a>
                                <a href="{{ route('notes.edit', $note) }}" class="text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] hover:text-[rgb(65,54,32)] transition-colors">Edit</a>
                            </div>
                            <form method="POST" action="{{ route('notes.destroy', $note) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this note?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-600 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-20 bg-white border-2 border-dashed border-slate-200 rounded-[2rem] text-center">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-[rgb(135,151,175)] font-bold mb-6">No notes found in this vault partition.</p>
                    <a href="{{ route('notes.create') }}" class="btn-earth px-8 py-3 rounded-xl text-sm font-black uppercase tracking-widest inline-block">
                        Initialize New Note
                    </a>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Footer -->
    <footer class="p-8 border-t border-[rgb(65,54,32)]/5">
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
