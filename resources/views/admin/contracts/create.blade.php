<x-app-layout>
    <!-- Header Block Overrides -->
    <x-slot name="header">
        <h2 class="font-black text-xl text-white uppercase tracking-wider leading-tight">
            {{ __('Initialize Syndicate Operational Contract') }}
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
                
                <form method="POST" action="{{ route('admin.contracts.store') }}" class="space-y-6">
                    @csrf

                    <!-- Grid Block 1: Contract Title & Target Codename -->
                    <div class="grid gap-5 sm:grid-cols-2">
                        <div>
                            <label for="title" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Operation Title</label>
                            <input id="title" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white placeholder-zinc-700 transition duration-150 py-2.5 px-4" type="text" name="title" value="{{ old('title') }}" required placeholder="e.g. The Showstopper" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2 text-xs text-red-400" />
                        </div>

                        <div>
                            <label for="target" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Target Name / Codename</label>
                            <input id="target" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-white font-mono placeholder-zinc-700 transition duration-150 py-2.5 px-4" type="text" name="target" value="{{ old('target') }}" required placeholder="e.g. Viktor Novikov" />
                            <x-input-error :messages="$errors->get('target')" class="mt-2 text-xs text-red-400" />
                        </div>
                    </div>

                    <!-- Grid Block 2: Bounty Reward -->
                    <div>
                        <label for="bounty" class="block text-xs font-bold uppercase tracking-widest text-zinc-400 mb-2">Bounty reward (Gold Coins)</label>
                        <input id="bounty" class="block w-full rounded-xl bg-zinc-950 border border-zinc-850 focus:border-amber-500 focus:ring-amber-500 text-amber-400 font-mono font-bold transition duration-150 py-2.5 px-4" type="number" step="0.01" name="bounty" value="{{ old('bounty') }}" required placeholder="e.g. 15000" />
                        <x-input-error :messages="$errors->get('bounty')" class="mt-2 text-xs text-red-400" />
                    </div>

                    <!-- Action Triggers Footer Row -->
                    <div class="flex items-center justify-end gap-4 pt-4 border-t border-zinc-850">
                        <a href="{{ route('admin.users.index') }}" class="text-xs font-bold uppercase tracking-widest text-zinc-500 hover:text-white transition duration-150">
                            Abort Operation
                        </a>
                        <button type="submit" class="rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 px-5 py-3 text-xs font-extrabold text-zinc-950 uppercase tracking-widest shadow-md transition duration-150">
                            Deploy Contract
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
