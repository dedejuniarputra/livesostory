@extends('admin.layout')
@section('header', 'Edit Portfolio')
@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.portfolios.update', $portfolio) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf @method('PUT')
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Judul *</label>
            <input type="text" name="title" value="{{ old('title', $portfolio->title) }}" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Kategori</label>
            <input type="text" name="category" value="{{ old('category', $portfolio->category) }}" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Gambar Saat Ini</label>
            <img src="{{ str_starts_with($portfolio->image_path, 'http') ? $portfolio->image_path : asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-48 h-48 object-cover rounded mb-3">
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Ganti Gambar</label>
            <input type="file" name="image" accept="image/*" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gold-400/20 file:text-gold-400">
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Urutan (1-5)</label>
            <input type="number" name="sort_order" min="1" max="5" value="{{ old('sort_order', $portfolio->sort_order) }}" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>
        <div class="flex items-center gap-3">
            <input type="checkbox" name="is_active" id="is_active" value="1" {{ $portfolio->is_active ? 'checked' : '' }} class="rounded bg-dark-800 border-dark-600 text-gold-400 focus:ring-gold-400">
            <label for="is_active" class="text-sm text-gray-400">Active</label>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update</button>
            <a href="{{ route('admin.portfolios.index') }}" class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
        </div>
    </form>
</div>

@endsection
