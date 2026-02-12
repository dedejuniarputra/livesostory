@extends('admin.layout')
@section('header', 'Portfolio Management')
@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">Kelola gambar portfolio</p>
    <a href="{{ route('admin.portfolios.create') }}" class="px-4 py-2 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">+ Tambah</a>
</div>

<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
    @forelse($portfolios as $portfolio)
        <div class="group relative bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
            <img src="{{ str_starts_with($portfolio->image_path, 'http') ? $portfolio->image_path : asset('storage/' . $portfolio->image_path) }}" alt="{{ $portfolio->title }}" class="w-full aspect-square object-cover">
            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/60 transition-all duration-300 flex items-center justify-center">
                <div class="hidden group-hover:flex gap-2">
                    <a href="{{ route('admin.portfolios.edit', $portfolio) }}" class="px-3 py-1.5 bg-white/10 text-white text-xs rounded hover:bg-white/20 transition-colors">Edit</a>
                    <form action="{{ route('admin.portfolios.destroy', $portfolio) }}" method="POST" onsubmit="return confirm('Hapus portfolio ini?')">
                        @csrf @method('DELETE')
                        <button class="px-3 py-1.5 bg-red-500/20 text-red-400 text-xs rounded hover:bg-red-500/30 transition-colors">Hapus</button>
                    </form>
                </div>
            </div>
            <div class="p-3">
                <p class="text-sm text-white truncate">{{ $portfolio->title }}</p>
                <p class="text-xs text-gray-500">{{ $portfolio->category ?? 'Uncategorized' }}</p>
                @if(!$portfolio->is_active)
                    <span class="text-xs text-yellow-400">Inactive</span>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center text-gray-500">
            <p class="mb-4">Belum ada portfolio.</p>
            <a href="{{ route('admin.portfolios.create') }}" class="text-gold-400 text-sm hover:text-gold-300">Tambah portfolio pertama →</a>
        </div>
    @endforelse
</div>

@endsection
