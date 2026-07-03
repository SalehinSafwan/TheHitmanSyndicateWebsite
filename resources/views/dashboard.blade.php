<x-app-layout>
    <!-- Header Block Overrides -->
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-black text-xl text-white uppercase tracking-wider">
                {{ __('Syndicate Network Terminal') }}
            </h2>
            <div class="flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[10px] uppercase tracking-widest text-zinc-500 font-bold">Secure Connection</span>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative min-h-[calc(100vh-65px)] overflow-hidden">
        
        <!-- Large Logo Watermark Background -->
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.12] select-none pointer-events-none z-0">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-[600px] h-[600px] object-contain scale-110 blur-[2px]" />
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10 space-y-6">
            
            <!-- Main Operative Dossier Card -->
            <div class="overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl">
                
                <!-- Card Header / Identity Block -->
                <div class="border-b border-zinc-800/60 px-6 py-6 sm:px-8 bg-gradient-to-r from-zinc-950 to-zinc-900 relative">
                    <div class="absolute top-0 left-0 right-0 h-[1px] bg-gradient-to-r from-transparent via-amber-500/30 to-transparent"></div>
                    
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="text-[10px] font-bold uppercase tracking-[0.4em] text-amber-500">Active Dossier</p>
                            <h3 class="mt-1.5 text-3xl font-black text-white uppercase tracking-tight">
                                Welcome, {{ auth()->user()->codename ?? auth()->user()->name }}
                            </h3>
                            @if(auth()->user()->referral_codename)
                                <p class="text-[10px] uppercase tracking-widest text-zinc-500 mt-1 font-semibold">
                                    Recruited By: <span class="text-zinc-400 font-mono">{{ auth()->user()->referral_codename }}</span>
                                </p>
                            @endif
                        </div>
                        <div class="flex flex-wrap gap-2 sm:self-center">
                            <span class="px-3 py-1 rounded-md bg-zinc-800 border border-zinc-700 text-xs font-bold uppercase tracking-wider text-zinc-300">
                                Role: {{ auth()->user()->role ?? 'Operative' }}
                            </span>
                            <span class="px-3 py-1 rounded-md bg-amber-950/40 border border-amber-800/40 text-xs font-bold uppercase tracking-wider text-amber-400">
                                Specialty: {{ auth()->user()->specialty ?? 'Unassigned' }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Main Content Grid -->
                <div class="grid gap-6 p-6 sm:p-8 md:grid-cols-2 bg-zinc-900/40">
                    
                    <!-- Box 1: Ledger Balance -->
                    <div class="rounded-xl bg-zinc-950 border border-zinc-850 p-5 flex flex-col justify-between group hover:border-zinc-800 transition duration-200">
                        <div>
                            <div class="flex items-center justify-between text-zinc-400">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    <h4 class="text-xs uppercase tracking-widest font-bold">Ledger Balance</h4>
                                </div>
                                <span class="text-[9px] uppercase tracking-wider bg-amber-950/30 text-amber-500 px-2 py-0.5 rounded border border-amber-900/40 font-mono">Secured</span>
                            </div>
                            <p class="mt-6 text-3xl font-black text-amber-400 tracking-tight font-mono">
                                {{ number_format($totalEarnings ?? 0) }} <span class="text-xs uppercase font-sans tracking-widest text-zinc-400 font-bold ml-1">Gold Coins</span>
                            </p>
                        </div>
                        <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center justify-between text-[10px] text-zinc-500 font-bold uppercase tracking-wider">
                            <span>Liquid Assets</span>
                            <span class="text-zinc-400 font-mono">Verified Bank array</span>
                        </div>
                    </div>

                    <!-- Box 2: System Settings / Override Management Terminal -->
                    @if (auth()->user()->role === 'Admin')
                        <div class="rounded-xl bg-zinc-950 border border-zinc-850 p-5 flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-2 text-zinc-400">
                                    <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"/></svg>
                                    <h4 class="text-xs uppercase tracking-widest font-bold">Management Terminal</h4>
                                </div>
                                <p class="mt-3 text-sm text-zinc-400 leading-relaxed">
                                    Systems overview active. You have override authority to authenticate pending applicants and reconfigure operative clearances.
                                </p>
                            </div>
                            
                            <div class="mt-5 flex flex-wrap gap-3 text-xs pt-3 border-t border-zinc-900">
                                <a href="{{ route('admin.applications.index') }}" class="flex-1 text-center px-4 py-2.5 rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 text-zinc-950 font-extrabold uppercase tracking-widest shadow-md transition duration-150">
                                    Pending Requests
                                </a>
                                <a href="{{ route('admin.users.index') }}" class="flex-1 text-center px-4 py-2.5 rounded-lg bg-zinc-900 border border-zinc-800 text-zinc-300 hover:text-white hover:bg-zinc-850 font-bold uppercase tracking-widest transition duration-150">
                                    User Registry
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="rounded-xl bg-zinc-950 border border-zinc-850 p-5 flex flex-col justify-between group hover:border-zinc-800 transition duration-200">
                            <div>
                                <div class="flex items-center gap-2 text-zinc-400">
                                    <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                    <h4 class="text-xs uppercase tracking-widest font-bold">Clearance Status</h4>
                                </div>
                                <p class="mt-3 text-sm text-zinc-400 leading-relaxed">
                                    Active network access requires full administrator vetting. Newly initiated applications are undergoing systematic background verification.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-zinc-900 flex items-center gap-2">
                                <span class="inline-block w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                <span class="text-[11px] uppercase tracking-wider text-amber-500/90 font-bold">Awaiting Admin Signature</span>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            <!-- Lower Layout Grid: Contracts & Announcements -->
            <div class="grid gap-6 md:grid-cols-3">
                
                <!-- Contracts Section (Spans 2 columns) -->
                <div class="md:col-span-2 overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center gap-2 pb-4 border-b border-zinc-800/60 mb-4">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            <h3 class="text-xl font-black text-white uppercase tracking-widest">Active Operations</h3>
                        </div>

                        <div class="space-y-3 max-h-[280px] overflow-y-auto pr-1">
                            @forelse($contracts as $contract)
                                <div class="group/item flex items-center justify-between p-3.5 rounded-xl bg-zinc-950 border border-zinc-850 hover:border-zinc-800 transition duration-150">
                                    <div>
                                        <p class="font-bold text-sm text-zinc-200 group-hover/item:text-white transition duration-100">{{ $contract->title }}</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-[10px] uppercase font-bold tracking-wider {{ $contract->status === 'active' || $contract->status === 'completed' ? 'text-emerald-500' : 'text-amber-500' }}">
                                                {{ $contract->status }}
                                            </span>
                                        </div>
                                    </div>
                                    <a href="{{ route('contracts.show', $contract->id) }}" class="px-3 py-1.5 text-[10px] font-bold uppercase tracking-widest text-amber-500 bg-amber-950/20 border border-amber-900/30 rounded-md hover:bg-amber-500 hover:text-zinc-950 transition duration-150">
                                        Decrypt Dossier
                                    </a>
                                </div>
                            @empty
                                <div class="text-center py-8 border border-dashed border-zinc-800 rounded-xl text-zinc-500">
                                    <p class="text-xs uppercase tracking-wider font-bold">No Active Operational Contracts Assigned</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Announcements Section (Spans 1 column) -->
                <div class="overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl p-6">
                    <div class="flex items-center gap-2 pb-4 border-b border-zinc-800/60 mb-4">
                        <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                        <h3 class="text-base font-black text-white uppercase tracking-widest">Broadcasting</h3>
                    </div>

                    <div class="space-y-4 max-h-[280px] overflow-y-auto pr-1">
                        @forelse($announcements as $announcement)
                            <div class="relative pl-4 border-l-2 border-amber-600/60">
                                <p class="text-lg text-zinc-400 leading-relaxed">{{ $announcement->message }}</p>
                                <span class="text-[15px] text-zinc-600 font-mono block mt-1">
                                    {{ $announcement->created_at ? $announcement->created_at->diffForHumans() : 'Broadcast Active' }}
                                </span>
                            </div>
                        @empty
                            <div class="text-center py-8 border border-dashed border-zinc-800 rounded-xl text-zinc-500">
                                <p class="text-xs uppercase tracking-wider font-bold">Secure Frequency Silent</p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>