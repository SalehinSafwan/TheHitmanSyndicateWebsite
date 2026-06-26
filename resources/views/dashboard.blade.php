<x-app-layout>
    <!-- Header Block Overrides (Matches clean layout styles) -->
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
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.20] select-none pointer-events-none z-0">
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
                                {{ auth()->user()->codename ?? auth()->user()->name }}
                            </h3>
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
                    
                    <!-- Box 1: Clearance Status -->
                    <div class="rounded-xl bg-zinc-950 border border-zinc-850 p-5 flex flex-col justify-between group hover:border-zinc-800 transition duration-200">
                        <div>
                            <div class="flex items-center gap-2 text-zinc-400">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
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

                    <!-- Box 2: Conditional Actions Panel -->
                    @if (auth()->user()->role === 'Admin')
                        <!-- Admin View -->
                        <div class="rounded-xl bg-gradient-to-b from-zinc-950 to-zinc-950 border border-zinc-850 p-5 flex flex-col justify-between">
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
                        <!-- Regular User View -->
                        <div class="rounded-xl bg-zinc-950 border border-zinc-850 p-5 flex flex-col justify-between group hover:border-zinc-800 transition duration-200">
                            <div>
                                <div class="flex items-center gap-2 text-zinc-400">
                                    <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    <h4 class="text-xs uppercase tracking-widest font-bold text-zinc-500">Operational Access</h4>
                                </div>
                                <p class="mt-3 text-sm text-zinc-500 leading-relaxed">
                                    Deployment systems offline. Following administrative activation, this hub will map real-time tactical contracts, secure safehouse bookings, and route network arrays.
                                </p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-zinc-900/50">
                                <span class="text-[10px] uppercase tracking-wider text-zinc-600 font-bold">Network Modules Encrypted</span>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>