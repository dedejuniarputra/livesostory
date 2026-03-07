@extends('admin.layout')
@section('header', 'Category Management')
@section('content')

    <div class="flex items-center justify-between mb-6">
        <p class="text-gray-400 text-sm">Kelola kategori paket photography</p>
        <a href="{{ route('admin.categories.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">
            + Tambah
        </a>
    </div>

    <div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
        <div class="w-full overflow-x-auto scrollbar-thin scrollbar-thumb-dark-700 -mx-px">
            <div class="inline-block min-w-full align-middle">
                <table class="w-full min-w-[700px]">
                    <thead>
                        <tr class="border-b border-dark-800">
                            <th class="text-left py-3 px-4 text-xs uppercase tracking-widest text-gray-500 font-medium">#
                            </th>
                            <th class="text-left py-3 px-4 text-xs uppercase tracking-widest text-gray-500 font-medium">
                                Gambar</th>
                            <th class="text-left py-3 px-4 text-xs uppercase tracking-widest text-gray-500 font-medium">Nama
                            </th>
                            <th class="text-left py-3 px-4 text-xs uppercase tracking-widest text-gray-500 font-medium">
                                Jumlah Paket</th>
                            <th class="text-left py-3 px-4 text-xs uppercase tracking-widest text-gray-500 font-medium">
                                Status</th>
                            <th class="text-right py-3 px-4 text-xs uppercase tracking-widest text-gray-500 font-medium">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $cat)
                            <tr class="border-b border-dark-800/50 hover:bg-dark-800/30 transition-colors">
                                <td class="py-3 px-4 text-gray-500">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">
                                    @if($cat->image)
                                        <img src="{{ asset('storage/' . $cat->image) }}" alt="{{ $cat->name }}"
                                            class="w-16 h-12 object-cover rounded border border-dark-700">
                                    @else
                                        <div
                                            class="w-16 h-12 bg-dark-800 rounded border border-dark-700 flex items-center justify-center">
                                            <svg class="w-5 h-5 text-dark-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-white font-medium">{{ $cat->name }}</td>
                                <td class="py-3 px-4">
                                    <span class="inline-flex items-center gap-1 text-xs text-gold-400">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                        </svg>
                                        {{ $cat->packages_count }} paket
                                    </span>
                                </td>
                                <td class="py-3 px-4">
                                    @if($cat->is_active)
                                        <span
                                            class="inline-block px-2 py-0.5 text-[10px] bg-green-500/10 text-green-400 rounded uppercase tracking-wider">Active</span>
                                    @else
                                        <span
                                            class="inline-block px-2 py-0.5 text-[10px] bg-red-500/10 text-red-400 rounded uppercase tracking-wider">Inactive</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.categories.edit', $cat) }}"
                                            class="p-1.5 text-gray-500 hover:text-gold-400 transition-colors" title="Edit">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $cat) }}" method="POST"
                                            onsubmit="return confirm('Hapus kategori ini? Paket terkait tidak akan dihapus.')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="p-1.5 text-gray-500 hover:text-red-400 transition-colors" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-12 text-center text-gray-500">Belum ada kategori.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection