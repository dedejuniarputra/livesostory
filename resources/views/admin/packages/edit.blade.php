@extends('admin.layout')
@section('header', 'Edit Paket')
@section('content')

    <div class="max-w-2xl">
        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/50 rounded-md">
                <ul class="list-disc pl-5 text-sm text-red-400 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Paket *</label>
                <input type="text" name="name" value="{{ old('name', $package->name) }}" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Kategori *</label>
                <select name="category_id" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (old('category_id') ?? $package->category_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
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
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Harga DP (Rp) *</label>
                <input type="number" name="down_payment" value="{{ old('down_payment', $package->down_payment) }}" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Fitur (satu per baris)</label>
                <textarea name="features" rows="5"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none">{{ old('features', is_array($package->features) ? implode("\n", $package->features) : $package->features) }}</textarea>
            </div>

            <div>
                <label class="flex items-center gap-3">
                    <input type="checkbox" name="is_active" value="1" {{ $package->is_active ? 'checked' : '' }}
                        class="rounded bg-dark-800 border-dark-600 text-gold-400 focus:ring-gold-400">
                    <span class="text-sm text-gray-400">Active</span>
                </label>
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update</button>
                <a href="{{ route('admin.packages.index') }}"
                    class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('cover-input')?.addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('cover-preview-new');
            const previewImg = document.getElementById('cover-preview-img');
            if (file) {
                const reader = new FileReader();
                reader.onload = function (ev) {
                    previewImg.src = ev.target.result;
                    preview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
            }
        });
    </script>

@endsection