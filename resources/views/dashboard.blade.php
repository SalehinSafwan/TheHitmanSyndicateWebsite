<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Syndicate Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5 dark:bg-gray-800 dark:ring-white/10">
                <div class="border-b border-gray-100 px-6 py-5 dark:border-gray-700">
                    <p class="text-xs uppercase tracking-[0.3em] text-amber-600 dark:text-amber-400">Welcome back</p>
                    <h3 class="mt-1 text-2xl font-semibold text-gray-900 dark:text-gray-100">{{ auth()->user()->codename ?? auth()->user()->name }}</h3>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Role: {{ auth()->user()->role }} · Specialty: {{ auth()->user()->specialty ?? 'Unassigned' }}</p>
                </div>

                <div class="grid gap-4 p-6 md:grid-cols-2">
                    <div class="rounded-xl bg-gray-50 p-5 dark:bg-gray-900/60">
                        <h4 class="font-medium text-gray-900 dark:text-gray-100">Account status</h4>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Active membership is granted after admin approval. If you just applied, wait for review.</p>
                    </div>

                    @if (auth()->user()->hasRole('Admin'))
                        <div class="rounded-xl bg-amber-50 p-5 dark:bg-amber-950/30">
                            <h4 class="font-medium text-gray-900 dark:text-gray-100">Management console</h4>
                            <div class="mt-3 flex flex-wrap gap-3 text-sm">
                                <a href="{{ route('admin.applications.index') }}" class="rounded-md bg-gray-900 px-4 py-2 text-white hover:bg-black">Pending requests</a>
                                <a href="{{ route('admin.users.index') }}" class="rounded-md border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:text-gray-200 dark:hover:bg-gray-700">User management</a>
                            </div>
                        </div>
                    @else
                        <div class="rounded-xl bg-gray-50 p-5 dark:bg-gray-900/60">
                            <h4 class="font-medium text-gray-900 dark:text-gray-100">Operational access</h4>
                            <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Once approved, you can be linked to contracts, bookings, and the broader Continental network.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
