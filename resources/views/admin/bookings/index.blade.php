@extends('admin.layout')
@section('header', 'Booking Management')
@section('content')

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4 mb-8">
        <!-- Search & Filter -->
        <form action="{{ route('admin.bookings.index') }}" method="GET" class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 w-full lg:w-auto">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama client..."
                class="bg-dark-800/50 border border-dark-700 text-xs text-white rounded px-4 py-2 w-full sm:w-64 focus:border-gold-400 focus:ring-0">
            <input type="date" name="date" value="{{ request('date') }}"
                class="bg-dark-800/50 border border-dark-700 text-xs text-white rounded px-4 py-2 w-full sm:w-auto focus:border-gold-400 focus:ring-0">
            <button type="submit"
                class="px-4 py-2 bg-gold-400 text-dark-950 text-xs font-bold uppercase tracking-widest rounded hover:bg-gold-300 transition-colors">Cari</button>
            @if(request()->anyFilled(['search', 'date']))
                <a href="{{ route('admin.bookings.index') }}"
                    class="text-xs text-gray-500 hover:text-white transition-colors text-center sm:text-left">Reset</a>
            @endif
        </form>

        <!-- Actions -->
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.bookings.export-all-pdf') }}"
                class="flex-1 sm:flex-none px-4 py-2 bg-dark-800 border border-dark-700 text-white text-xs tracking-widest uppercase font-bold hover:bg-dark-700 rounded flex items-center justify-center gap-2 transition-colors">
                <svg class="w-4 h-4 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Print PDF
            </a>
            <form action="{{ route('admin.bookings.destroy-all') }}" method="POST"
                onsubmit="return confirm('Hapus SEMUA data booking?')" class="flex-1 sm:flex-none">
                @csrf @method('DELETE')
                <button type="submit"
                    class="w-full px-4 py-2 text-xs rounded border border-red-500/30 text-red-500/70 hover:bg-red-500/10 hover:text-red-400 uppercase tracking-widest font-bold transition-colors">Delete
                    All</button>
            </form>
        </div>
    </div>

    <div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-dark-700 bg-dark-900/50">
                        <th class="text-left px-6 py-4 whitespace-nowrap">Client</th>
                        <th class="text-left px-6 py-4 whitespace-nowrap">Package</th>
                        <th class="text-left px-6 py-4 whitespace-nowrap">Tanggal</th>
                        <th class="text-left px-6 py-4 whitespace-nowrap">Status</th>
                        <th class="text-left px-6 py-4 whitespace-nowrap text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-800">
                    @forelse($bookings as $booking)
                        <tr class="hover:bg-dark-800/30 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-dark-700 flex items-center justify-center text-[10px] font-bold text-gray-400 group-hover:bg-gold-400/20 group-hover:text-gold-400 transition-colors">
                                        {{ substr($booking->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-white">{{ $booking->name }}</p>
                                        <p class="text-[10px] text-gray-500">{{ $booking->phone }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400 whitespace-nowrap">{{ $booking->package->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400 whitespace-nowrap font-medium">{{ $booking->booking_date->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                            <span
                                class="px-3 py-1.5 text-[10px] uppercase font-bold tracking-widest bg-green-500/10 text-green-400 border border-green-500/20 rounded-full inline-block">
                                COMPLETED
                            </span>
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                    class="text-[10px] uppercase tracking-wider border border-dark-700 text-gray-400 px-3 py-1 rounded hover:bg-dark-700 hover:text-white transition-all">Detail</a>
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-[10px] uppercase tracking-wider border border-red-500/30 text-red-500/70 px-3 py-1 rounded hover:bg-red-500/10 hover:text-red-400 transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada booking.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $bookings->links() }}</div>

@endsection