<nav x-data="{ open: false }" class="bg-zinc-950 border-b border-zinc-800/80 sticky top-0 z-50 backdrop-blur-md">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Syndicate Identity Mark -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-black text-sm uppercase tracking-[0.4em] text-amber-500 hover:text-amber-400 transition duration-150">
                        [ Σ ]
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('dashboard') ? 'border-amber-500 text-white font-bold' : 'border-transparent text-zinc-400 hover:text-zinc-200 hover:border-zinc-700' }} text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                        {{ __('Dashboard') }}
                    </a>

                    @if (auth()->user()?->hasRole('Admin'))
                        <a href="{{ route('admin.applications.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.applications.*') ? 'border-amber-500 text-white font-bold' : 'border-transparent text-zinc-400 hover:text-zinc-200 hover:border-zinc-700' }} text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                            {{ __('Requests') }}
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 {{ request()->routeIs('admin.users.*') ? 'border-amber-500 text-white font-bold' : 'border-transparent text-zinc-400 hover:text-zinc-200 hover:border-zinc-700' }} text-xs uppercase tracking-widest transition duration-150 ease-in-out">
                            {{ __('Users') }}
                        </a>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-zinc-800 text-xs uppercase tracking-wider leading-4 font-bold rounded-lg text-zinc-400 bg-zinc-900/50 hover:text-zinc-200 hover:bg-zinc-900 focus:outline-none transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->codename ?? Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 text-zinc-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <!-- Custom classes handled via layout context or standard slot injection -->
                        <div class="bg-zinc-900 border border-zinc-800 rounded-lg py-1 shadow-2xl">
                            <x-dropdown-link :href="route('profile.edit')" class="block px-4 py-2 text-xs uppercase tracking-wider text-zinc-450 hover:bg-zinc-850 hover:text-amber-500 transition duration-150">
                                {{ __('Dossier') }}
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        class="block px-4 py-2 text-xs uppercase tracking-wider text-zinc-455 hover:bg-zinc-855 hover:text-red-400 transition duration-150"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Disconnect') }}
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger Button (Mobile Layout Menu) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-zinc-500 hover:text-zinc-400 hover:bg-zinc-900 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Drawer Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-zinc-950 border-t border-zinc-900 shadow-inner">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block w-full ps-3 pr-4 py-2 border-l-4 {{ request()->routeIs('dashboard') ? 'border-amber-500 text-amber-500 bg-amber-950/20 font-bold' : 'border-transparent text-zinc-400 hover:bg-zinc-900' }} text-xs uppercase tracking-widest">
                {{ __('Dashboard') }}
            </a>

            @if (auth()->user()?->hasRole('Admin'))
                <a href="{{ route('admin.applications.index') }}" class="block w-full ps-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.applications.*') ? 'border-amber-500 text-amber-500 bg-amber-950/20 font-bold' : 'border-transparent text-zinc-400 hover:bg-zinc-900' }} text-xs uppercase tracking-widest">
                    {{ __('Requests') }}
                </a>
                <a href="{{ route('admin.users.index') }}" class="block w-full ps-3 pr-4 py-2 border-l-4 {{ request()->routeIs('admin.users.*') ? 'border-amber-500 text-amber-500 bg-amber-950/20 font-bold' : 'border-transparent text-zinc-400 hover:bg-zinc-900' }} text-xs uppercase tracking-widest">
                    {{ __('Users') }}
                </a>
            @endif
        </div>

        <!-- Responsive Mobile Profile Controls -->
        <div class="pt-4 pb-1 border-t border-zinc-900 bg-zinc-900/20">
            <div class="px-4">
                <div class="font-bold text-sm text-zinc-200">{{ Auth::user()->codename ?? Auth::user()->name }}</div>
                <div class="font-medium text-xs text-zinc-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block w-full ps-3 pr-4 py-2 text-xs uppercase tracking-widest text-zinc-400 hover:bg-zinc-900 hover:text-white">
                    {{ __('Dossier Settings') }}
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block ps-3 pr-4 py-2 text-xs uppercase tracking-widest text-zinc-400 hover:bg-zinc-900 hover:text-red-400">
                        {{ __('Disconnect') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>