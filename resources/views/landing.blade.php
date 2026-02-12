<!DOCTYPE html>
<html lang="id" class="scroll-smooth overflow-x-hidden">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <meta name="description" content="LIVESOSTORY.CO - Professional Photography Services. Capturing the quiet, intimate layers of your love story.">
    <title>LIVESOSTORY.CO — Photography</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        
        /* Global Scroll Lock */
        html, body {
            overflow-x: hidden;
            width: 100%;
            position: relative;
        }
    </style>
</head>
<body class="bg-dark-950 text-white font-sans antialiased overflow-x-hidden">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                <!-- Logo -->
                <a href="/" class="text-white tracking-ultra-wide text-sm font-light uppercase">
                    LIVESOSTORY.CO
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-10">
                    <a href="#home" class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Home</a>
                    <a href="#portfolio" class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Portfolio</a>
                    <a href="#packages" class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Booking</a>
                    <a href="#contact" class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Contact</a>
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase hover:bg-gold-400 hover:text-dark-950 transition-all duration-300">Dashboard</a>
                        @else
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Logout</button>
                            </form>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase hover:bg-gold-400 hover:text-dark-950 transition-all duration-300">Login</a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-dark-950/95 backdrop-blur-md border-t border-dark-800">
            <div class="px-6 py-6 space-y-4">
                <a href="#home" class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Home</a>
                <a href="#portfolio" class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Portfolio</a>
                <a href="#packages" class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Booking</a>
                <a href="#contact" class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Contact</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase text-center">Dashboard</a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase text-center">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden">
        <!-- Background -->
        <div class="absolute inset-0">
            @if($settings['hero_image'])
                <img src="{{ str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : asset('storage/' . $settings['hero_image']) }}" alt="Hero Background" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full bg-gradient-to-br from-dark-900 via-dark-950 to-black"></div>
            @endif
            <div class="absolute inset-0 bg-black/60"></div>
        </div>

        <!-- Content -->
        <div class="relative z-10 text-center px-6 max-w-4xl mx-auto">
            <h1 class="font-display text-6xl md:text-8xl lg:text-9xl font-light tracking-ultra-wide mb-6 animate-fade-in text-gold-gradient">
                {{ $settings['hero_title'] }}
            </h1>
            <p class="font-display text-2xl md:text-3xl lg:text-4xl italic text-gold-300 mb-8 animate-fade-in-delay-1 animate-float">
                {{ $settings['hero_subtitle'] }}
            </p>
            <p class="text-gray-400 text-sm md:text-base max-w-2xl mx-auto mb-12 leading-loose tracking-wide animate-fade-in-delay-2 opacity-80">
                {{ $settings['hero_description'] }}
            </p>

            <div class="flex flex-col sm:flex-row gap-6 justify-center animate-fade-in-delay-3">
                <a href="#packages" class="btn-gold">
                    Book A Session
                </a>
                <a href="#portfolio" class="btn-outline">
                    View Portfolio
                </a>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
            </svg>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="py-24 bg-dark-950">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <p class="text-gold-400 text-xs tracking-widest uppercase mb-3">Our Work</p>
                <h2 class="font-display text-4xl md:text-5xl font-light tracking-wide">Portfolio</h2>
                <div class="w-16 h-px bg-gold-400 mx-auto mt-6"></div>
            </div>

            <!-- Portfolio Grid -->
            @if($portfolios->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
                    @foreach($portfolios->take(5) as $index => $portfolio)
                        <div class="{{ $index === 0 ? 'col-span-2 row-span-2' : ($index === 2 ? 'row-span-2' : '') }} group relative overflow-hidden rounded-sm cursor-pointer">
                            <img 
                                src="{{ \Illuminate\Support\Str::startsWith($portfolio->image_path, ['http://', 'https://']) ? $portfolio->image_path : asset('storage/' . $portfolio->image_path) }}"
                                alt="{{ $portfolio->title }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 {{ ($index === 0 || $index === 2) ? 'h-full' : 'aspect-square' }}"
                            >
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-500 flex items-end">
                                <div class="p-4 md:p-6 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500">
                                    <p class="text-white text-sm font-light tracking-wide">{{ $portfolio->title }}</p>
                                    @if($portfolio->category)
                                        <p class="text-gold-400 text-xs tracking-widest uppercase mt-1">{{ $portfolio->category }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3 md:gap-4">
                    @for($i = 0; $i < 5; $i++)
                        <div class="{{ $i === 0 ? 'col-span-2 row-span-2' : '' }} relative overflow-hidden rounded-sm bg-dark-800 {{ $i === 0 ? 'aspect-[4/3]' : 'aspect-square' }} flex items-center justify-center">
                            <div class="text-center">
                                <svg class="w-12 h-12 text-dark-600 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="text-dark-500 text-xs">Portfolio Image</p>
                            </div>
                        </div>
                    @endfor
                </div>
            @endif
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="py-24 bg-dark-900">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <p class="text-gold-400 text-xs tracking-widest uppercase mb-3">Investment</p>
                <h2 class="font-display text-4xl md:text-5xl font-light tracking-wide">Packages</h2>
                <div class="w-16 h-px bg-gold-400 mx-auto mt-6"></div>
            </div>

            <!-- Package Swiper Container -->
            <div class="relative group/nav px-4 md:px-0">
                <div class="swiper package-swiper !py-20">
                    <div class="swiper-wrapper">
                        @forelse($packages as $package)
                            <div class="swiper-slide h-auto transition-all duration-500">
                                <div class="relative group h-full">
                                    <div class="h-full glass p-8 lg:p-12 transition-all duration-700 hover:border-gold-500/50 flex flex-col hover:scale-[1.02] border-dark-800">
                                        <div class="flex-grow">
                                            <h3 class="font-display text-3xl font-light tracking-wide mb-3 text-gold-200">{{ $package->name }}</h3>
                                            <p class="text-gray-400 text-sm mb-8 leading-relaxed font-light italic">{{ $package->description }}</p>

                                            <div class="mb-10">
                                                <span class="text-4xl font-light text-white tracking-tight">{{ $package->formatted_price }}</span>
                                            </div>

                                            @if($package->features)
                                                <ul class="space-y-4 mb-12">
                                                    @foreach($package->features as $feature)
                                                        <li class="flex items-start text-xs text-gray-400 tracking-wide uppercase group-hover:text-gray-300 transition-colors">
                                                            <svg class="w-4 h-4 text-gold-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                                            </svg>
                                                            {{ $feature }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>

                                        <a href="{{ route('booking.create', $package) }}"
                                           class="block text-center w-full btn-gold mt-auto transform transition-transform duration-500">
                                            Select Package
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="swiper-slide text-center py-16 text-gray-500">
                                <p>Packages coming soon.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <button class="swiper-button-prev-custom absolute left-0 lg:-left-12 top-1/2 -translate-y-1/2 z-30 w-12 h-12 flex items-center justify-center border border-dark-700 text-gold-400 bg-dark-950/80 hover:bg-gold-400 hover:text-dark-950 transition-all duration-300 opacity-0 group-hover/nav:opacity-100 hidden md:flex">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button class="swiper-button-next-custom absolute right-0 lg:-right-12 top-1/2 -translate-y-1/2 z-30 w-12 h-12 flex items-center justify-center border border-dark-700 text-gold-400 bg-dark-950/80 hover:bg-gold-400 hover:text-dark-950 transition-all duration-300 opacity-0 group-hover/nav:opacity-100 hidden md:flex">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
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

                    <div class="space-y-6">
                        <a href="mailto:{{ App\Models\Setting::get('email', 'hello@livesostory.co') }}" class="flex items-center space-x-4 group/contact w-fit">
                            <div class="w-10 h-10 border border-dark-700 flex items-center justify-center transition-all duration-300 group-hover/contact:border-gold-400 group-hover/contact:bg-gold-400/10 group-hover/contact:scale-110 active:scale-95">
                                <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <span class="text-gray-400 text-sm group-hover/contact:text-gold-400 transition-colors">{{ App\Models\Setting::get('email', 'hello@livesostory.co') }}</span>
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', App\Models\Setting::get('whatsapp_number', '6281234567890')) }}" target="_blank" class="flex items-center space-x-4 group/contact w-fit">
                            <div class="w-10 h-10 border border-dark-700 flex items-center justify-center transition-all duration-300 group-hover/contact:border-gold-400 group-hover/contact:bg-gold-400/10 group-hover/contact:scale-110 active:scale-95">
                                <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <span class="text-gray-400 text-sm group-hover/contact:text-gold-400 transition-colors">{{ App\Models\Setting::get('whatsapp_number', '6281234567890') }}</span>
                        </a>
                        <a href="https://www.instagram.com/livesostory.co?igsh=MWF5MTE3Y3FmYjRjbA==" target="_blank" class="flex items-center space-x-4 group/contact w-fit">
                            <div class="w-10 h-10 border border-dark-700 flex items-center justify-center transition-all duration-300 group-hover/contact:border-gold-400 group-hover/contact:bg-gold-400/10 group-hover/contact:scale-110 active:scale-95">
                                <svg class="w-4 h-4 text-gold-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </div>
                            <span class="text-gray-400 text-sm group-hover/contact:text-gold-400 transition-colors">{{ App\Models\Setting::get('instagram', '@livesostory.co') }}</span>
                        </a>
                    </div>
                </div>

                <!-- Photographer Profile -->
                <div class="relative group/profile flex items-center justify-center lg:justify-start">
                    <div class="relative w-full max-w-lg aspect-[4/3] overflow-hidden rounded-sm group cursor-pointer">
                        @if(!empty($settings['contact_image']))
                             <img 
                                src="{{ str_starts_with($settings['contact_image'], 'http') ? $settings['contact_image'] : asset('storage/' . $settings['contact_image']) }}" 
                                alt="Lead Photographer"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            >
                        @else
                             <img 
                                src="https://images.unsplash.com/photo-1554048612-b6a482bc67e5?q=80&w=2070&auto=format&fit=crop" 
                                alt="Lead Photographer"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            >
                        @endif
                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-500 flex items-end justify-center">
                            <div class="p-6 md:p-8 opacity-0 group-hover:opacity-100 translate-y-4 group-hover:translate-y-0 transition-all duration-500 text-center w-full">
                                <p class="font-display text-xl md:text-2xl text-white tracking-wide mb-2">Founder & Photographer</p>
                                <div class="w-12 h-px bg-gold-400 mx-auto mb-2"></div>
                                <p class="text-gold-400 text-xs tracking-widest uppercase">LIVESOSTORY.CO</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Decorative Element -->
                    <div class="absolute -z-10 w-full h-full border border-gold-500/10 -bottom-4 -right-4 transition-all duration-500 group-hover/profile:-bottom-6 group-hover/profile:-right-6"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-dark-900 border-t border-dark-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid md:grid-cols-3 gap-8 items-center">
                <div>
                    <a href="/" class="text-white tracking-ultra-wide text-sm font-light uppercase">LIVESOSTORY.CO</a>
                    <p class="text-gray-400 text-xs mt-2 font-light tracking-wide">Capturing moments, telling stories.</p>
                </div>
                <div class="flex justify-center space-x-8">
                    <a href="#home" class="text-xs tracking-widest uppercase text-gray-400 hover:text-gold-400 transition-colors duration-300">Home</a>
                    <a href="#portfolio" class="text-xs tracking-widest uppercase text-gray-400 hover:text-gold-400 transition-colors duration-300">Portfolio</a>
                    <a href="#packages" class="text-xs tracking-widest uppercase text-gray-400 hover:text-gold-400 transition-colors duration-300">Packages</a>
                    <a href="#contact" class="text-xs tracking-widest uppercase text-gray-400 hover:text-gold-400 transition-colors duration-300">Contact</a>
                </div>
                <div class="text-right">
                    <p class="text-gray-400/60 text-[10px] tracking-widest uppercase">&copy; {{ date('Y') }} LIVESOSTORY.CO. All rights reserved.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 100) {
                navbar.classList.remove('bg-transparent');
                navbar.classList.add('bg-dark-950/95', 'backdrop-blur-md', 'border-b', 'border-dark-800');
            } else {
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-dark-950/95', 'backdrop-blur-md', 'border-b', 'border-dark-800');
            }
        });

        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Swiper Initialization
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.package-swiper', {
                slidesPerView: 1.2,
                spaceBetween: 20,
                centeredSlides: false,
                loop: false,
                speed: 500,
                grabCursor: true,
                watchSlidesProgress: true,
                navigation: {
                    nextEl: '.swiper-button-next-custom',
                    prevEl: '.swiper-button-prev-custom',
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                    },
                },
            });
        });
    </script>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeIn 1s ease-out forwards; }
        .animate-fade-in-delay-1 { animation: fadeIn 1s ease-out 0.3s forwards; opacity: 0; }
        .animate-fade-in-delay-2 { animation: fadeIn 1s ease-out 0.6s forwards; opacity: 0; }
        .animate-fade-in-delay-3 { animation: fadeIn 1s ease-out 0.9s forwards; opacity: 0; }

        /* Simplified Swiper Styles */
        .swiper-slide {
            transition: transform 0.4s ease, opacity 0.4s ease;
        }
        .package-swiper {
            padding-bottom: 3rem !important;
            padding-top: 1rem !important;
        }
    </style>
</body>
</html>
