<x-guest-layout>
    <!-- Logo -->
    <div class="flex justify-center mb-8">
        <div class="relative group">
            <!-- Subtle ring glow behind logo -->
            <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-amber-600 to-amber-900 opacity-30 blur-md group-hover:opacity-50 transition duration-1000"></div>
            <img src="{{ asset('images/logo.png') }}" alt="Syndicate Logo" class="relative w-20 h-20 object-contain" />
        </div>
    </div>

    <!-- Banner -->
    <div class="w-full mb-8 rounded-2xl bg-gradient-to-b from-zinc-900 via-zinc-900 to-zinc-950 border border-zinc-800/80 p-8 sm:p-10 text-center shadow-2xl relative overflow-hidden">
        <!-- Accent line top border -->
        <div class="absolute top-0 left-0 right-0 h-[2px] bg-gradient-to-r from-transparent via-amber-500/50 to-transparent"></div>
        
        <p class="text-xs font-bold uppercase tracking-[0.4em] text-amber-500/90">The Hitman's Syndicate</p>
        <h1 class="mt-4 text-3xl sm:text-4xl font-black tracking-tight text-white uppercase">Request Membership</h1>
        <p class="mt-3 text-sm sm:text-base text-zinc-400 max-w-lg mx-auto leading-relaxed">
            Every operative starts with an application. Submit your credentials and secure referral to initiate onboarding.
        </p>
    </div>

    <!-- Registration Form -->
    <div class="w-full rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 p-6 sm:p-8 shadow-2xl">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Section Title -->
            <div class="border-b border-zinc-850 pb-3 mb-2">
                <h2 class="text-xs uppercase tracking-widest font-semibold text-zinc-500">Operative Profile</h2>
            </div>

            <!-- Row 1: Codename & Specialty -->
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="codename" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Codename</label>
                    <input id="codename" type="text" name="codename" value="{{ old('codename') }}" required autofocus autocomplete="off"
                        class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 placeholder-zinc-700 transition duration-200" 
                        placeholder="e.g., Agent 47" />
                    <x-input-error :messages="$errors->get('codename')" class="mt-1" />
                </div>

                <div>
                    <label for="specialty" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Specialty / Skill</label>
                    <input id="specialty" type="text" name="specialty" value="{{ old('specialty') }}" required autocomplete="off"
                        class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 placeholder-zinc-700 transition duration-200" 
                        placeholder="e.g., Infiltration" />
                    <x-input-error :messages="$errors->get('specialty')" class="mt-1" />
                </div>
            </div>

            <!-- Row 2: Secure Contact & Authorization -->
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="email" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Secure Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                        class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 placeholder-zinc-700 transition duration-200" 
                        placeholder="agency@secure.net" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <div>
                    <label for="referral_codename" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Referral Codename</label>
                    <input id="referral_codename" type="text" name="referral_codename" value="{{ old('referral_codename') }}" required
                        class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 placeholder-zinc-700 transition duration-200" 
                        placeholder="Active Member Name" />
                    <x-input-error :messages="$errors->get('referral_codename')" class="mt-1" />
                </div>
            </div>

            <!-- Section Title -->
            <div class="border-b border-zinc-850 pb-3 pt-2 mb-2">
                <h2 class="text-xs uppercase tracking-widest font-semibold text-zinc-500">Security Phrase</h2>
            </div>

            <!-- Row 3: Passwords -->
            <div class="grid gap-5 sm:grid-cols-2">
                <div>
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Access Password</label>
                    <input id="password" type="password" name="password" required autocomplete="new-password"
                        class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 placeholder-zinc-700 transition duration-200" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                        class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 placeholder-zinc-700 transition duration-200" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex flex-col sm:flex-row items-center justify-between pt-4 gap-4 border-t border-zinc-800/60">
                <a class="text-xs text-zinc-500 uppercase tracking-wider hover:text-amber-500 transition duration-200" href="{{ route('login') }}">
                    Already approved? <span class="underline underline-offset-4 decoration-amber-500/30 hover:decoration-amber-500">Log in</span>
                </a>

                <button type="submit" class="w-full sm:w-auto px-6 py-3 rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-zinc-950 text-xs font-extrabold uppercase tracking-widest shadow-lg shadow-amber-900/20 active:scale-95 transition duration-150">
                    Submit application
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>