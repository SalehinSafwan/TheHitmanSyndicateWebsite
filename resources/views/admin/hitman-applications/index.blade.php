<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-zinc-100 uppercase tracking-widest leading-tight">
            {{ __('Pending Operative Requests') }}
        </h2>
    </x-slot>

    <!-- Main Full-Page Wrapper (Set to relative so the logo stretches across the entire screen context) -->
    <div class="py-12 relative min-h-screen bg-zinc-950 overflow-x-hidden">
        
        
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.15] select-none pointer-events-none z-0 fixed">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-[800px] h-[800px] object-contain sticky top-1/4" />
        </div>

        <!-- Foreground Content Wrapper (Set to z-10 so it stays crisply readable above the background) -->
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 relative z-10">
            
            <!-- Session Status Alerts -->
            @if (session('status'))
                <div class="mb-6 rounded-xl border border-emerald-500/20 bg-emerald-950/40 px-4 py-3 text-sm text-emerald-400 font-mono backdrop-blur-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 rounded-xl border border-red-500/20 bg-red-950/40 px-4 py-3 text-sm text-red-400 font-mono backdrop-blur-sm">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Main Queue Card -->
            <div class="overflow-hidden rounded-2xl bg-zinc-900/80 border border-zinc-800/80 shadow-2xl backdrop-blur-md">
                <div class="border-b border-zinc-800/80 px-6 py-4 bg-zinc-900/40">
                    <h3 class="text-xs uppercase tracking-widest font-black text-amber-500">Application Queue</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-800">
                        <thead class="bg-zinc-950/60 text-left">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-zinc-400">Codename</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-zinc-400">Referral</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-zinc-400">Status</th>
                                <th class="px-6 py-4 text-xs font-bold uppercase tracking-widest text-zinc-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-800/60 bg-transparent">
                            @forelse ($applications as $application)
                                <tr class="hover:bg-zinc-800/20 transition-colors duration-150">
                                    <td class="px-6 py-4 text-sm">
                                        <div class="font-bold text-zinc-100 tracking-wide font-mono">{{ $application->codename }}</div>
                                        <div class="text-xs text-amber-500/80 font-medium mt-0.5">{{ $application->specialty }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-300 font-mono">
                                        {{ $application->referral_codename ?? 'NONE' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2.5 py-1 text-xs font-bold uppercase tracking-wider rounded font-mono 
                                            {{ $application->status === 'pending' ? 'bg-amber-950/40 text-amber-400 border border-amber-900/50' : 'bg-zinc-800 text-zinc-400' }}">
                                            {{ $application->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        @if ($application->status === 'pending')
                                            <div class="flex items-center justify-end gap-2">
                                                <form method="POST" action="{{ route('admin.applications.approve', $application) }}">
                                                    @csrf
                                                    <button class="rounded border border-emerald-600 bg-emerald-600/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-emerald-400 hover:bg-emerald-600 hover:text-white transition-all duration-200">
                                                        Approve
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.applications.reject', $application) }}">
                                                    @csrf
                                                    <button class="rounded border border-red-600 bg-red-600/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-red-400 hover:bg-red-600 hover:text-white transition-all duration-200">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        @else
                                            <span class="text-xs font-mono text-zinc-500 uppercase">
                                                Verified by {{ $application->reviewer?->codename ?? 'SYSTEM' }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-16 text-center">
                                        <div class="text-zinc-600 font-mono text-xs uppercase tracking-[0.25em] font-bold">
                                            [ Warning: No classified profiles awaiting processing ]
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>