<x-app-layout>
    <!-- Header Block Overrides -->
    <x-slot name="header">
        <h2 class="font-black text-xl text-white uppercase tracking-wider leading-tight">
            {{ __('Operative Profile Dossier') }}
        </h2>
    </x-slot>

    <div class="py-12 relative min-h-[calc(100vh-65px)] overflow-hidden">
        
        <!-- Large Logo Watermark Background -->
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.12] select-none pointer-events-none z-0">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-[600px] h-[600px] object-contain scale-110 blur-[2px]" />
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-6">
            
            <!-- Section 1: Update Profile Details -->
            <div class="overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Section 2: Change Access Cipher (Password) -->
            <div class="overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl p-6 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Section 3: Permanent Account Liquidation -->
            <div class="overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl p-6 sm:p-8 layer-purge-border">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>