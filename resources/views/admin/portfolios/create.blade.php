@extends('admin.layout')
@section('header', 'Tambah Portfolio')
@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Judul *</label>
            <input type="text" name="title" value="{{ old('title') }}" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            @error('title') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Kategori</label>
            <input type="text" name="category" value="{{ old('category') }}" placeholder="e.g. Wedding, Prewedding, Engagement" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Gambar *</label>
            <input type="file" name="image" accept="image/*" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gold-400/20 file:text-gold-400">
            @error('image') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Urutan (1-5)</label>
            <input type="number" name="sort_order" min="1" max="5" value="{{ old('sort_order', 0) }}" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Simpan</button>
            <a href="{{ route('admin.portfolios.index') }}" class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
        </div>
    </form>
</div>

@endsection
