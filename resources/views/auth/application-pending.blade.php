<x-guest-layout>
    <div class="rounded-2xl bg-white p-8 shadow-xl shadow-black/10 dark:bg-gray-800">
        <p class="text-xs uppercase tracking-[0.3em] text-amber-600 dark:text-amber-400">Application received</p>
        <h1 class="mt-2 text-2xl font-semibold text-gray-900 dark:text-gray-100">Your syndicate request is pending review.</h1>
        <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">An administrator will verify your referral and answers before creating your active account.</p>

        <div class="mt-6 flex items-center justify-between gap-4">
            <a href="{{ route('login') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">Go to login</a>
            <a href="{{ route('register') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-gray-200">Submit another application</a>
        </div>
    </div>
</x-guest-layout>