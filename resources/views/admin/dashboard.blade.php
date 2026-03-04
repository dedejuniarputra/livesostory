@extends('admin.layout')
@section('header', 'Dashboard')
@section('content')

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Bookings -->
        <div class="bg-blue-600/10 border border-blue-500/40 p-6 rounded-xl shadow-sm hover:border-blue-500 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 bg-blue-500/20 rounded-lg text-blue-400 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold mb-1 text-blue-400">{{ number_format($stats['total_bookings']) }}</div>
            <div class="text-[10px] text-blue-500/60 uppercase tracking-[2px] font-bold">Total Pesanan</div>
        </div>

        <!-- Total Revenue -->
        <div class="bg-emerald-600/10 border border-emerald-500/40 p-6 rounded-xl shadow-sm hover:border-emerald-500 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 bg-emerald-500/20 rounded-lg text-emerald-400 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold mb-1 text-emerald-400">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
            <div class="text-[10px] text-emerald-500/60 uppercase tracking-[2px] font-bold">Total Omset</div>
        </div>

        <!-- Total Packages -->
        <div class="bg-amber-600/10 border border-amber-500/40 p-6 rounded-xl shadow-sm hover:border-amber-500 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 bg-amber-500/20 rounded-lg text-amber-500 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold mb-1 text-amber-500">{{ number_format($stats['total_packages']) }}</div>
            <div class="text-[10px] text-amber-500/60 uppercase tracking-[2px] font-bold">Total Paket</div>
        </div>

        <!-- Portfolio Items -->
        <div class="bg-purple-600/10 border border-purple-500/40 p-6 rounded-xl shadow-sm hover:border-purple-500 transition-all group">
            <div class="flex items-center justify-between mb-4">
                <div class="p-2.5 bg-purple-500/20 rounded-lg text-purple-400 group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="text-3xl font-bold mb-1 text-purple-400">{{ number_format($stats['total_portfolios']) }}</div>
            <div class="text-[10px] text-purple-500/60 uppercase tracking-[2px] font-bold">Item Portofolio</div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-700 flex items-center justify-between">
            <h3 class="text-sm font-medium text-white">Pesanan Terakhir</h3>
            <a href="{{ route('admin.bookings.index') }}" class="text-xs text-gold-400 hover:text-gold-300">Lihat Semua
                →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-xs text-gray-500 uppercase tracking-wider text-left">
                        <th class="px-6 py-4">Client</th>
                        <th class="px-6 py-4">Paket</th>
                        <th class="px-6 py-4">Tanggal</th>
                        <th class="px-6 py-4 w-32 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-800">
                    @forelse($recentBookings as $booking)
                        <tr class="hover:bg-dark-800/30 transition-colors">
                            <td class="px-6 py-4">
                                <span class="text-sm text-white font-medium block">{{ $booking->name }}</span>
                                <span class="text-[10px] text-gray-500">{{ $booking->phone }}</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $booking->package->name ?? '-' }}</td>
                            <td class="px-6 py-4 text-sm text-gray-400">{{ $booking->booking_date->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-2 py-1 text-[10px] uppercase font-bold tracking-widest bg-green-500/10 text-green-400 border border-green-500/20 rounded-full">
                                    COMPLETED
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500 text-sm">Belum ada booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection