<x-guest-layout>
    <!-- Register Form -->
    <div class="bg-white rounded-3xl p-8 md:p-10 login-card">
        <div class="mb-8 text-center">
            <h1 class="text-3xl font-black tracking-tight text-[rgb(65,54,32)] mb-2">Create Vault</h1>
            <p class="text-[rgb(135,151,175)] font-medium text-sm">Establish your encrypted root identity.</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Full Name -->
            <div>
                <label for="name" class="block text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] mb-2 ml-1">Full Name</label>
                <input 
                    id="name"
                    type="text" 
                    placeholder="Zeke" 
                    name="name"
                    :value="old('name')"
                    required
                    autofocus
                    autocomplete="name"
                    class="w-full px-4 py-3.5 rounded-xl input-field font-medium text-[rgb(65,54,32)] text-sm"
                />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            
            <!-- Vault Name and Email -->
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="vault_name" class="block text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] mb-2 ml-1">Vault Name</label>
                    <input 
                        id="vault_name"
                        type="text" 
                        placeholder="primary-brain" 
                        name="vault_name"
                        :value="old('vault_name')"
                        class="w-full px-4 py-3.5 rounded-xl input-field font-medium text-[rgb(65,54,32)] text-sm mono"
                    />
                </div>

                <div>
                    <label for="email" class="block text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] mb-2 ml-1">Email</label>
                    <input 
                        id="email"
                        type="email" 
                        placeholder="zeke@dev.io" 
                        name="email"
                        :value="old('email')"
                        required
                        autocomplete="username"
                        class="w-full px-4 py-3.5 rounded-xl input-field font-medium text-[rgb(65,54,32)] text-sm"
                    />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] mb-2 ml-1">Master Password</label>
                <input 
                    id="password"
                    type="password" 
                    placeholder="••••••••" 
                    name="password"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-3.5 rounded-xl input-field font-medium text-[rgb(65,54,32)] text-sm"
                />
                <p class="mt-2 text-[9px] text-[rgb(135,151,175)]/60 italic font-medium px-1">This key generates your local AES-256 decryption seed. Cannot be recovered.</p>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-[10px] font-black uppercase tracking-widest text-[rgb(135,151,175)] mb-2 ml-1">Confirm Password</label>
                <input 
                    id="password_confirmation"
                    type="password" 
                    placeholder="••••••••" 
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="w-full px-4 py-3.5 rounded-xl input-field font-medium text-[rgb(65,54,32)] text-sm"
                />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Terms -->
            <div class="flex items-start space-x-3 py-2">
                <input 
                    id="terms" 
                    type="checkbox" 
                    name="terms"
                    required
                    class="mt-1 w-4 h-4 rounded border-[rgb(135,151,175)] text-[rgb(186,212,170)] focus:ring-[rgb(186,212,170)]"
                />
                <label for="terms" class="text-[10px] font-bold text-[rgb(135,151,175)] leading-tight">I understand that Notezilla is local-first. My data never leaves my machine unencrypted.</label>
            </div>

            <button type="submit" class="w-full py-4 rounded-xl btn-earth font-bold text-md shadow-lg">
                Initialize Secure Vault
            </button>
        </form>

        <div class="mt-8 text-center">
            <p class="text-[11px] font-bold text-[rgb(135,151,175)]/60">
                Already have a vault? <a href="{{ route('login') }}" class="text-[rgb(65,54,32)] hover:underline underline-offset-4">Sign In</a>
            </p>
        </div>
    </div>
</x-guest-layout>
