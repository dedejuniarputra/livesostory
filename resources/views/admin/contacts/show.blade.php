@extends('admin.layout')
@section('header', 'Detail Pesan')
@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.contacts.index') }}" class="text-xs text-gray-400 hover:text-gold-400 transition-colors mb-6 inline-block">← Kembali</a>

    <div class="bg-dark-800/50 border border-dark-700 p-6 rounded">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg">{{ $contact->name }}</h2>
                <p class="text-sm text-gray-400">{{ $contact->email }} {{ $contact->phone ? '• ' . $contact->phone : '' }}</p>
            </div>
            <p class="text-xs text-gray-500">{{ $contact->created_at->format('d F Y, H:i') }}</p>
        </div>

        <div class="border-t border-dark-700 pt-4">
            <p class="text-sm text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $contact->message }}</p>
        </div>
    </div>

    <div class="mt-4">
        <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Hapus pesan ini?')">
            @csrf @method('DELETE')
            <button class="px-4 py-2 border border-red-500/30 text-red-400 text-xs tracking-widest uppercase hover:bg-red-500/10 transition-colors rounded">Hapus Pesan</button>
        </form>
    </div>
</div>

@endsection
