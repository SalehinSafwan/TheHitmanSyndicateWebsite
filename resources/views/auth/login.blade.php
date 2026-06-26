<x-guest-layout>
    <!-- Logo -->
    <div class="flex justify-center mb-8">
        <div class="relative group">
            <!-- Subtle ring glow behind logo -->
            <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-amber-600 to-amber-900 opacity-30 blur-md group-hover:opacity-50 transition duration-1000"></div>
            <img src="{{ asset('images/logo.png') }}" alt="Syndicate Logo" class="relative w-20 h-20 object-contain" />
        </div>
    </div>

    <!-- Header Title Block -->
    <div class="w-full mb-6 text-center">
        <p class="text-xs font-bold uppercase tracking-[0.4em] text-amber-500/90">The Hitman's Syndicate</p>
        <h1 class="mt-3 text-2xl font-black tracking-tight text-white uppercase">Operative Authorization</h1>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-sm font-medium text-amber-500 bg-amber-950/30 border border-amber-800/50 p-3 rounded-lg text-center" :status="session('status')" />

    <!-- Tactical Login Card Container -->
    <div class="w-full max-w-md mx-auto rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 p-6 sm:p-8 shadow-2xl">
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Secure Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                    class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 placeholder-zinc-700 transition duration-200"
                    placeholder="agency@secure.net" />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between">
                    <label for="password" class="block text-xs font-bold uppercase tracking-wider text-zinc-400">Access Key</label>
                    @if (Route::has('password.request'))
                        <a class="text-[11px] text-zinc-500 uppercase tracking-wider hover:text-amber-500 transition duration-200" href="{{ route('password.request') }}">
                            {{ __('Forgot Key?') }}
                        </a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                    class="mt-1.5 block w-full rounded-lg bg-zinc-950 border border-zinc-800 text-zinc-200 focus:border-amber-500 focus:ring-1 focus:ring-amber-500/50 transition duration-200" />
                <x-input-error :messages="$errors->get('password')" class="mt-1" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center">
                <label for="remember_me" class="inline-flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox" name="remember" 
                        class="rounded bg-zinc-950 border-zinc-800 text-amber-600 shadow-sm focus:ring-amber-500/50 focus:ring-offset-zinc-900 focus:ring-1 bg-none checked:bg-amber-600 transition duration-150">
                    <span class="ms-2 text-xs uppercase tracking-wider text-zinc-500 select-none hover:text-zinc-400 transition duration-150">{{ __('Maintain Session') }}</span>
                </label>
            </div>

            <!-- Actions Wrapper -->
            <div class="pt-2 border-t border-zinc-800/60 flex flex-col gap-4">
                <button type="submit" class="w-full px-6 py-3 rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-zinc-950 text-xs font-extrabold uppercase tracking-widest shadow-lg shadow-amber-900/20 active:scale-95 transition duration-150">
                    Access
                </button>

                @if (Route::has('register'))
                    <div class="text-center">
                        <a class="text-xs text-zinc-500 uppercase tracking-wider hover:text-amber-500 transition duration-200" href="{{ route('register') }}">
                            New Operative? <span class="underline underline-offset-4 decoration-amber-500/30 hover:decoration-amber-500">Request Membership</span>
                        </a>
                    </div>
                @endif
            </div>
        </form>
    </div>
</x-guest-layout>