<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Form -->
    <div class="bg-white rounded-3xl p-8 md:p-10 login-card">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-black tracking-tight text-[rgb(65,54,32)] mb-2">Welcome Back, Zeke.</h1>
            <p class="text-[rgb(135,151,175)] font-medium text-sm">Initialize your secure session.</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] mb-2 ml-1">Email Address</label>
                <input 
                    id="email"
                    type="email" 
                    placeholder="zeke@notezilla.io" 
                    name="email"
                    :value="old('email')"
                    required
                    autofocus
                    autocomplete="username"
                    class="w-full px-4 py-3.5 rounded-xl input-field font-medium text-[rgb(65,54,32)] text-sm"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex justify-between items-center mb-2 ml-1">
                    <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)]">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[9px] font-black uppercase tracking-widest text-[rgb(186,212,170)] hover:text-[rgb(65,54,32)] transition-colors">Forgot Key?</a>
                    @endif
                </div>
                <input 
                    id="password"
                    type="password" 
                    placeholder="••••••••" 
                    name="password"
                    required
                    autocomplete="current-password"
                    class="w-full px-4 py-3.5 rounded-xl input-field font-medium text-[rgb(65,54,32)] text-sm"
                />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <input 
                    id="remember_me" 
                    type="checkbox" 
                    class="rounded border-[rgb(135,151,175)] text-[rgb(186,212,170)] focus:ring-[rgb(186,212,170)] w-4 h-4" 
                    name="remember"
                />
                <label for="remember_me" class="ms-2 text-sm text-[rgb(135,151,175)]">
                    {{ __('Remember me') }}
                </label>
            </div>

            <button type="submit" class="w-full py-4 rounded-xl btn-earth font-bold text-md shadow-lg">
                Sign In
            </button>
        </form>

        <div class="mt-8 pt-8 border-t border-slate-100 space-y-4">
            <button type="button" class="w-full py-3.5 rounded-xl bg-white border-2 border-slate-100 flex items-center justify-center space-x-3 hover:bg-slate-50 transition-all">
                <svg class="w-4 h-4" viewBox="0 0 24 24"><path fill="currentColor" d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                <span class="text-xs font-bold text-[rgb(135,151,175)]">Authenticate via GitHub</span>
            </button>

            <p class="text-center text-[11px] font-bold text-[rgb(135,151,175)]/60">
                New to Notezilla? <a href="{{ route('register') }}" class="text-[rgb(65,54,32)] hover:underline underline-offset-4">Initialize Vault</a>
            </p>
        </div>
    </div>
</x-guest-layout>
