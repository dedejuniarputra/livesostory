<x-guest-layout>
    <div class="mb-10 text-center">
        <h2 class="text-2xl font-light tracking-widest uppercase text-white mb-3">{{ __('Admin Login') }}</h2>
        <div class="w-12 h-px bg-gold-400/50 mx-auto"></div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="space-y-4">
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" />
            </div>

            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded-sm border-white/10 bg-dark-800 text-gold-400 shadow-sm focus:ring-gold-400/50 focus:ring-offset-dark-950" name="remember">
                <span class="ms-3 text-xs text-gray-500 group-hover:text-gray-300 transition-colors duration-300 uppercase tracking-widest">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="pt-2">
            <x-primary-button>
                {{ __('Secure Login') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-8 text-center">
        <a href="/" class="text-[10px] tracking-widest uppercase text-gray-500 hover:text-gold-400 transition-colors duration-300">
            &larr; Back to Home
        </a>
    </div>
</x-guest-layout>
