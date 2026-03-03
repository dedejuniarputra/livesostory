<nav id="navbar" {{ $attributes->merge(['class' => 'fixed top-0 left-0 right-0 z-50 transition-all duration-500']) }}>
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center">
                <img src="{{ asset('build/assets/logo.png') }}" alt="LIVESOSTORY.CO" class="h-8 md:h-10 w-auto">
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-10">
                <a href="{{ url('/') }}#home"
                    class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Home</a>
                <a href="{{ url('/') }}#packages"
                    class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Booking</a>
                <a href="{{ url('/') }}#portfolio"
                    class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Portfolio</a>
                <a href="{{ url('/') }}#contact"
                    class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Contact</a>
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase hover:bg-gold-400 hover:text-dark-950 transition-all duration-300">Dashboard</a>
                    @else
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit"
                                class="text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors duration-300">Logout</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}"
                        class="px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase hover:bg-gold-400 hover:text-dark-950 transition-all duration-300">Login</a>
                @endauth
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-dark-950/95 backdrop-blur-md border-t border-dark-800">
        <div class="px-6 py-6 space-y-4">
            <a href="{{ url('/') }}#home"
                class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Home</a>
            <a href="{{ url('/') }}#portfolio"
                class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Portfolio</a>
            <a href="{{ url('/') }}#packages"
                class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Booking</a>
            <a href="{{ url('/') }}#contact"
                class="block text-xs tracking-widest uppercase text-gray-300 hover:text-gold-400 transition-colors">Contact</a>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}"
                        class="block px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase text-center">Dashboard</a>
                @endif
            @else
                <a href="{{ route('login') }}"
                    class="block px-5 py-2 border border-gold-400 text-gold-400 text-xs tracking-widest uppercase text-center">Login</a>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Navbar scroll effect logic (mostly for landing page)
    const navbar = document.getElementById('navbar');
    if (navbar && window.location.pathname === '/') {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('bg-dark-950/95', 'backdrop-blur-md', 'border-b', 'border-dark-800');
                navbar.classList.remove('bg-transparent');
            } else {
                navbar.classList.add('bg-transparent');
                navbar.classList.remove('bg-dark-950/95', 'backdrop-blur-md', 'border-b', 'border-dark-800');
            }
        });
    }

    // Mobile menu toggle
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener('click', function () {
            const menu = document.getElementById('mobile-menu');
            if (menu) menu.classList.toggle('hidden');
        });
    }
</script>