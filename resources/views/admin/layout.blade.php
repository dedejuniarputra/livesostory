<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin') — LIVESOSTORY.CO</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-950 text-white font-sans antialiased">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-dark-900 border-r border-dark-800 transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="px-6 h-16 flex items-center border-b border-dark-800 bg-dark-950">
                    <a href="/" class="text-gold-400 tracking-ultra-wide text-xs font-light uppercase">LIVESOSTORY.CO</a>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-gold-400/10 text-gold-400' : 'text-gray-400 hover:text-white hover:bg-dark-800' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.portfolios.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm {{ request()->routeIs('admin.portfolios.*') ? 'bg-gold-400/10 text-gold-400' : 'text-gray-400 hover:text-white hover:bg-dark-800' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Portfolio
                    </a>
                    <a href="{{ route('admin.packages.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm {{ request()->routeIs('admin.packages.*') ? 'bg-gold-400/10 text-gold-400' : 'text-gray-400 hover:text-white hover:bg-dark-800' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Packages
                    </a>
                    <a href="{{ route('admin.bookings.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm {{ request()->routeIs('admin.bookings.*') ? 'bg-gold-400/10 text-gold-400' : 'text-gray-400 hover:text-white hover:bg-dark-800' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        Bookings
                    </a>
                    <a href="{{ route('admin.schedules.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm {{ request()->routeIs('admin.schedules.*') ? 'bg-gold-400/10 text-gold-400' : 'text-gray-400 hover:text-white hover:bg-dark-800' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Schedules
                    </a>
                    <a href="{{ route('admin.payment-accounts.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm {{ request()->routeIs('admin.payment-accounts.*') ? 'bg-gold-400/10 text-gold-400' : 'text-gray-400 hover:text-white hover:bg-dark-800' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                        Payment
                    </a>
                    <a href="{{ route('admin.settings.index') }}"
                       class="flex items-center gap-3 px-3 py-2.5 rounded text-sm {{ request()->routeIs('admin.settings.*') ? 'bg-gold-400/10 text-gold-400' : 'text-gray-400 hover:text-white hover:bg-dark-800' }} transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Settings
                    </a>
                </nav>

                <!-- User Info -->
                <div class="px-4 py-4 border-t border-dark-800">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 bg-gold-400/20 rounded-full flex items-center justify-center">
                            <span class="text-gold-400 text-xs font-semibold">{{ substr(auth()->user()->name, 0, 1) }}</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-500">Admin</p>
                        </div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-500 hover:text-red-400 transition-colors" title="Logout">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Sidebar Overlay (mobile) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden" onclick="toggleSidebar()"></div>

        <!-- Main Content -->
        <div class="flex-1 lg:ml-64">
            <!-- Top Bar -->
            <header class="sticky top-0 z-30 bg-dark-950/80 backdrop-blur-md border-b border-dark-800 h-16 flex items-center px-6">
                <button onclick="toggleSidebar()" class="lg:hidden mr-4 text-gray-400 hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
                <h1 class="text-sm font-light tracking-widest uppercase text-gray-400">@yield('header', 'Dashboard')</h1>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-400 text-sm rounded flex items-center gap-2">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }
    </script>
    
    {{-- Auto-logout after 5 hours of inactivity --}}
    <x-auto-logout :timeout="18000" :warningBefore="30" />
    
    @stack('scripts')
</body>
</html>
