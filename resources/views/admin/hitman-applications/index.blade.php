<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Pending Hitman Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @if (session('status'))
                <div class="mb-4 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700 dark:bg-green-900/30 dark:text-green-300">{{ session('status') }}</div>
            @endif

            @if (session('error'))
                <div class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700 dark:bg-red-900/30 dark:text-red-300">{{ session('error') }}</div>
            @endif

            <div class="overflow-hidden rounded-2xl bg-white shadow-sm ring-1 ring-black/5 dark:bg-gray-800 dark:ring-white/10">
                <div class="border-b border-gray-100 px-6 py-4 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Application queue</h3>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead class="bg-gray-50 dark:bg-gray-900/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Codename</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Referral</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Answers</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Motivation</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wide text-gray-500 dark:text-gray-400">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white dark:divide-gray-700 dark:bg-gray-800">
                            @forelse ($applications as $application)
                                <tr>
                                    <td class="px-4 py-4 text-sm text-gray-900 dark:text-gray-100">
                                        <div class="font-medium">{{ $application->codename }}</div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">{{ $application->specialty }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ $application->referral_codename }}</td>
                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">
                                        <div>{{ $application->currency_answer }}</div>
                                        <div>{{ $application->hotel_rule_answer }}</div>
                                        <div>{{ $application->best_weapon_answer }}</div>
                                    </td>
                                    <td class="px-4 py-4 text-sm text-gray-600 dark:text-gray-300">{{ \Illuminate\Support\Str::limit($application->motivation, 120) }}</td>
                                    <td class="px-4 py-4 text-sm font-medium capitalize text-gray-900 dark:text-gray-100">{{ $application->status }}</td>
                                    <td class="px-4 py-4 text-sm">
                                        @if ($application->status === 'pending')
                                            <div class="flex flex-wrap gap-2">
                                                <form method="POST" action="{{ route('admin.applications.approve', $application) }}">
                                                    @csrf
                                                    <button class="rounded-md bg-green-600 px-3 py-2 text-white hover:bg-green-700">Approve</button>
                                                </form>
                                                <form method="POST" action="{{ route('admin.applications.reject', $application) }}">
                                                    @csrf
                                                    <button class="rounded-md bg-red-600 px-3 py-2 text-white hover:bg-red-700">Reject</button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                Reviewed by {{ $application->reviewer?->codename ?? 'system' }}
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-10 text-center text-sm text-gray-500 dark:text-gray-400">No applications waiting for review.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>