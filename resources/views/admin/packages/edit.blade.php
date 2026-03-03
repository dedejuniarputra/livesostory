@extends('admin.layout')
@section('header', 'Edit Paket')
@section('content')

    <div class="max-w-2xl">
        <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Paket *</label>
                <input type="text" name="name" value="{{ old('name', $package->name) }}" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Kategori</label>
                <input type="text" name="category" value="{{ old('category', $package->category) }}"
                    placeholder="Contoh: Wedding, Pre-Wedding, Engagement"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Cover Image</label>
                @if($package->image)
                    <div class="mb-3 relative inline-block">
                        <img src="{{ asset('storage/' . $package->image) }}" alt="Current cover"
                            class="w-32 h-24 object-cover rounded border border-dark-700">
                        <span
                            class="absolute -top-1 -right-1 bg-green-500/20 text-green-400 text-[10px] px-1.5 py-0.5 rounded">Current</span>
                    </div>
                @endif
                <input type="file" name="image" accept="image/*"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:border-0 file:text-xs file:bg-gold-400 file:text-dark-950 file:rounded file:cursor-pointer">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                @error('image') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Deskripsi</label>
                <textarea name="description" rows="3"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none">{{ old('description', $package->description) }}</textarea>
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Harga (Rp) *</label>
                <input type="number" name="price" value="{{ old('price', $package->price) }}" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Fitur (satu per baris)</label>
                <textarea name="features" rows="5"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none">{{ old('features', is_array($package->features) ? implode("\n", $package->features) : $package->features) }}</textarea>
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Item Yang Didapat (Gambar)</label>

                @if($package->item_images)
                    <div class="grid grid-cols-4 gap-3 mb-4">
                        @foreach($package->item_images as $img)
                            <div class="relative aspect-square group">
                                <img src="{{ asset('storage/' . $img) }}"
                                    class="w-full h-full object-cover rounded border border-dark-600">
                            </div>
                        @endforeach
                    </div>
                @endif

                <input type="file" name="item_images[]" multiple accept="image/*"
                    class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gold-400/20 file:text-gold-400">
                <p class="text-[10px] text-gray-500 mt-1">Upload gambar baru akan menggantikan list gambar sebelumnya. Max
                    2MB per file.</p>
            </div>
            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $package->sort_order) }}"
                        class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                </div>
                <div class="flex items-end pb-1 gap-6">
                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" value="1" {{ $package->is_active ? 'checked' : '' }}
                            class="rounded bg-dark-800 border-dark-600 text-gold-400 focus:ring-gold-400">
                        <span class="text-sm text-gray-400">Active</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update</button>
                <a href="{{ route('admin.packages.index') }}"
                    class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
            </div>
        </form>
    </div>

@endsection