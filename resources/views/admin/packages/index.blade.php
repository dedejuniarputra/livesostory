@extends('admin.layout')
@section('header', 'Package Management')
@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-sm text-gray-400">Kelola paket photography</p>
    <a href="{{ route('admin.packages.create') }}" class="px-4 py-2 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">+ Tambah</a>
</div>

<div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
    <table class="w-full">
        <thead>
            <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-dark-700">
                <th class="text-left px-6 py-3">#</th>
                <th class="text-left px-6 py-3">Nama Paket</th>
                <th class="text-left px-6 py-3">Harga</th>
                <th class="text-left px-6 py-3">Status</th>
                <th class="text-left px-6 py-3">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-dark-800">
            @forelse($packages as $package)
                <tr class="hover:bg-dark-800/30 transition-colors">
                    <td class="px-6 py-3 text-sm text-gray-500">{{ $loop->iteration }}</td>
                    <td class="px-6 py-3">
                        <div>
                            <p class="text-sm text-white">{{ $package->name }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-3 text-sm">{{ $package->formatted_price }}</td>
                    <td class="px-6 py-3">
                        @if($package->is_active)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-500/20 text-green-400">Active</span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-500/20 text-gray-400">Inactive</span>
                        @endif
                    </td>
                    <td class="px-6 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.packages.edit', $package) }}" class="px-3 py-1 text-xs text-gray-400 hover:text-white border border-dark-600 rounded hover:border-dark-500 transition-colors">Edit</a>
                            <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 text-xs text-red-400 hover:text-red-300 border border-red-500/20 rounded hover:border-red-500/30 transition-colors">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada paket.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
