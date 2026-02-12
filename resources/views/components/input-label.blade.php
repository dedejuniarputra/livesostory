@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-light text-[10px] tracking-widest uppercase text-gray-500 mb-2']) }}>
    {{ $value ?? $slot }}
</label>
