<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'LIVESOSTORY.CO') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans bg-dark-950 text-white antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-dark-950 relative overflow-hidden">
            <!-- Background Decoration -->
            <div class="absolute top-0 left-0 w-full h-full">
                <div class="absolute top-[-10%] right-[-10%] w-[50%] h-[50%] bg-gold-500/5 blur-[120px] rounded-full"></div>
                <div class="absolute bottom-[-10%] left-[-10%] w-[50%] h-[50%] bg-gold-400/5 blur-[120px] rounded-full"></div>
            </div>

            @if(!request()->routeIs('login'))
            <div class="relative z-10">
                <a href="/" class="text-white tracking-ultra-wide text-lg font-light uppercase hover:text-gold-400 transition-colors duration-500">
                    LIVESOSTORY.CO
                </a>
            </div>
            @endif

            <div class="w-full sm:max-w-md {{ !request()->routeIs('login') ? 'mt-10' : '' }} px-8 py-10 bg-dark-900/50 backdrop-blur-xl border border-white/5 relative z-10 lg:rounded-sm shadow-2xl shadow-black/50 overflow-hidden">
                <!-- Decorative Border -->
                <div class="absolute top-0 left-0 w-full h-0.5 bg-gradient-to-r from-transparent via-gold-400/30 to-transparent"></div>
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
