<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notezilla | Clean Engineering Notes</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --color-sage: rgb(186, 212, 170);
            --color-earth: rgb(65, 54, 32);
            --color-steel: rgb(135, 151, 175);
            --color-sage-light: rgba(186, 212, 170, 0.15);
            --color-paper: #f9faf7;
        }
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
            background-color: var(--color-paper);
            color: var(--color-earth);
        }
        .mono { font-family: 'JetBrains Mono', monospace; }
        
        .text-sage { color: var(--color-sage); }
        .text-earth { color: var(--color-earth); }
        .text-steel { color: var(--color-steel); }
        
        .bg-sage { background-color: var(--color-sage); }
        .bg-earth { background-color: var(--color-earth); }
        .bg-steel { background-color: var(--color-steel); }
        .bg-paper { background-color: var(--color-paper); }

        .border-steel-subtle { border-color: rgba(135, 151, 175, 0.2); }

        .nav-glass {
            background: rgba(249, 250, 247, 0.8);
            backdrop-filter: blur(10px);
        }

        .hero-pattern {
            background-image: radial-gradient(var(--color-sage) 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            background-position: center;
        }

        .editor-shadow {
            box-shadow: 0 20px 50px -12px rgba(65, 54, 32, 0.15);
        }

        .btn-earth {
            background-color: var(--color-earth);
            color: var(--color-paper);
            transition: all 0.2s ease;
        }
        .btn-earth:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(65, 54, 32, 0.2);
        }
    </style>
