<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-white uppercase tracking-wider">
            {{ __('Update Access Cipher') }}
        </h2>

        <p class="mt-2 text-sm text-zinc-400 font-semibold leading-relaxed">
            {{ __('Ensure your account is using a complex, randomized key configuration to guarantee network security containment.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <!-- Input Block: Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">
                {{ __('Current Cipher') }}
            </label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono transition duration-150 py-2.5 px-4" 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-400 font-bold uppercase tracking-wide" />
        </div>

        <!-- Input Block: New Password -->
        <div>
            <label for="update_password_password" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">
                {{ __('New Cipher Generation') }}
            </label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono transition duration-150 py-2.5 px-4" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-400 font-bold uppercase tracking-wide" />
        </div>

        <!-- Input Block: Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">
                {{ __('Confirm Cipher Signature') }}
            </label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono transition duration-150 py-2.5 px-4" 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-400 font-bold uppercase tracking-wide" />
        </div>

        <!-- Action Row -->
        <div class="flex items-center gap-4 pt-2">
            <button 
                type="submit" 
                class="rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 px-5 py-3 text-xs font-extrabold text-zinc-950 uppercase tracking-widest shadow-md transition duration-150"
            >
                {{ __('Commit Change') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold uppercase tracking-widest text-emerald-400"
                >
                    {{ __('Cipher Committed.') }}
                </p>
            @endif
        </div>
    </form>
</section>