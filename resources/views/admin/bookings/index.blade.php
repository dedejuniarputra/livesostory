@extends('admin.layout')
@section('header', 'Booking Management')
@section('content')

    <!-- Stats Summary (Filtered) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-emerald-600/10 border border-emerald-500/40 p-5 rounded-lg shadow-sm group">
            <div class="flex items-center gap-4">
                <div class="p-2 bg-emerald-500/20 rounded text-emerald-400">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <div class="text-xl font-bold text-emerald-400">Rp {{ number_format($totalOmset, 0, ',', '.') }}</div>
                    <div class="text-[10px] text-emerald-500/60 uppercase tracking-widest font-bold">Total Omset (Terfilter)
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <!-- Search & Filter -->
        <form action="{{ route('admin.bookings.index') }}" method="GET"
            class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 w-full lg:w-auto">
            <div class="relative w-full sm:w-64">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama client..."
                    class="bg-dark-800/50 border border-dark-700 text-[11px] md:text-xs text-white rounded px-4 py-2.5 w-full focus:border-gold-400 focus:ring-0">
            </div>
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <input type="date" name="date" value="{{ request('date') }}"
                    class="bg-dark-800/50 border border-dark-700 text-[11px] md:text-xs text-white rounded px-4 py-2.5 flex-1 sm:w-36 focus:border-gold-400 focus:ring-0 [color-scheme:dark]">
                <input type="month" name="month" value="{{ request('month') }}"
                    class="bg-dark-800/50 border border-dark-700 text-[11px] md:text-xs text-white rounded px-4 py-2.5 flex-1 sm:w-40 focus:border-gold-400 focus:ring-0 [color-scheme:dark]">
            </div>
            <div class="flex items-center gap-3">
                <button type="submit"
                    class="px-6 py-2.5 bg-gold-400 text-dark-950 text-[10px] md:text-xs font-bold uppercase tracking-widest rounded hover:bg-gold-300 transition-colors flex-1 sm:flex-none">Cari</button>
                @if(request()->anyFilled(['search', 'date', 'month']))
                    <a href="{{ route('admin.bookings.index') }}"
                        class="text-[10px] md:text-xs text-gray-500 hover:text-white transition-colors whitespace-nowrap">Reset</a>
                @endif
            </div>
        </form>

        <!-- Actions -->
        <div class="flex items-center gap-3 w-full lg:w-auto">
            <a href="{{ route('admin.bookings.export-all-pdf', request()->query()) }}"
                class="flex-1 lg:flex-none px-4 py-2.5 bg-dark-800 border border-dark-700 text-white text-[10px] md:text-xs tracking-widest uppercase font-bold hover:bg-dark-700 rounded flex items-center justify-center gap-2 transition-colors">
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

    <div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden shadow-sm">
        <div class="w-full overflow-x-auto scrollbar-thin scrollbar-thumb-dark-700">
            <table class="min-w-[800px] w-full">
            <thead>
                <tr
                    class="text-[10px] md:text-xs text-gray-500 uppercase tracking-widest border-b border-dark-700 bg-dark-900/40">
                    <th class="text-left px-6 py-4 whitespace-nowrap font-bold">Client</th>
                    <th class="text-left px-6 py-4 whitespace-nowrap font-bold">IG</th>
                    <th class="text-left px-6 py-4 whitespace-nowrap font-bold">Package</th>
                    <th class="text-left px-6 py-4 whitespace-nowrap font-bold">Jadwal</th>
                    <th class="text-left px-6 py-4 whitespace-nowrap font-bold">Bayar</th>
                    <th class="text-left px-6 py-4 whitespace-nowrap font-bold text-center">Status</th>
                    <th class="px-6 py-4 whitespace-nowrap text-right font-bold">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-800">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-dark-800/30 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div
                                    class="w-8 h-8 rounded-full bg-dark-700 flex items-center justify-center text-[10px] font-bold text-gray-400 group-hover:bg-gold-400/20 group-hover:text-gold-400 transition-colors">
                                    {{ substr($booking->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-white leading-none mb-1">{{ $booking->name }}</p>
                                    <p class="text-[10px] text-gray-500 leading-none">{{ $booking->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gold-400 font-medium italic whitespace-nowrap">
                            {{ $booking->ig_username ? (str_starts_with($booking->ig_username, '@') ? $booking->ig_username : '@' . $booking->ig_username) : '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400 whitespace-nowrap">
                            {{ $booking->package->name ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-400 whitespace-nowrap">
                            <span class="font-medium text-white">{{ $booking->booking_date->format('d M Y') }}</span><br>
                            <span class="text-[10px] text-gray-500">Jam: {{ $booking->booking_time ?? '-' }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <p class="text-[10px] uppercase font-bold text-gray-400 leading-none mb-1">
                                {{ $booking->payment_type }}</p>
                            <p class="text-sm text-gold-400 font-medium">Rp
                                {{ number_format($booking->amount_to_pay, 0, ',', '.') }}</p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($booking->status === 'pending')
                                @if($booking->created_at->diffInMinutes(now()) > 10)
                                    <span class="px-3 py-1.5 text-[10px] uppercase font-bold tracking-widest bg-red-500/5 text-red-400/80 border border-red-500/10 rounded-full inline-block">
                                        EXPIRED
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 text-[10px] uppercase font-bold tracking-widest bg-yellow-500/5 text-yellow-400/80 border border-yellow-500/10 rounded-full inline-block">
                                        PENDING
                                    </span>
                                @endif
                            @elseif($booking->status === 'completed')
                                <span class="px-3 py-1.5 text-[10px] uppercase font-bold tracking-widest bg-emerald-500/5 text-emerald-400/80 border border-emerald-500/10 rounded-full inline-block">
                                    COMPLETED
                                </span>
                            @else
                                <span class="px-3 py-1.5 text-[10px] uppercase font-bold tracking-widest bg-gray-500/5 text-gray-400/80 border border-gray-500/10 rounded-full inline-block">
                                    {{ $booking->status }}
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-3">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('admin.bookings.export-invoice', $booking) }}"
                                    class="text-[10px] uppercase tracking-wider bg-gold-400/10 border border-gold-400/30 text-gold-400 px-3 py-1.5 rounded hover:bg-gold-400/20 transition-all font-bold">
                                    Cetak Invoice
                                </a>
                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                    class="text-[10px] uppercase tracking-wider border border-dark-700 text-gray-400 px-3 py-1.5 rounded hover:bg-dark-700 hover:text-white transition-all">Detail</a>
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-[10px] uppercase tracking-wider border border-red-500/30 text-red-500/70 px-3 py-1.5 rounded hover:bg-red-500/10 hover:text-red-400 transition-all">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada booking.</td>
                    </tr>
                @endforelse
            </tbody>
            </table>
        </div>
    </div>

        <div class="mt-4">{{ $bookings->links() }}</div>

@endsection