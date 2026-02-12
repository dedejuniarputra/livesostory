@extends('admin.layout')
@section('header', 'Schedule Management')
@section('content')

<div class="grid lg:grid-cols-2 gap-8">
    <!-- Block Date Form -->
    <div>
        <h3 class="text-sm font-medium mb-4">Blokir Tanggal</h3>
        <form action="{{ route('admin.schedules.block') }}" method="POST" class="bg-dark-800/50 border border-dark-700 p-6 rounded space-y-4">
            @csrf
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Tanggal</label>
                <input type="date" name="date" required class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                @error('date') <span class="text-red-400 text-xs">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Alasan</label>
                <input type="text" name="reason" placeholder="e.g. Libur, Cuti" class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded placeholder-gray-600">
            </div>
            <button type="submit" class="px-4 py-2.5 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Blokir Tanggal</button>
        </form>

        <!-- Blocked Dates List -->
        <h3 class="text-sm font-medium mt-8 mb-4">Tanggal Diblokir</h3>
        <div class="space-y-2">
            @forelse($blockedDates as $blocked)
                <div class="flex items-center justify-between bg-dark-800/50 border border-dark-700 px-4 py-3 rounded">
                    <div>
                        <p class="text-sm">{{ $blocked->date->format('d F Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $blocked->reason ?? 'No reason' }}</p>
                    </div>
                    <form action="{{ route('admin.schedules.unblock', $blocked) }}" method="POST" onsubmit="return confirm('Buka kembali tanggal ini?')">
                        @csrf @method('DELETE')
                        <button class="text-xs text-red-400 hover:text-red-300 transition-colors">Hapus</button>
                    </form>
                </div>
            @empty
                <p class="text-sm text-gray-500">Tidak ada tanggal yang diblokir.</p>
            @endforelse
        </div>
    </div>

    <!-- Upcoming Bookings -->
    <div>
        <h3 class="text-sm font-medium mb-4">Jadwal Booking Bulan Ini</h3>
        <div class="space-y-2">
            @forelse($bookings as $booking)
                <div class="bg-dark-800/50 border border-dark-700 px-4 py-3 rounded">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm">{{ $booking->booking_date->format('d F Y') }} {{ $booking->booking_time ? '— ' . $booking->booking_time : '' }}</p>
                            <p class="text-xs text-gray-400">{{ $booking->name }} • {{ $booking->package->name ?? '-' }}</p>
                        </div>
                        {!! $booking->status_badge !!}
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500">Tidak ada booking bulan ini.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
