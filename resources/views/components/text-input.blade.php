@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-4 focus:border-gold-400 focus:ring-0 transition-colors placeholder-gray-600 rounded-sm']) !!}>
