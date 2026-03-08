@extends('admin.layout')
@section('header', 'Settings')
@section('content')

    <div class="max-w-2xl">
        @if(session('success'))
            <div class="bg-green-500/10 border border-green-500/50 text-green-400 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-500/10 border border-red-500/50 text-red-400 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf @method('PUT')

            <!-- Hero Section -->
            <div class="bg-dark-800/50 border border-dark-700 p-6 rounded">
                <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-6">Hero Section</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Judul</label>
                        <input type="text" name="hero_title" value="{{ $settings['hero_title'] }}"
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                    </div>
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Subtitle</label>
                        <input type="text" name="hero_subtitle" value="{{ $settings['hero_subtitle'] }}"
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                    </div>
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Background Image</label>
                        @if($settings['hero_image'])
                            <div class="mb-3 relative">
                                <img src="{{ str_starts_with($settings['hero_image'], 'http') ? $settings['hero_image'] : asset('storage/' . $settings['hero_image']) }}"
                                    class="w-full max-h-48 object-cover rounded">
                                <div class="mt-2 text-right">
                                    <button type="button" onclick="document.getElementById('delete-hero-form').submit()"
                                        class="px-3 py-1.5 bg-red-500/20 text-red-400 text-xs tracking-widest uppercase hover:bg-red-500/30 transition-colors rounded">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                        @endif
                        <label
                            class="block text-xs tracking-widest uppercase text-gray-400 mb-2">{{ $settings['hero_image'] ? 'Ganti Gambar' : 'Upload Gambar' }}</label>
                        <input type="file" name="hero_image" accept="image/*" id="hero_image_input"
                            onchange="previewImage(this, 'hero_image_preview')"
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gold-400/20 file:text-gold-400">
                        <div id="hero_image_preview_container" class="mt-3 hidden">
                            <p class="text-[10px] tracking-widest uppercase text-gold-400 mb-1">Preview Gambar Baru</p>
                            <img id="hero_image_preview" src="#" alt="Preview"
                                class="w-full max-h-48 object-cover rounded border border-gold-400/30">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WebP (max 10MB)</p>
                    </div>
                </div>
            </div>

            <!-- Contact Settings -->
            <div class="bg-dark-800/50 border border-dark-700 p-6 rounded">
                <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-6">Contact Information</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Contact Image (Right
                            Side)</label>
                        @if($settings['contact_image'])
                            <div class="mb-3 relative">
                                <img src="{{ str_starts_with($settings['contact_image'], 'http') ? $settings['contact_image'] : asset('storage/' . $settings['contact_image']) }}"
                                    class="w-full max-h-48 object-cover rounded">
                                <div class="mt-2 text-right">
                                    <button type="button" onclick="document.getElementById('delete-contact-form').submit()"
                                        class="px-3 py-1.5 bg-red-500/20 text-red-400 text-xs tracking-widest uppercase hover:bg-red-500/30 transition-colors rounded">
                                        Hapus Gambar
                                    </button>
                                </div>
                            </div>
                        @endif
                        <label
                            class="block text-xs tracking-widest uppercase text-gray-400 mb-2">{{ $settings['contact_image'] ? 'Ganti Gambar' : 'Upload Gambar' }}</label>
                        <input type="file" name="contact_image" accept="image/*" id="contact_image_input"
                            onchange="previewImage(this, 'contact_image_preview')"
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded file:mr-4 file:py-1 file:px-3 file:rounded file:border-0 file:text-xs file:bg-gold-400/20 file:text-gold-400">
                        <div id="contact_image_preview_container" class="mt-3 hidden">
                            <p class="text-[10px] tracking-widest uppercase text-gold-400 mb-1">Preview Gambar Baru</p>
                            <img id="contact_image_preview" src="#" alt="Preview"
                                class="w-full max-h-48 object-cover rounded border border-gold-400/30">
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, WebP (max 10MB)</p>
                    </div>

                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">WhatsApp Number</label>
                        <input type="text" name="whatsapp_number" value="{{ $settings['whatsapp_number'] }}"
                            placeholder="62812xxxxxxxx"
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
                        <p class="text-xs text-gray-500 mt-1">Format: 628xxxx (tanpa + atau 0)</p>
                    </div>
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Instagram URL</label>
                        <input type="url" name="instagram" value="{{ $settings['instagram'] }}"
                            placeholder="https://www.instagram.com/livesostory.co"
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
                        <p class="text-xs text-gray-500 mt-1">Masukkan link lengkap profil Instagram Anda.</p>
                    </div>
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">TikTok URL</label>
                        <input type="url" name="tiktok" value="{{ $settings['tiktok'] ?? '' }}"
                            placeholder="https://www.tiktok.com/@akangfotoo"
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
                        <p class="text-xs text-gray-500 mt-1">Masukkan link lengkap profil TikTok Anda.</p>
                    </div>



                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Payment Instructions
                            (Catatan Penting)</label>
                        <textarea name="payment_instructions" rows="6"
                            placeholder="• Transfer sesuai nominal...&#10;• Konfirmasi via WhatsApp..."
                            class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded resize-none">{{ $settings['payment_instructions'] }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Gunakan • (bullet) untuk setiap poin catatan. Teks ini akan
                            muncul di halaman pembayaran.</p>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Simpan
                Pengaturan</button>
        </form>
    </div>

@endsection

@push('scripts')
    <form id="delete-hero-form" action="{{ route('admin.settings.delete-hero-image') }}" method="POST"
        style="display: none;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
        @csrf @method('DELETE')
    </form>
    <form id="delete-contact-form" action="{{ route('admin.settings.delete-contact-image') }}" method="POST"
        style="display: none;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')">
        @csrf @method('DELETE')
    </form>

    <script>
        function previewImage(input, previewId) {
            const previewContainer = document.getElementById(previewId + '_container');
            const previewImage = document.getElementById(previewId);

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    previewImage.src = e.target.result;
                    previewContainer.classList.remove('hidden');
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                previewImage.src = '#';
                previewContainer.classList.add('hidden');
            }
        }
    </script>
@endpush