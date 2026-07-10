<section class="space-y-6">
    <header>
        <h2 class="text-lg font-black text-white uppercase tracking-wider">
            {{ __('Identity Signature Matrix') }}
        </h2>

        <p class="mt-2 text-sm text-zinc-400 font-semibold leading-relaxed">
            {{ __("Modify your core network clearance parameters, active codename assignment, and routing email coordinates.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <!-- Input Block: Codename -->
        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">
                {{ __('Assigned Codename') }}
            </label>
            <input 
                id="codename" 
                name="codename" 
                type="text" 
                class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono placeholder-zinc-700 transition duration-150 py-2.5 px-4" 
                value="{{ old('name', $user->codename ?? $user->name) }}" 
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error class="mt-2 text-xs text-red-400 font-bold uppercase tracking-wide" :messages="$errors->get('name')" />
        </div>

        <!-- Input Block: Secure Email -->
        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">
                {{ __('Secure Communication Channel') }}
            </label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono placeholder-zinc-700 transition duration-150 py-2.5 px-4" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username" 
            />
            <x-input-error class="mt-2 text-xs text-red-400 font-bold uppercase tracking-wide" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 rounded-xl bg-amber-950/20 border border-amber-900/40 p-4">
                    <p class="text-xs font-bold uppercase tracking-wider text-amber-400">
                        {{ __('Security Warning: Communication link unverified.') }}
                    </p>
                    <button 
                        form="send-verification" 
                        class="mt-2 text-xs font-bold uppercase tracking-widest text-zinc-400 hover:text-white underline transition duration-150 block"
                    >
                        {{ __('Request Verification Dispatch Token') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-xs font-bold uppercase tracking-wide text-emerald-400">
                            {{ __('Verification token dispatched to current node.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Action Row -->
        <div class="flex items-center gap-4 pt-2">
            <button 
                type="submit" 
                class="rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 px-5 py-3 text-xs font-extrabold text-zinc-950 uppercase tracking-widest shadow-md transition duration-150"
            >
                {{ __('Commit Matrix Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-bold uppercase tracking-widest text-emerald-400"
                >
                    {{ __('Matrix Updated.') }}
                </p>
            @endif
        </div>
    </form>
</section>