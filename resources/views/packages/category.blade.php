<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="LIVESOSTORY.CO - {{ $matchedCategory }} Photography Packages">
    <title>LIVESOSTORY.CO — {{ $matchedCategory }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/ph.jpeg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }

        html,
        body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
    </style>
</head>

<body class="bg-dark-950 text-white font-sans antialiased overflow-x-hidden">

    <!-- Navbar -->
    <x-navbar class="bg-dark-950/95 backdrop-blur-md border-b border-dark-800" />

    <!-- Hero Banner -->
    <section class="relative pt-32">
        @php
            $heroImage = $category->image ?? $packages->first()?->image;
        @endphp
        <div class="relative h-64 md:h-80 overflow-hidden">
            @if($heroImage)
                <img src="{{ asset('storage/' . $heroImage) }}" alt="{{ $matchedCategory }}"
                    class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-dark-800 via-dark-900 to-dark-950"></div>
            @endif
            <div class="absolute inset-0 bg-black/60"></div>
            <div class="absolute inset-0 flex flex-col items-center justify-center">
                <p class="text-gold-400 text-xs tracking-widest uppercase mb-3">Package Collection</p>
                <h1 class="font-display text-4xl md:text-6xl font-light tracking-wide text-white">{{ $matchedCategory }}
                </h1>
                <div class="w-16 h-px bg-gold-400 mt-6"></div>
                <p class="text-gray-400 text-sm mt-4 tracking-wide">{{ $packages->count() }}
                    {{ $packages->count() > 1 ? 'Packages Available' : 'Package Available' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Packages List (Horizontal Scroll Layout) -->
    <section class="py-16 md:py-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="relative">
                <!-- Packages Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 xl:gap-8">
                    @foreach($packages as $package)
                        <div class="group h-full">

                            <!-- Main Package Card -->
                            <div class="glass flex flex-col h-full min-h-[500px] transition-all duration-700 hover:border-gold-500/50 hover:shadow-2xl hover:shadow-gold-500/5 hover:-translate-y-2 border-dark-800 rounded-sm animate-fade-in overflow-hidden"
                                style="animation-delay: {{ $loop->index * 0.15 }}s; opacity: 0;">

                                <!-- Package Content -->
                                <div class="p-8 md:p-10 flex-grow flex flex-col">
                                    <h2
                                        class="font-display text-2xl md:text-3xl font-light tracking-wide mb-3 text-gold-200 group-hover:text-white transition-colors duration-500">
                                        {{ $package->name }}
                                    </h2>
                                    <p
                                        class="text-gray-400 text-sm mb-6 leading-relaxed font-light italic opacity-80 group-hover:opacity-100 transition-opacity duration-500 line-clamp-3">
                                        {{ $package->description }}
                                    </p>

                                    @if($package->features)
                                        <ul class="space-y-3 mb-8 flex-grow">
                                            @foreach($package->features as $feature)
                                                <li class="flex items-start text-xs text-gray-400 tracking-wide uppercase">
                                                    <svg class="w-4 h-4 text-gold-500 mr-3 mt-0.5 flex-shrink-0 opacity-80"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M5 13l4 4L19 7" />
                                                    </svg>
                                                    <span
                                                        class="group-hover:text-gray-300 transition-colors duration-300">{{ $feature }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif

                                    <!-- Price & CTA -->
                                    <div class="mt-auto pt-6 border-t border-dark-800/50">
                                        <div class="mb-6">
                                            <span
                                                class="text-3xl font-light text-white tracking-tight">{{ $package->formatted_price }}</span>
                                        </div>
                                        <a href="{{ route('booking.create', $package) }}"
                                            class="inline-block text-center w-full btn-gold px-8 py-4 text-xs font-semibold tracking-widest uppercase transform transition-all duration-500 hover:bg-gold-300 hover:shadow-[0_0_20px_rgba(212,175,55,0.3)]">
                                            Select Package
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Item Yang Didapat Section (only show if any package has item images) -->
            @if($packages->contains(fn($p) => $p->item_images && count($p->item_images) > 0))
                <div class="mt-16 pt-12 border-t border-dark-800">
                    <div class="text-center mb-10">
                        <p
                            class="text-gold-400 text-xs tracking-widest uppercase mb-3 flex items-center justify-center gap-2">
                            <svg class="w-4 h-4 text-gold-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                            Yang Akan Anda Didapatkan
                        </p>
                    </div>

                    <div class="space-y-16">
                        @foreach($packages as $package)
                            @if($package->item_images && count($package->item_images) > 0)
                                <div class="animate-fade-in" style="animation-delay: {{ $loop->index * 0.2 }}s; opacity: 0;">
                                    <div class="flex flex-col md:flex-row gap-10 items-center">
                                        <!-- Package Description/Info -->
                                        <div class="w-full md:w-1/3 text-center md:text-left">
                                            <p class="text-gold-400 text-[10px] tracking-[0.3em] uppercase mb-4 italic opacity-80">
                                                Included in</p>
                                            <h3 class="font-display text-3xl md:text-4xl font-light tracking-wide text-white mb-5">
                                                {{ $package->name }}
                                            </h3>
                                            <div class="w-12 h-px bg-gold-400/30 mx-auto md:mx-0 mb-6"></div>
                                            <p class="text-gray-500 text-sm leading-relaxed italic max-w-sm mx-auto md:mx-0">
                                                The premium physical deliverables specifically curated for your session.
                                            </p>
                                        </div>

                                        <!-- Deliverables Visual Grid -->
                                        <div class="w-full md:w-2/3">
                                            <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                                                @foreach($package->item_images as $image)
                                                    <div
                                                        class="group/item relative aspect-square overflow-hidden glass border-dark-800/50 rounded-sm">
                                                        <img src="{{ asset('storage/' . $image) }}"
                                                            class="w-full h-full object-cover grayscale group-hover/item:grayscale-0 group-hover/item:scale-110 transition-all duration-700">
                                                        <div
                                                            class="absolute inset-0 bg-gradient-to-t from-dark-950/80 via-transparent to-transparent opacity-0 group-hover/item:opacity-100 transition-opacity duration-500 flex items-end p-4">
                                                            <span
                                                                class="text-[10px] tracking-widest uppercase text-gold-400 font-medium">Deliverable</span>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <!-- Back to Top Button -->
    <div class="py-8 text-center">
        <a href="{{ route('home') }}#packages"
            class="inline-flex items-center gap-3 text-xs tracking-widest uppercase text-gray-400 hover:text-gold-400 transition-colors duration-300 group">
            <svg class="w-4 h-4 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
            </svg>
            Back to All Packages
        </a>
    </div>

    <!-- Footer -->
    <footer class="py-8 bg-dark-900 border-t border-dark-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col items-center text-center">
            <p class="text-gray-400/60 text-[10px] tracking-widest uppercase">&copy; {{ date('Y') }}
                LIVESOSTORY.CO. All rights reserved.</p>
        </div>
    </footer>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }
    </style>
</body>

</html>