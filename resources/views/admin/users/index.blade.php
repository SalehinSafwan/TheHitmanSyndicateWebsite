<x-app-layout>
    <!-- Header Block Overrides -->
    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <h2 class="font-black text-xl text-white uppercase tracking-wider">
                {{ __('User Management Registry') }}
            </h2>
            <div class="flex gap-3">
                <a href="{{ route('admin.contracts.create') }}" class="rounded-lg bg-zinc-900 border border-zinc-800 hover:text-white hover:bg-zinc-850 px-4 py-2.5 text-xs font-bold text-zinc-300 uppercase tracking-widest transition duration-150">
                    Initialize Contract
                </a>
                <a href="{{ route('admin.users.create') }}" class="rounded-lg bg-gradient-to-r from-amber-600 to-amber-700 hover:from-amber-500 hover:to-amber-600 px-4 py-2.5 text-xs font-extrabold text-zinc-950 uppercase tracking-widest shadow-md transition duration-150">
                    Create Account
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12 relative min-h-[calc(100vh-65px)] overflow-hidden">
        
        <!-- Large Logo Watermark Background -->
        <div class="absolute inset-0 flex items-center justify-center opacity-[0.12] select-none pointer-events-none z-0">
            <img src="{{ asset('images/logo.png') }}" alt="" class="w-[600px] h-[600px] object-contain scale-110 blur-[2px]" />
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 relative z-10">
            @if (session('status'))
                <div class="mb-6 rounded-xl bg-emerald-950/40 border border-emerald-800/40 px-4 py-3 text-sm text-emerald-400 font-bold uppercase tracking-wide">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Main Registry Terminal Card -->
            <div class="overflow-hidden rounded-2xl bg-zinc-900/80 backdrop-blur-md border border-zinc-800/50 shadow-2xl">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-800">
                        <thead class="bg-gradient-to-r from-zinc-950 to-zinc-900">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-zinc-500">Codename</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-zinc-500">Email</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-zinc-500">Role</th>
                                <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-widest text-zinc-500">Specialty</th>
                                <th class="px-6 py-4 text-right text-xs font-bold uppercase tracking-widest text-zinc-500">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-850 bg-zinc-900/40">
                            @foreach ($users as $user)
                                <tr class="hover:bg-zinc-950/40 transition duration-150 group">
                                    <td class="px-6 py-4 text-sm font-black text-white uppercase tracking-wide font-mono">
                                        {{ $user->codename }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-400 font-mono">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-4 text-sm">
                                        <span class="px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider rounded border {{ $user->role === 'Admin' ? 'bg-amber-950/40 border-amber-800/40 text-amber-400' : 'bg-zinc-800 border-zinc-700 text-zinc-300' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-zinc-400 font-semibold">
                                        {{ $user->specialty ?? '—' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-right">
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('CRITICAL: Terminate access authorization profile forever?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button class="rounded-md bg-red-950/40 border border-red-900/40 px-3 py-1.5 text-xs font-bold uppercase tracking-widest text-red-400 hover:bg-red-600 hover:text-white transition duration-150">
                                                Terminate
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>