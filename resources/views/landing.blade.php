<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description"
        content="LIVESOSTORY.CO - Professional Photography Services. Capturing the quiet, intimate layers of your love story.">
    <title>LIVESOSTORY.CO — Photography</title>
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
        /* Global Scroll Lock */
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
    <x-navbar class="bg-transparent" />
    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0">
            @if($settings['hero_image'])
                <img src="{{ str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : asset('storage/' . $settings['hero_image']) }}"
                    alt="Hero Background" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-dark-900 via-dark-950 to-black"></div>
            @endif
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
            <h1
                class="font-display text-4xl sm:text-7xl md:text-8xl lg:text-9xl font-light tracking-tight sm:tracking-ultra-wide mb-6 animate-fade-in text-gold-gradient leading-tight">
                {{ $settings['hero_title'] }}
            </h1>
            <p
                class="font-display text-2xl md:text-3xl lg:text-4xl italic text-gold-300 mb-8 animate-fade-in-delay-1 animate-float">
                {{ $settings['hero_subtitle'] }}
            </p>

            <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center animate-fade-in-delay-3 mt-12 md:mt-20 px-4 sm:px-0">
                <a href="#packages" class="btn-gold w-full sm:w-auto">
                    Book A Session
                </a>
                <a href="#portfolio" class="btn-outline w-full sm:w-auto">
                    View Portfolio
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="py-24 bg-dark-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <p class="text-gold-400 text-[10px] md:text-xs tracking-widest uppercase mb-3">Booking</p>
                <h2 class="font-display text-3xl md:text-5xl font-light tracking-wide">Packages</h2>
                <div class="w-12 md:w-16 h-px bg-gold-400 mx-auto mt-4 md:mt-6"></div>
            </div>

            @if($packageCategories->count() > 0)
                <!-- Horizontal Scrollable Categories -->
                <div class="relative group/nav">
                    <div class="category-scroll flex gap-5 md:gap-6 overflow-x-auto pb-6 snap-x snap-mandatory scroll-smooth px-1"
                        id="category-scroll">
                        @foreach($packageCategories as $cat)
                            <a href="{{ route('packages.category', $cat->slug) }}"
                                class="group flex-shrink-0 w-[280px] md:w-[300px] lg:w-[340px] relative overflow-hidden rounded category-card aspect-[4/5] snap-start block">
                                @if($cat->image)
                                    <!-- With Image -->
                                    <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}"
                                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent transition-opacity duration-500">
                                        <div class="absolute bottom-0 left-0 right-0 p-6">
                                            <h3 class="font-display text-xl font-light tracking-wide text-white">{{ $cat->name }}
                                            </h3>
                                            @if($cat->description)
                                                <p class="text-gray-300 text-xs mt-2 line-clamp-2">{{ $cat->description }}</p>
                                            @endif
                                            <p class="text-gold-400 text-[10px] tracking-[0.2em] uppercase mt-1.5">{{ $cat->packages_count }}
                                                {{ $cat->packages_count > 1 ? 'Packages' : 'Package' }}</p>
                                        </div>
                                    </div>
                                @else
                                    <!-- Elegant Placeholder -->
                                    <div class="w-full h-full relative overflow-hidden rounded shadow-2xl">
                                        <!-- Gradient Background -->
                                        <div class="absolute inset-0 bg-gradient-to-br from-dark-900 via-dark-800 to-dark-900"></div>
                                        <!-- Subtle radial glow -->
                                        <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(180,160,100,0.08)_0%,_transparent_70%)] group-hover:bg-[radial-gradient(circle_at_center,_rgba(180,160,100,0.15)_0%,_transparent_70%)] transition-all duration-1000"></div>
                                        <!-- Decorative corner accents -->
                                        <div class="absolute top-4 left-4 w-8 h-8 border-t border-l border-gold-400/20 group-hover:border-gold-400/50 group-hover:w-10 group-hover:h-10 transition-all duration-700"></div>
                                        <div class="absolute bottom-4 right-4 w-8 h-8 border-b border-r border-gold-400/20 group-hover:border-gold-400/50 group-hover:w-10 group-hover:h-10 transition-all duration-700"></div>

                                        <div class="relative z-10 w-full h-full flex flex-col items-center justify-center px-6">
                                            <!-- Camera Aperture Icon -->
                                            <div class="mb-6 opacity-30 group-hover:opacity-60 transition-all duration-700 group-hover:scale-110">
                                                <svg class="w-16 h-16 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="0.8">
                                                    <circle cx="12" cy="12" r="10" />
                                                    <circle cx="12" cy="12" r="4" />
                                                    <line x1="12" y1="2" x2="12" y2="6" />
                                                    <line x1="12" y1="18" x2="12" y2="22" />
                                                    <line x1="2" y1="12" x2="6" y2="12" />
                                                    <line x1="18" y1="12" x2="22" y2="12" />
                                                    <line x1="4.93" y1="4.93" x2="7.76" y2="7.76" />
                                                    <line x1="16.24" y1="16.24" x2="19.07" y2="19.07" />
                                                    <line x1="4.93" y1="19.07" x2="7.76" y2="16.24" />
                                                    <line x1="16.24" y1="7.76" x2="19.07" y2="4.93" />
                                                </svg>
                                            </div>

                                            <!-- Category Name -->
                                            <h3 class="font-display text-2xl md:text-3xl font-light tracking-wide text-gray-300 group-hover:text-white transition-colors duration-500 text-center">
                                                {{ $cat->name }}
                                            </h3>
                                            <div class="w-10 h-px bg-gold-400/30 mx-auto mt-4 group-hover:w-20 group-hover:bg-gold-400/70 transition-all duration-700"></div>

                                            <!-- Package Count -->
                                            <p class="text-gold-400/50 text-[10px] tracking-[0.2em] uppercase mt-5 group-hover:text-gold-400 transition-colors duration-500">
                                                {{ $cat->count }} {{ Str::plural('Package', $cat->count) }}
                                            </p>
                                        </div>

                                        <!-- Border overlay -->
                                        <div class="absolute inset-0 border border-dark-700/50 rounded group-hover:border-gold-500/30 transition-all duration-700 pointer-events-none"></div>
                                    </div>
                                @endif
                            </a>
                        @endforeach
                    </div>

                    <!-- Scroll Navigation Arrows -->
                    <button onclick="scrollCategories(-1)"
                        class="absolute left-0 lg:-left-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 flex items-center justify-center border border-dark-700 text-gold-400 bg-dark-950/80 hover:bg-gold-400 hover:text-dark-950 transition-all duration-300 opacity-0 group-hover/nav:opacity-100 hidden md:flex">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                        </svg>
                    </button>
                    <button onclick="scrollCategories(1)"
                        class="absolute right-0 lg:-right-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 flex items-center justify-center border border-dark-700 text-gold-400 bg-dark-950/80 hover:bg-gold-400 hover:text-dark-950 transition-all duration-300 opacity-0 group-hover/nav:opacity-100 hidden md:flex">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            @else
                <div class="text-center py-16 text-gray-500">
                    <p>Packages coming soon.</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-24 bg-dark-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <p class="text-gold-400 text-xs tracking-widest uppercase mb-3">Our Work</p>
                <h2 class="font-display text-4xl md:text-5xl font-light tracking-wide">Portfolio</h2>
                <div class="w-16 h-px bg-gold-400 mx-auto mt-6"></div>
            </div>

            <!-- Portfolio Scroll -->
            <div class="relative group/nav">
                @if($portfolios->count() > 0)
                    <div class="portfolio-scroll flex gap-5 md:gap-6 overflow-x-auto pb-6 snap-x snap-mandatory scroll-smooth px-1"
                        id="portfolio-scroll">
                        @foreach($portfolios as $portfolio)
                            <a href="#"
                                class="group flex-shrink-0 w-[280px] md:w-[300px] lg:w-[340px] relative overflow-hidden rounded category-card aspect-[4/5] snap-start block">
                                <img src="{{ \Illuminate\Support\Str::startsWith($portfolio->image_path, ['http://', 'https://']) ? $portfolio->image_path : asset('storage/' . $portfolio->image_path) }}"
                                    alt="{{ $portfolio->title }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end">
                                    <div class="p-6 translate-y-3 group-hover:translate-y-0 transition-all duration-500 w-full">
                                        <p class="font-display text-xl font-light tracking-wide text-white">
                                            {{ $portfolio->title }}</p>
                                        @if($portfolio->category)
                                            <p class="text-gold-400 text-[10px] tracking-[0.2em] uppercase mt-1.5">
                                                {{ $portfolio->category }}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="portfolio-scroll flex gap-5 md:gap-6 overflow-x-auto pb-6 snap-x snap-mandatory scroll-smooth px-1"
                        id="portfolio-scroll">
                        @for($i = 0; $i < 5; $i++)
                            <div
                                class="group flex-shrink-0 w-[280px] md:w-[300px] lg:w-[340px] relative overflow-hidden rounded category-card aspect-[4/5] snap-start bg-dark-800 border border-dark-700/40 flex items-center justify-center">
                                <div class="text-center">
                                    <svg class="w-12 h-12 text-dark-600 mx-auto mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="text-dark-500 text-sm tracking-wide">Image Coming Soon</p>
                                </div>
                            </div>
                        @endfor
                    </div>
                @endif

                <!-- Scroll Navigation Arrows -->
                <button onclick="scrollPortfolio(-1)"
                    class="absolute left-0 lg:-left-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 flex items-center justify-center border border-dark-700 text-gold-400 bg-dark-950/80 hover:bg-gold-400 hover:text-dark-950 transition-all duration-300 opacity-0 group-hover/nav:opacity-100 hidden md:flex">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button onclick="scrollPortfolio(1)"
                    class="absolute right-0 lg:-right-6 top-1/2 -translate-y-1/2 z-30 w-12 h-12 flex items-center justify-center border border-dark-700 text-gold-400 bg-dark-950/80 hover:bg-gold-400 hover:text-dark-950 transition-all duration-300 opacity-0 group-hover/nav:opacity-100 hidden md:flex">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 bg-dark-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-10 items-center">
                <!-- Contact Info -->
                <div>
                    <p class="text-gold-400 text-xs tracking-widest uppercase mb-3">Get In Touch</p>
                    <h2 class="font-display text-4xl md:text-5xl font-light tracking-wide mb-6">Contact</h2>
                    <div class="w-16 h-px bg-gold-400 mb-8"></div>
                    <p class="text-gray-400 text-sm leading-relaxed mb-10">
                        Ready to create beautiful memories? Reach out to us and let's plan your perfect session.
                    </p>

                    <div class="flex flex-wrap items-center gap-6">
                        <!-- Phone -->
                        <a href="https://wa.me/6289601350794"
                            target="_blank" class="flex flex-col items-center space-y-2 group/contact">
                            <div
                                class="w-12 h-12 rounded-full border border-dark-700 flex items-center justify-center transition-all duration-300 group-hover/contact:border-gold-400 group-hover/contact:bg-gold-400/10 group-hover/contact:scale-110 group-hover/contact:shadow-[0_0_15px_rgba(212,175,55,0.2)] active:scale-95">
                                <svg class="w-5 h-5 text-gold-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <span class="text-gray-400 text-xs tracking-wider group-hover/contact:text-gold-400 transition-colors">WhatsApp</span>
                        </a>

                        <!-- TikTok -->
                        @php
                            $tiktokValue = App\Models\Setting::get('tiktok', 'https://www.tiktok.com/@akangfotoo');
                            $tiktokHref = str_contains($tiktokValue, 'http') ? $tiktokValue : 'https://www.tiktok.com/' . ltrim($tiktokValue, '@');
                            $tiktokUsername = str_contains($tiktokValue, 'http') ? basename(parse_url($tiktokValue, PHP_URL_PATH)) : $tiktokValue;
                            $tiktokDisplay = '@' . ltrim($tiktokUsername, '@');
                        @endphp
                        <a href="{{ $tiktokHref }}" target="_blank"
                            class="flex flex-col items-center space-y-2 group/contact">
                            <div class="w-12 h-12 rounded-full border border-dark-700 flex items-center justify-center transition-all duration-300 group-hover/contact:border-gold-400 group-hover/contact:bg-gold-400/10 group-hover/contact:scale-110 group-hover/contact:shadow-[0_0_15px_rgba(212,175,55,0.2)] active:scale-95">
                                <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 448 512">
                                    <path d="M448,209.91a210.06,210.06,0,0,1-122.77-39.25V349.38A162.55,162.55,0,1,1,185,188.31V278.2a74.62,74.62,0,1,0,52.23,71.18V0l88,0a121.18,121.18,0,0,0,1.86,22.17h0A122.18,122.18,0,0,0,381,102.39a121.43,121.43,0,0,0,67,20.14Z"/>
                                </svg>
                            </div>
                            <span class="text-gray-400 text-xs tracking-wider group-hover/contact:text-gold-400 transition-colors">TikTok</span>
                        </a>

                        <!-- Instagram -->
                        @php
                            $igValue = App\Models\Setting::get('instagram', 'https://www.instagram.com/livesostory.co');
                            $igHref = str_contains($igValue, 'http') ? $igValue : 'https://www.instagram.com/' . ltrim($igValue, '@');
                            $igUsername = str_contains($igValue, 'http') ? basename(parse_url($igValue, PHP_URL_PATH)) : $igValue;
                            $igDisplay = '@' . ltrim($igUsername, '@');
                        @endphp
                        <a href="{{ $igHref }}" target="_blank"
                            class="flex flex-col items-center space-y-2 group/contact">
                            <div
                                class="w-12 h-12 rounded-full border border-dark-700 flex items-center justify-center transition-all duration-300 group-hover/contact:border-gold-400 group-hover/contact:bg-gold-400/10 group-hover/contact:scale-110 group-hover/contact:shadow-[0_0_15px_rgba(212,175,55,0.2)] active:scale-95">
                                <svg class="w-5 h-5 text-gold-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204 0.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </div>
                            <span class="text-gray-400 text-xs tracking-wider group-hover/contact:text-gold-400 transition-colors">Instagram</span>
                        </a>
                    </div>
                </div>

                <!-- Photographer Profile -->
                <div class="relative group/profile flex items-center justify-center lg:justify-start">
                    <div class="relative w-full max-w-lg aspect-[4/3] overflow-hidden rounded-sm group cursor-pointer">
                        @if(!empty($settings['contact_image']))
                            <img src="{{ str_starts_with($settings['contact_image'], 'http') ? $settings['contact_image'] : asset('storage/' . $settings['contact_image']) }}"
                                alt="Lead Photographer"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <img src="https://images.unsplash.com/photo-1554048612-b6a482bc67e5?q=80&w=2070&auto=format&fit=crop"
                                alt="Lead Photographer"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @endif
                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-500 flex items-end justify-center">
                            <div
                                class="p-6 md:p-8 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 text-center w-full">
                                <p class="font-display text-xl md:text-2xl text-white tracking-wide mb-2">Founder &
                                    Photographer</p>
                                <div class="w-12 h-px bg-gold-400 mx-auto mb-2"></div>
                                <p class="text-gold-400 text-xs tracking-widest uppercase">LIVESOSTORY.CO</p>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Element -->
                    <div
                        class="absolute -z-10 w-full h-full border border-gold-500/10 -bottom-4 -right-4 transition-all duration-500 group-hover/profile:-bottom-6 group-hover/profile:-right-6">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-8 bg-dark-900 border-t border-dark-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 flex flex-col items-center text-center">
            <p class="text-gray-400/60 text-[10px] tracking-widest uppercase">&copy; {{ date('Y') }}
                LIVESOSTORY.CO. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Scroll Categories horizontally
        function scrollCategories(direction) {
            const container = document.getElementById('category-scroll');
            if (container) {
                const cardWidth = container.querySelector('.category-card').offsetWidth + 24;
                container.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
            }
        }

        // Scroll Portfolio horizontally
        function scrollPortfolio(direction) {
            const container = document.getElementById('portfolio-scroll');
            if (container) {
                const cardWidth = container.querySelector('.category-card').offsetWidth + 24;
                container.scrollBy({ left: direction * cardWidth, behavior: 'smooth' });
            }
        }
    </script>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s ease-out forwards;
        }

        .animate-fade-in-delay-1 {
            animation: fadeIn 1s ease-out 0.3s forwards;
            opacity: 0;
        }

        .animate-fade-in-delay-2 {
            animation: fadeIn 1s ease-out 0.6s forwards;
            opacity: 0;
        }

        .animate-fade-in-delay-3 {
            animation: fadeIn 1s ease-out 0.9s forwards;
            opacity: 0;
        }

        /* Horizontal Scroll Hide Scrollbar */
        .category-scroll,
        .portfolio-scroll {
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .category-scroll::-webkit-scrollbar,
        .portfolio-scroll::-webkit-scrollbar {
            display: none;
        }

        .category-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .category-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.4);
        }
    </style>
</body>

</html>