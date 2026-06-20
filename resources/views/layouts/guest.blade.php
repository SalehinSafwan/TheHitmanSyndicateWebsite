<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'The Syndicate') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-zinc-950 text-zinc-100 min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 relative overflow-x-hidden">
        
        <!-- Subtle background glow -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-amber-900/10 rounded-full blur-[120px] pointer-events-none z-0"></div>

        <!-- Hidden Audio Player Container -->
        <div style="position: absolute; top: -9999px; left: -9999px; width: 1px; height: 1px; overflow: hidden;">
            <div id="player"></div>
        </div>

        <div class="w-full max-w-2xl z-10">
            {{ $slot }}
        </div>

        <!-- Background Music Logic -->
        <script>
            let player;
            let isPlayerReady = false;
            let userInteracted = false;

            // 1. Define the callback function FIRST on the global window object
            window.onYouTubeIframeAPIReady = function() {
                player = new YT.Player('player', {
                    height: '360',  
                    width: '640',
                    videoId: 'iWP6o9LCKn8',
                    playerVars: {
                        autoplay: 0, 
                        loop: 1,
                        playlist: 'iWP6o9LCKn8',
                        controls: 0,         
                        disablekb: 1,        
                        playsinline: 1       
                    },
                    events: {
                        'onReady': onPlayerReady
                    }
                });
            }

            function onPlayerReady(event) {
                isPlayerReady = true;
                if (userInteracted) {
                    startMusic();
                }
            }

            function startMusic() {
                if (player && typeof player.playVideo === 'function') {
                    player.unMute();
                    player.setVolume(40); // Comfortable background volume
                    player.playVideo();
                }
            }

            const startActivation = function() {
                userInteracted = true;
                if (isPlayerReady) {
                    startMusic();
                }
            };

            document.addEventListener('click', startActivation, { once: true });
            document.addEventListener('keydown', startActivation, { once: true });
            document.addEventListener('touchstart', startActivation, { once: true });

            // 2. Dynamically load the YouTube API script AFTER the setup function is safely declared
            const tag = document.createElement('script');
            tag.src = "https://www.youtube.com/iframe_api";
            const firstScriptTag = document.getElementsByTagName('script')[0];
            firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        </script>
    </body>
</html>