@extends('admin.layout')
@section('header', 'Detail Booking')
@section('content')

    <div class="max-w-3xl">
        <div class="flex items-center justify-between mb-6">
            <a href="{{ route('admin.bookings.index') }}"
                class="text-xs text-gray-400 hover:text-gold-400 transition-colors inline-block">← Kembali</a>
        </div>

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Client Info -->
            <div class="bg-dark-800/50 border border-dark-700 p-6 rounded">
                <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-4">Data Client</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500">Nama</p>
                        <p class="text-sm">{{ $booking->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Nama IG / Link IG</p>
                        <p class="text-sm">{{ $booking->ig_username ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Phone</p>
                        <p class="text-sm">{{ $booking->phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Booking Info -->
            <div class="bg-dark-800/50 border border-dark-700 p-6 rounded">
                <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-4">Detail Booking</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-gray-500">Paket</p>
                        <p class="text-sm">{{ $booking->package->name }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Harga</p>
                        <p class="text-sm text-gold-400">{{ $booking->package->formatted_price }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Tanggal</p>
                        <p class="text-sm font-medium">{{ $booking->booking_date->format('d F Y') }} <span
                                class="text-gray-500 font-normal">at</span> {{ $booking->booking_time }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Metode Pembayaran</p>
                        <p class="text-sm uppercase tracking-wide">{{ $booking->payment_type }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500">Jumlah Harus Dibayar</p>
                        <p class="text-sm text-gold-400 font-bold">Rp
                            {{ number_format($booking->amount_to_pay, 0, ',', '.') }}</p>
                    </div>

                    @if($booking->location)
                        <div>
                            <p class="text-xs text-gray-500">Alamat</p>
                            <p class="text-sm">{{ $booking->location }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-xs text-gray-500">Status</p>
                        <div class="mt-1">{!! $booking->status_badge !!}</div>
                    </div>
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
        <div class="mt-6">
            <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST"
                onsubmit="return confirm('Hapus booking ini?')">
                @csrf @method('DELETE')
                <button
                    class="px-6 py-2 border border-red-500/30 text-red-400 text-xs tracking-widest uppercase font-bold hover:bg-red-500/10 transition-colors rounded">Hapus
                    Booking</button>
            </form>
        </div>
    </div>

@endsection