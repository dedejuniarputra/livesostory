@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-gold-400 border border-gold-400/20 bg-gold-400/5 px-4 py-3 rounded-sm italic']) }}>
        {{ $status }}
    </div>
@endif
