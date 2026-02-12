@extends('admin.layout')
@section('header', 'Edit Paket')
@section('content')

<div class="max-w-2xl">
    <form action="{{ route('admin.packages.update', $package) }}" method="POST" class="space-y-6">
        @csrf @method('PUT')
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Paket *</label>
            <input type="text" name="name" value="{{ old('name', $package->name) }}" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Deskripsi</label>
            <textarea name="description" rows="3" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none">{{ old('description', $package->description) }}</textarea>
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Harga (Rp) *</label>
            <input type="number" name="price" value="{{ old('price', $package->price) }}" required class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
        </div>
        <div>
            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Fitur (satu per baris)</label>
            <textarea name="features" rows="5" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none">{{ old('features', is_array($package->features) ? implode("\n", $package->features) : $package->features) }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Urutan</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $package->sort_order) }}" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            </div>
            <div class="flex items-end pb-1 gap-6">
                <label class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" value="1" {{ $package->is_active ? 'checked' : '' }} class="rounded bg-dark-800 border-dark-600 text-gold-400 focus:ring-gold-400">
                    <span class="text-sm text-gray-400">Active</span>
                </label>
            </div>
        </div>
        <div class="flex gap-3">
            <button type="submit" class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update</button>
            <a href="{{ route('admin.packages.index') }}" class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
        </div>
    </form>
</div>

@endsection
