@extends('admin.layout')
@section('header', 'Tambah Paket')
@section('content')

    <div class="max-w-2xl">
        <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Paket *</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Kategori</label>
                <input type="text" name="category" value="{{ old('category') }}"
                    placeholder="Contoh: Wedding, Pre-Wedding, Engagement"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
                @error('category') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Cover Image</label>
                <input type="file" name="image" accept="image/*"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:border-0 file:text-xs file:bg-gold-400 file:text-dark-950 file:rounded file:cursor-pointer">
                @error('image') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none">{{ old('description') }}</textarea>
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price') }}" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                @error('price') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Fitur (satu per baris)</label>
                <textarea name="features" rows="5"
                    placeholder="1 Hour Photo Session&#10;30 Edited Photos&#10;Online Gallery"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none placeholder-gray-600">{{ old('features') }}</textarea>
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Item Yang Didapat (Gambar)</label>
                <input type="file" name="item_images[]" multiple accept="image/*"
                    class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gold-400/20 file:text-gold-400">
                <p class="text-[10px] text-gray-500 mt-1">Upload beberapa gambar produk (album, cetak, dll). Max 2MB per
                    file.</p>
            </div>
            <div class="gap-6">
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                        class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Simpan</button>
                <a href="{{ route('admin.packages.index') }}"
                    class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
            </div>
        </form>
    </div>

@endsection