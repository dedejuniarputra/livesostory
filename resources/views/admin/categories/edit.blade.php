@extends('admin.layout')
@section('header', 'Edit Kategori')
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

        <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf @method('PUT')
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Kategori *</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                @error('name') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Gambar Kategori</label>
                @if($category->image)
                    <div class="mb-5 relative group inline-block overflow-hidden rounded border border-dark-700 bg-dark-900">
                        <img src="{{ asset('storage/' . $category->image) }}" alt="Current image"
                            class="w-full max-w-md h-auto object-contain transition-all duration-300 group-hover:brightness-50 group-hover:scale-105">
                        <div
                            class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <form action="{{ route('admin.categories.delete-image', $category) }}" method="POST"
                                onsubmit="return confirm('Hapus cover gambar kategori ini?')">
                                @csrf @method('DELETE')
                                <button type="submit"
                                    class="px-5 py-2.5 bg-red-500/20 hover:bg-red-500/40 border border-red-500/30 text-red-400 backdrop-blur-sm rounded duration-300 mx-1 flex items-center transition-transform hover:scale-105"
                                    title="Hapus Gambar">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
                <div id="image-preview" class="mb-3 hidden">
                    <img id="image-preview-img" src="" alt="Preview"
                        class="w-full max-w-md h-auto object-contain rounded border border-dark-700 bg-dark-900">
                    <span class="inline-block mt-1 bg-blue-500/20 text-blue-400 text-[10px] px-1.5 py-0.5 rounded">Preview
                        Baru</span>
                </div>
                <input type="file" name="image" accept="image/*" id="image-input"
                    class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:border-0 file:text-xs file:bg-gold-400 file:text-dark-950 file:rounded file:cursor-pointer">
                <p class="text-xs text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar</p>
                @error('image') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Urutan</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}"
                        class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                </div>
                <div class="flex items-end pb-1 gap-6">
                    <label class="flex items-center gap-3">
                        <input type="checkbox" name="is_active" value="1" {{ $category->is_active ? 'checked' : '' }}
                            class="rounded bg-dark-800 border-dark-600 text-gold-400 focus:ring-gold-400">
                        <span class="text-sm text-gray-400">Active</span>
                    </label>
                </div>
            </div>
            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update</button>
                <a href="{{ route('admin.categories.index') }}"
                    class="px-6 py-3 border border-dark-600 text-gray-400 text-xs tracking-widest uppercase hover:text-white transition-colors rounded">Batal</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('image-input')?.addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('image-preview');
            const previewImg = document.getElementById('image-preview-img');
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