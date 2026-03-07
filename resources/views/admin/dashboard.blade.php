@extends('admin.layout')
@section('header', 'Dashboard')
@section('content')

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">
        <!-- Total Bookings -->
        <div
            class="bg-blue-600/10 border border-blue-500/40 p-3 md:p-6 rounded-xl shadow-sm hover:border-blue-500 transition-all group">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div
                    class="p-2 md:p-2.5 bg-blue-500/20 rounded-lg text-blue-400 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="text-lg md:text-3xl font-bold mb-0.5 text-blue-400">{{ number_format($stats['total_bookings']) }}
            </div>
            <div class="text-[8px] md:text-[10px] text-blue-500/60 uppercase tracking-widest font-bold">
                Total Pesanan</div>
        </div>

        <!-- Total Revenue -->
        <div
            class="bg-emerald-600/10 border border-emerald-500/40 p-3 md:p-6 rounded-xl shadow-sm hover:border-emerald-500 transition-all group">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div
                    class="p-2 md:p-2.5 bg-emerald-500/20 rounded-lg text-emerald-400 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="text-lg md:text-3xl font-bold mb-0.5 text-emerald-400">Rp
                {{ number_format($stats['total_revenue'], 0, ',', '.') }}
            </div>
            <div class="text-[8px] md:text-[10px] text-emerald-500/60 uppercase tracking-widest font-bold">
                Total Omset</div>
        </div>

        <!-- Total Packages -->
        <div
            class="bg-amber-600/10 border border-amber-500/40 p-3 md:p-6 rounded-xl shadow-sm hover:border-amber-500 transition-all group">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div
                    class="p-2 md:p-2.5 bg-amber-500/20 rounded-lg text-amber-500 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
            </div>
            <div class="text-lg md:text-3xl font-bold mb-0.5 text-amber-500">{{ number_format($stats['total_packages']) }}
            </div>
            <div class="text-[8px] md:text-[10px] text-amber-500/60 uppercase tracking-widest font-bold">
                Total Paket</div>
        </div>

        <!-- Portfolio Items -->
        <div
            class="bg-purple-600/10 border border-purple-500/40 p-3 md:p-6 rounded-xl shadow-sm hover:border-purple-500 transition-all group">
            <div class="flex items-center justify-between mb-3 md:mb-4">
                <div
                    class="p-2 md:p-2.5 bg-purple-500/20 rounded-lg text-purple-400 group-hover:scale-110 transition-transform">
                    <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
            <div class="text-lg md:text-3xl font-bold mb-0.5 text-purple-400">
                {{ number_format($stats['total_portfolios']) }}
            </div>
            <div class="text-[8px] md:text-[10px] text-gray-500 uppercase tracking-widest font-bold">
                Item Portofolio</div>
        </div>
    </div>

    <!-- Recent Bookings -->
    <div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
        <div class="px-6 py-4 border-b border-dark-700 flex items-center justify-between">
            <h3 class="text-xs md:text-sm font-medium text-white uppercase tracking-wider">Pesanan Terakhir</h3>
            <a href="{{ route('admin.bookings.index') }}"
                class="text-[10px] md:text-xs text-gold-400 hover:text-gold-300">Lihat Semua
                →</a>
        </div>
        <div class="w-full overflow-x-auto scrollbar-thin scrollbar-thumb-dark-700 -mx-px">
            <table class="min-w-[700px] w-full">
                <thead>
                    <tr
                        class="text-[10px] md:text-xs text-gray-500 uppercase tracking-widest border-b border-dark-700 bg-dark-900/40">
                        <th class="px-6 py-4 text-left font-bold">Client</th>
                        <th class="px-6 py-4 text-left font-bold">IG</th>
                        <th class="px-6 py-4 text-left font-bold">Package</th>
                        <th class="px-6 py-4 text-left font-bold">Jadwal</th>
                        <th class="px-6 py-4 text-left font-bold">Bayar</th>
                        <th class="px-6 py-4 text-center font-bold whitespace-nowrap">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-800">
                    @forelse($recentBookings as $booking)
                        <tr class="hover:bg-dark-800/30 transition-colors group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-dark-700 flex items-center justify-center text-[10px] font-bold text-gray-400 group-hover:bg-gold-400/20 group-hover:text-gold-400 transition-colors">
                                        {{ substr($booking->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-white leading-none mb-1">{{ $booking->name }}</p>
                                        <p class="text-[10px] text-gray-500">{{ $booking->phone }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gold-400 font-medium whitespace-nowrap italic">
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
                                    {{ $booking->payment_type }}
                                </p>
                                <p class="text-sm text-gold-400 font-medium">Rp
                                    {{ number_format($booking->amount_to_pay, 0, ',', '.') }}
                                </p>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span
                                    class="px-3 py-1.5 text-[10px] uppercase font-bold tracking-widest bg-emerald-500/5 text-emerald-400/80 border border-emerald-500/10 rounded-full inline-block">
                                    COMPLETED
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-sm">Belum ada booking.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    </div>

@endsection