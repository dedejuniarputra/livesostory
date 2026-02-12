@extends('admin.layout')
@section('header', 'Dashboard')
@section('content')

<!-- Stats Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    <div class="bg-dark-800/50 border border-dark-700 p-5 rounded">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-blue-500/10 text-blue-400 rounded flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        </div>
        <p class="text-2xl font-light">{{ $stats['total_bookings'] }}</p>
        <p class="text-xs text-gray-500 mt-1">Total Bookings</p>
    </div>
    <div class="bg-dark-800/50 border border-dark-700 p-5 rounded">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-yellow-500/10 text-yellow-400 rounded flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-2xl font-light">{{ $stats['pending_bookings'] }}</p>
        <p class="text-xs text-gray-500 mt-1">Pending</p>
    </div>
    <div class="bg-dark-800/50 border border-dark-700 p-5 rounded">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-green-500/10 text-green-400 rounded flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M5 13l4 4L19 7"/></svg>
            </div>
        </div>
        <p class="text-2xl font-light">{{ $stats['completed_bookings'] }}</p>
        <p class="text-xs text-gray-500 mt-1">Completed</p>
    </div>
    <div class="bg-dark-800/50 border border-dark-700 p-5 rounded">
        <div class="flex items-center justify-between mb-3">
            <div class="w-10 h-10 bg-gold-400/10 text-gold-400 rounded flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
        <p class="text-2xl font-light">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</p>
        <p class="text-xs text-gray-500 mt-1">Total Revenue</p>
    </div>
</div>

<!-- Quick Stats -->
<div class="grid grid-cols-3 gap-4 mb-8">
    <div class="bg-dark-800/30 border border-dark-800 p-4 rounded text-center">
        <p class="text-lg font-light">{{ $stats['total_packages'] }}</p>
        <p class="text-xs text-gray-500">Packages</p>
    </div>
    <div class="bg-dark-800/30 border border-dark-800 p-4 rounded text-center">
        <p class="text-lg font-light">{{ $stats['total_portfolios'] }}</p>
        <p class="text-xs text-gray-500">Portfolio Items</p>
    </div>
    <div class="bg-dark-800/30 border border-dark-800 p-4 rounded text-center">
        <p class="text-lg font-light text-{{ $stats['unread_contacts'] > 0 ? 'gold-400' : 'white' }}">{{ $stats['unread_contacts'] }}</p>
        <p class="text-xs text-gray-500">Unread Messages</p>
    </div>
</div>

<!-- Recent Bookings -->
<div class="bg-dark-800/50 border border-dark-700 rounded">
    <div class="px-6 py-4 border-b border-dark-700 flex items-center justify-between">
        <h3 class="text-sm font-medium">Recent Bookings</h3>
        <a href="{{ route('admin.bookings.index') }}" class="text-xs text-gold-400 hover:text-gold-300">View All →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="text-xs text-gray-500 uppercase tracking-wider">
                    <th class="text-left px-6 py-3">Client</th>
                    <th class="text-left px-6 py-3">Package</th>
                    <th class="text-left px-6 py-3">Date</th>
                    <th class="text-left px-6 py-3">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-800">
                @forelse($recentBookings as $booking)
                    <tr class="hover:bg-dark-800/30 transition-colors">
                        <td class="px-6 py-3 text-sm">{{ $booking->name }}</td>
                        <td class="px-6 py-3 text-sm text-gray-400">{{ $booking->package->name ?? '-' }}</td>
                        <td class="px-6 py-3 text-sm text-gray-400">{{ $booking->booking_date->format('d M Y') }}</td>
                        <td class="px-6 py-3">{!! $booking->status_badge !!}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-8 text-center text-gray-500 text-sm">Belum ada booking.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
