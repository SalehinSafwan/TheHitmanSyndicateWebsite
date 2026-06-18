<x-guest-layout>
    <div class="mb-6 rounded-2xl bg-gradient-to-br from-zinc-950 via-zinc-900 to-amber-950 px-6 py-6 text-white shadow-xl shadow-black/20">
        <p class="text-xs uppercase tracking-[0.35em] text-amber-300/80">The Hitman's Syndicate</p>
        <h1 class="mt-2 text-2xl font-semibold">Request membership</h1>
        <p class="mt-2 text-sm text-zinc-300">Every operative starts with an application. Submit your codename, referral, and answer the Continental checks.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="codename" :value="__('Codename')" />
                <x-text-input id="codename" class="block mt-1 w-full" type="text" name="codename" :value="old('codename')" required autofocus autocomplete="off" />
                <x-input-error :messages="$errors->get('codename')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="specialty" :value="__('Specialty Gear / Skill')" />
                <x-text-input id="specialty" class="block mt-1 w-full" type="text" name="specialty" :value="old('specialty')" required autocomplete="off" />
                <x-input-error :messages="$errors->get('specialty')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="referral_codename" :value="__('Referral Codename')" />
                <x-text-input id="referral_codename" class="block mt-1 w-full" type="text" name="referral_codename" :value="old('referral_codename')" required />
                <x-input-error :messages="$errors->get('referral_codename')" class="mt-2" />
            </div>
        </div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div>
                <x-input-label for="currency_answer" :value="__('1. What currency is used to pay for syndicate services?')" />
                <select id="currency_answer" name="currency_answer" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Choose one</option>
                    <option value="Gold coins" @selected(old('currency_answer') === 'Gold coins')>Gold coins</option>
                </select>
                <x-input-error :messages="$errors->get('currency_answer')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="hotel_rule_answer" :value="__('2. What rule must never be broken inside the Continental Hotel?')" />
                <select id="hotel_rule_answer" name="hotel_rule_answer" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Choose one</option>
                    <option value="No business on continental grounds" @selected(old('hotel_rule_answer') === 'No business on continental grounds')>No business on continental grounds</option>
                </select>
                <x-input-error :messages="$errors->get('hotel_rule_answer')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="best_weapon_answer" :value="__('3. What is considered the best weapon?')" />
                <select id="best_weapon_answer" name="best_weapon_answer" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Choose one</option>
                    <option value="Fiber wire" @selected(old('best_weapon_answer') === 'Fiber wire')>Fiber wire</option>
                </select>
                <x-input-error :messages="$errors->get('best_weapon_answer')" class="mt-2" />
            </div>
        </div>

        <div>
            <x-input-label for="motivation" :value="__('Why do you want to be here?')" />
            <textarea id="motivation" name="motivation" rows="5" class="mt-1 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('motivation') }}</textarea>
            <x-input-error :messages="$errors->get('motivation')" class="mt-2" />
        </div>

        <div class="grid gap-4 sm:grid-cols-2">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <div class="flex items-center justify-between pt-2">
            <a class="text-sm text-gray-600 underline-offset-4 hover:underline dark:text-gray-400" href="{{ route('login') }}">
                {{ __('Already approved? Log in instead.') }}
            </a>

            <x-primary-button>
                {{ __('Submit application') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
