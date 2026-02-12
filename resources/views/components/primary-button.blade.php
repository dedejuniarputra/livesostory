<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center w-full px-8 py-4 bg-gold-400 border border-transparent rounded-sm font-semibold text-xs text-dark-950 uppercase tracking-widest hover:bg-gold-500 focus:bg-gold-500 active:bg-gold-600 focus:outline-none transition-all duration-300']) }}>
    {{ $slot }}
</button>
