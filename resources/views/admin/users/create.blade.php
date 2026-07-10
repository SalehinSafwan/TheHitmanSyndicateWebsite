<x-app-layout>
    <!-- Header Block Overrides -->
    <x-slot name="header">
        <h2 class="font-black text-xl text-white uppercase tracking-wider leading-tight">
            {{ __('Create Syndicate Account') }}
        </h2>
    </x-slot>

    <div class="py-12 relative min-h-[calc(100vh-65px)] overflow-hidden">
        
        <!-- Large Logo Watermark Background -->
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.12] select-none pointer-events-none z-0">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-[600px] h-[600px] object-contain scale-110 blur-[2px]" />
        </div>

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 relative z-10">
            
            <!-- Main Terminal Form Card -->
            <div class="overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl p-6 sm:p-8">
                
                <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-6">
                    @csrf

                    <!-- Grid Block 1: Codename & Specialty -->
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="codename" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Codename</label>
                            <input id="codename" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono placeholder-zinc-700 transition duration-150 py-2.5 px-4" type="text" name="codename" :value="old('codename')" required placeholder="e.g. Ghost" />
                            <x-input-error :messages="$errors->get('codename')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label for="specialty" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Specialty</label>
                            <input id="specialty" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-semibold placeholder-zinc-700 transition duration-150 py-2.5 px-4" type="text" name="specialty" :value="old('specialty')" required placeholder="e.g. Infiltration" />
                            <x-input-error :messages="$errors->get('specialty')" class="mt-2 text-xs text-red-400" />
                        </div>
                    </div>

                    <!-- Grid Block 2: Dynamic Role Choice Dropdown & Email Address -->
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="role" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Security Authorization Role</label>
                            <div class="relative">
                                <select id="role" name="role" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-zinc-300 font-bold uppercase tracking-wider transition duration-150 py-2.5 px-4 appearance-none cursor-pointer">
                                    <option value="Hitman" @selected(old('role') === 'Hitman')>Hitman</option>
                                    <option value="Staff" @selected(old('role') === 'Staff')>Staff</option>
                                    <option value="Admin" @selected(old('role') === 'Admin')>Admin</option>
                                </select>
                            </div>
                            <x-input-error :messages="$errors->get('role')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Secure Email Address</label>
                            <input id="email" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono placeholder-zinc-700 transition duration-150 py-2.5 px-4" type="email" name="email" :value="old('email')" required placeholder="agent@syndicate.net" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-xs text-red-400" />
                        </div>
                    </div>

                    <div class="h-[1px] bg-gradient-to-r from-transparent via-zinc-800 to-transparent my-2"></div>

                    <!-- Grid Block 3: Passwords -->
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="password" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Access Password</label>
                            <input id="password" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono transition duration-150 py-2.5 px-4" type="password" name="password" required />
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Confirm Cipher Key</label>
                            <input id="password_confirmation" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono transition duration-150 py-2.5 px-4" type="password" name="password_confirmation" required />
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-xs text-red-400" />
                        </div>
                    </div>

                    <!-- Action Triggers Footer Row -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-zinc-850">
                        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-white transition duration-150">
                            Abort Operation
                        </a>
                        <button type="submit" class="rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 px-5 py-3 text-xs font-extrabold text-zinc-950 uppercase tracking-widest shadow-md transition duration-150">
                            Initialize Account
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>