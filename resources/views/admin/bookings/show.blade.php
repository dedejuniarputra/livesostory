@extends('admin.layout')
@section('header', 'Detail Booking')
@section('content')

<div class="max-w-3xl">
    <div class="flex items-center justify-between mb-6">
        <a href="{{ route('admin.bookings.index') }}" class="text-xs text-gray-400 hover:text-gold-400 transition-colors inline-block">← Kembali</a>
        <a href="{{ route('admin.bookings.export-pdf', $booking) }}" class="px-4 py-2 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Export PDF
        </a>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <!-- Client Info -->
        <div class="bg-dark-800/50 border border-dark-700 p-6 rounded">
            <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-4">Data Client</h3>
            <div class="space-y-3">
                <div><p class="text-xs text-gray-500">Nama</p><p class="text-sm">{{ $booking->name }}</p></div>
                <div><p class="text-xs text-gray-500">Email</p><p class="text-sm">{{ $booking->email }}</p></div>
                <div><p class="text-xs text-gray-500">Phone</p><p class="text-sm">{{ $booking->phone }}</p></div>
            </div>
        </div>

        <!-- Booking Info -->
        <div class="bg-dark-800/50 border border-dark-700 p-6 rounded">
            <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-4">Detail Booking</h3>
            <div class="space-y-3">
                <div><p class="text-xs text-gray-500">Paket</p><p class="text-sm">{{ $booking->package->name }}</p></div>
                <div><p class="text-xs text-gray-500">Harga</p><p class="text-sm text-gold-400">{{ $booking->package->formatted_price }}</p></div>
                <div><p class="text-xs text-gray-500">Tanggal</p><p class="text-sm">{{ $booking->booking_date->format('d F Y') }}</p></div>

                @if($booking->location)
                <div><p class="text-xs text-gray-500">Lokasi</p><p class="text-sm">{{ $booking->location }}</p></div>
                @endif
                <div><p class="text-xs text-gray-500">Status</p><div class="mt-1">{!! $booking->status_badge !!}</div></div>
            </div>
        </div>
    </div>

    @if($booking->notes)
    <div class="bg-dark-800/50 border border-dark-700 p-6 rounded mt-6">
        <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-3">Catatan</h3>
        <p class="text-sm text-gray-400">{{ $booking->notes }}</p>
    </div>
    @endif

    <!-- Actions -->
    <div class="mt-6 flex items-center gap-3">
        <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST" class="flex items-center gap-2">
            @csrf @method('PATCH')
            <select name="status" class="bg-dark-800 border border-dark-600 text-sm text-white rounded px-3 py-2 focus:border-gold-400 focus:ring-0">
                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
            <button type="submit" class="px-4 py-2 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update Status</button>
        </form>
        <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" onsubmit="return confirm('Hapus booking ini?')">
            @csrf @method('DELETE')
            <button class="px-4 py-2 border border-red-500/30 text-red-400 text-xs tracking-widest uppercase hover:bg-red-500/10 transition-colors rounded">Hapus</button>
        </form>
    </div>
</div>

@endsection
