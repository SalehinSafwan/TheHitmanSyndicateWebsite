<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-red-400 uppercase tracking-wider">
            {{ __('Emergency Profile Liquidation') }}
        </h2>

        <p class="mt-2 text-sm text-zinc-400 font-semibold leading-relaxed">
            {{ __('CRITICAL WARNING: Activating this routine permanently purges all network access signatures, database logs, and operational history from the Syndicate mainframe. This process is irreversible.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="rounded-lg bg-red-950/40 border border-red-900/40 px-4 py-2.5 text-xs font-extrabold text-red-400 uppercase tracking-widest shadow-md hover:bg-red-600 hover:text-white transition duration-150"
    >
        {{ __('Purge Dossier Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-zinc-950 border border-red-900/40 rounded-2xl shadow-2xl">
            @csrf
            @method('delete')

            <h2 class="text-lg font-black text-white uppercase tracking-wider">
                {{ __('Confirm Mainframe Identity Purge') }}
            </h2>

            <p class="mt-2 text-sm text-zinc-400 font-medium leading-relaxed">
                {{ __('Once executed, your entire clearance matrix will be destroyed. Enter your verification cipher password below to authorize immediate asset liquidation.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4 rounded-xl bg-zinc-900 border border-zinc-800 focus:border-red-500 focus:ring-red-500 text-white font-mono placeholder-zinc-700 transition duration-150 py-2.5 px-4"
                    placeholder="{{ __('Verification Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-400 font-bold uppercase tracking-wide" />
            </div>

            <div class="mt-6 flex justify-end gap-4 items-center">
                <button 
                    type="button"
                    x-on:click="$dispatch('close')" 
                    class="text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-white transition duration-150"
                >
                    {{ __('Abort Operation') }}
                </button>

                <button 
                    type="submit"
                    class="rounded-lg bg-gradient-to-r from-red-600 to-red-700 hover:from-red-500 hover:to-red-600 px-5 py-3 text-xs font-extrabold text-white uppercase tracking-widest shadow-md transition duration-150"
                >
                    {{ __('Authorize Purge') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>