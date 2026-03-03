@extends('admin.layout')
@section('header', 'Booking Management')
@section('content')

    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.bookings.index') }}"
                class="px-3 py-1.5 text-xs rounded {{ !request('status') || request('status') == 'all' ? 'bg-gold-400/20 text-gold-400' : 'text-gray-400 hover:text-white' }} transition-colors">All</a>
            <a href="{{ route('admin.bookings.index', ['status' => 'pending']) }}"
                class="px-3 py-1.5 text-xs rounded {{ request('status') == 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'text-gray-400 hover:text-white' }} transition-colors">Pending</a>
            <a href="{{ route('admin.bookings.index', ['status' => 'completed']) }}"
                class="px-3 py-1.5 text-xs rounded {{ request('status') == 'completed' ? 'bg-green-500/20 text-green-400' : 'text-gray-400 hover:text-white' }} transition-colors">Completed</a>
        </div>

        <form action="{{ route('admin.bookings.destroy-all') }}" method="POST" class="inline"
            onsubmit="return confirm('PERINGATAN! Anda akan menghapus SELURUH data booking. Tindakan ini tidak dapat dibatalkan. Apakah Anda benar-benar yakin?')">
            @csrf @method('DELETE')
            <button type="submit"
                class="px-3 py-1.5 text-xs rounded border border-red-500/30 text-red-500/70 hover:bg-red-500/10 hover:text-red-400 transition-all uppercase tracking-widest font-bold">Delete
                All</button>
        </form>
    </div>

    <div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden">
        <table class="w-full">
            <thead>
                <tr class="text-xs text-gray-500 uppercase tracking-wider border-b border-dark-700">
                    <th class="text-left px-6 py-3">Client</th>
                    <th class="text-left px-6 py-3">Package</th>
                    <th class="text-left px-6 py-3">Tanggal</th>
                    <th class="text-left px-6 py-3">Status</th>
                    <th class="text-left px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-dark-800">
                @forelse($bookings as $booking)
                    <tr class="hover:bg-dark-800/30 transition-colors">
                        <td class="px-6 py-3">
                            <p class="text-sm text-white">{{ $booking->name }}</p>
                            <p class="text-xs text-gray-500">{{ $booking->phone }}</p>
                        </td>
                        <td class="px-6 py-3 text-sm text-gray-400">{{ $booking->package->name ?? '-' }}</td>
                        <td class="px-6 py-3 text-sm text-gray-400">{{ $booking->booking_date->format('d M Y') }}</td>
                        <td class="px-6 py-3">{!! $booking->status_badge !!}</td>
                        <td class="px-6 py-3">
                            <div class="flex items-center gap-3">
                                <a href="{{ route('admin.bookings.show', $booking) }}"
                                    class="text-xs text-gray-400 hover:text-white transition-colors">Detail</a>
                                <form action="{{ route('admin.bookings.update-status', $booking) }}" method="POST"
                                    class="inline">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        class="bg-dark-800 border border-dark-600 text-xs text-gray-400 rounded px-2 py-1 focus:border-gold-400 focus:ring-0">
                                        <option value="">Update</option>
                                        <option value="pending">Pending</option>
                                        <option value="completed">Completed</option>
                                    </select>
                                </form>
                                <form action="{{ route('admin.bookings.destroy', $booking) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus booking ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-xs text-red-500/70 hover:text-red-400 transition-colors">Delete</button>
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