</head>
<body class="selection:bg-[rgb(186,212,170)] selection:text-[rgb(65,54,32)]">
    <!-- Nav -->
    <nav id="navbar" class="fixed w-full z-50 transition-all duration-300 py-6">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-earth rounded flex items-center justify-center">
                    <svg class="text-sage w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="text-xl font-extrabold tracking-tight text-earth">notezilla</span>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-sm font-bold text-steel">
                <a href="#features" class="hover:text-earth transition-colors">Documentation</a>
                <a href="#preview" class="hover:text-earth transition-colors">Manifesto</a>
                @auth
                    <a href="{{ route('notes.index') }}" class="btn-earth px-6 py-2 rounded-lg text-sm">My Notes</a>
                @else
                    <a href="{{ route('register') }}" class="btn-earth px-6 py-2 rounded-lg text-sm">Download</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <main class="hero-pattern pt-32">
        <section class="max-w-7xl mx-auto px-6 pt-16 pb-24 text-center">
            <div class="inline-block px-4 py-1.5 rounded-full bg-sage/20 border border-sage/40 text-earth text-xs font-bold uppercase tracking-widest mb-6">
                Optimized for Engineers & Developers
            </div>
            <h1 class="text-6xl md:text-8xl font-black tracking-tighter text-earth mb-8 leading-[0.9]">
                THINK IN <span class="text-steel">STEEL.</span><br>WRITE ON <span class="text-sage">SAGE.</span>
            </h1>
            <p class="text-xl text-steel max-w-2xl mx-auto mb-12 font-medium leading-relaxed">
                The local-first markdown editor for engineers who value speed over decoration. Notezilla is the companion your terminal has been waiting for.
            </p>

            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                @auth
                    <a href="{{ route('notes.create') }}" class="btn-earth px-10 py-4 rounded-xl font-bold text-lg w-full sm:w-auto">Create Note</a>
                    <a href="{{ route('notes.index') }}" class="bg-sage/30 text-earth border border-sage/50 px-10 py-4 rounded-xl font-bold text-lg hover:bg-sage/50 transition-all w-full sm:w-auto">View My Notes</a>
                @else
                    <button class="btn-earth px-10 py-4 rounded-xl font-bold text-lg w-full sm:w-auto" onclick="window.location.href='{{ route('register') }}'">Get Started Free</button>
                    <a href="{{ route('login') }}" class="bg-sage/30 text-earth border border-sage/50 px-10 py-4 rounded-xl font-bold text-lg hover:bg-sage/50 transition-all w-full sm:w-auto">Read the Docs</a>
                @endauth
            </div>

            <!-- Editor Preview -->
            <div id="preview" class="mt-24 max-w-5xl mx-auto px-2">
                <div class="bg-white border-2 border-earth/10 rounded-2xl overflow-hidden editor-shadow text-left">
                    <div class="bg-[#f1f3ef] border-b-2 border-earth/5 px-4 py-3 flex justify-between items-center">
                        <div class="flex space-x-2">
                            <div class="w-3 h-3 rounded-full bg-earth/20"></div>
                            <div class="w-3 h-3 rounded-full bg-earth/20"></div>
                            <div class="w-3 h-3 rounded-full bg-earth/20"></div>
                        </div>
                        <div class="text-[10px] font-bold uppercase tracking-widest text-steel mono">~/documents/projects/web3-bridge.md</div>
                        <div class="flex items-center space-x-2 text-steel">
                            <span class="text-[10px] mono">Helix Mode</span>
                        </div>
                    </div>
                    <div class="flex h-[450px]">
                        <div class="w-48 bg-[#f9faf7] border-r-2 border-earth/5 p-4 hidden md:block">
                            <div class="text-[10px] font-black text-steel/50 uppercase mb-4">Tree</div>
                            <ul class="space-y-2 text-xs font-bold text-steel">
                                <li class="text-earth bg-sage/20 p-2 rounded">01_intro.md</li>
                                <li class="p-2 opacity-60">02_smart_contracts.rs</li>
                                <li class="p-2 opacity-60">03_deployment.sh</li>
                            </ul>
                        </div>

                        <div class="flex-1 p-8 mono text-sm overflow-y-auto bg-white">
                            <div class="mb-4">
                                <span class="text-steel">1</span> <span class="text-earth font-bold"># Notezilla Bridge Protocol</span><br>
                                <span class="text-steel">2</span><br>
                                <span class="text-steel">3</span> <span class="text-steel">## Abstract</span><br>
                                <span class="text-steel">4</span> <span class="text-earth/70">Integrating Web3 storage layers with local Markdown files.</span><br>
                                <span class="text-steel">5</span><br>
                                <span class="text-steel">6</span> <span class="bg-sage/30 text-earth font-bold px-1 italic">Important: Ensure AES keys are rotated monthly.</span><br>
                                <span class="text-steel">7</span><br>
                                <span class="text-steel">8</span> <span class="text-steel">```rust</span><br>
                                <span class="text-steel">9</span> <span class="text-earth">pub fn sync_layer(data: Vec<u8>) -> Result<(), Error> {</span><br>
                                <span class="text-steel">10</span> <span class="text-earth">&nbsp;&nbsp;&nbsp;&nbsp;let hash = keccak256(data);</span><br>
                                <span class="text-steel">11</span> <span class="text-earth">&nbsp;&nbsp;&nbsp;&nbsp;commit_to_chain(hash)</span><br>
                                <span class="text-steel">12</span> <span class="text-earth">}</span><br>
                                <span class="text-steel">13</span> <span class="text-steel">```</span><br>
                                <span class="text-steel">14</span> <span class="border-l-4 border-sage pl-4 py-1 text-steel italic">"Complexity is the enemy of security."</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Features Section -->
    <section id="features" class="py-24 bg-white border-y-2 border-earth/5">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-sage rounded-xl flex items-center justify-center text-earth">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-earth">Engineered for Devs</h3>
                    <p class="text-steel font-medium">Native Vim and Helix keybindings built-in. No plugins required. Just pure speed.</p>
                </div>
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-steel rounded-xl flex items-center justify-center text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-earth">Web3 Ready</h3>
                    <p class="text-steel font-medium">Optionally sync your notes to IPFS or Arweave for permanent, decentralized documentation.</p>
                </div>
                <div class="space-y-4">
                    <div class="w-12 h-12 bg-sage/40 rounded-xl flex items-center justify-center text-earth">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-xl font-black text-earth">Distraction Zero</h3>
                    <p class="text-steel font-medium">No accounts, no banners, no tracking. Just you, your markdown, and your terminal.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 px-6 bg-paper">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center border-t-2 border-earth/5 pt-12">
            <div class="flex items-center space-x-2 mb-4 md:mb-0">
                <div class="w-6 h-6 bg-earth rounded flex items-center justify-center">
                    <svg class="text-sage w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"/></svg>
                </div>
                <span class="font-black text-earth">notezilla</span>
            </div>
            <div class="text-steel text-sm font-bold">
                &copy; 2026 Built for the future of engineering.
            </div>
            <div class="flex space-x-8 text-sm font-black text-steel mt-4 md:mt-0">
                <a href="#" class="hover:text-earth">GitHub</a>
                <a href="#" class="hover:text-earth">Linux Build</a>
                <a href="#" class="hover:text-earth">CLI</a>
            </div>
        </div>
    </footer>

    <script>
        const nav = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                nav.classList.add('nav-glass', 'border-b-2', 'border-earth/5', 'py-4');
                nav.classList.remove('py-6');
            } else {
                nav.classList.remove('nav-glass', 'border-b-2', 'border-earth/5', 'py-4');
                nav.classList.add('py-6');
            }
        });
    </script>
</body>
</html>
</body>
</html>
