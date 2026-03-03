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
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="space-y-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="relative group">
                <x-text-input id="password" type="password" name="password" required autocomplete="current-password"
                    minlength="6" />
                <button type="button" onclick="togglePassword()"
                    class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gold-400 transition-colors p-1 group-focus-within:text-gold-400/50">
                    <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 011.563-3.04m2.458-2.388A9.987 9.987 0 0112 5c4.477 0 8.268 2.943 9.542 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21m-7-7l-3-3m0 0l-3-3m3 3l3 3" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="pt-4">
            <x-primary-button>
                {{ __('Secure Login') }}
            </x-primary-button>
        </div>

        <script>
            function togglePassword() {
                const passwordInput = document.getElementById('password');
                const eyeIcon = document.getElementById('eye-icon');
                const eyeOffIcon = document.getElementById('eye-off-icon');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    eyeIcon.classList.add('hidden');
                    eyeOffIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    eyeIcon.classList.remove('hidden');
                    eyeOffIcon.classList.add('hidden');
                }
            }
        </script>
    </form>

    <div class="mt-8 text-center">
        <a href="/"
            class="text-[10px] tracking-widest uppercase text-gray-500 hover:text-gold-400 transition-colors duration-300">
            &larr; Back to Home
        </a>
    </div>
</x-guest-layout>