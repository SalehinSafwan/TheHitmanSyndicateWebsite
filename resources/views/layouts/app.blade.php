<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Hitman Syndicate</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-zinc-200 bg-zinc-950 selection:bg-amber-500 selection:text-zinc-950">
        <div class="min-h-screen bg-zinc-950">
            <!-- Navigation Header -->
            @include('layouts.navigation')

            <!-- Tactical Sub-Header Area -->
            @isset($header)
                <header class="bg-zinc-900/40 border-b border-zinc-800/60 backdrop-blur-sm">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="relative">
                {{ $slot }}
            </main>
        </div>

        <!-- Hidden Background Audio Routing -->
        <div style="display:none;">
            <iframe id="bg-music" width="0" height="0"
                src="@yield('bg-music', 'https://www.youtube.com/embed/iWP6o9LCKn8?autoplay=1&loop=1&playlist=iWP6o9LCKn8')"
                frameborder="0" allow="autoplay">
            </iframe>
        </div>
    </body>
</html>