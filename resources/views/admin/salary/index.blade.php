@extends('admin.layout')
@section('header', 'Manajemen Gaji Tim')
@section('content')

    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
        <div>
            <h2 class="text-white font-semibold text-lg">Pembayaran Gaji</h2>
            <p class="text-gray-500 text-xs mt-0.5">Catatan pembayaran gaji seluruh anggota tim</p>
        </div>
        <a href="{{ route('admin.salary.create') }}"
            class="inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-gold-400 text-dark-950 text-xs font-semibold rounded hover:bg-gold-300 transition-colors w-full sm:w-auto">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Input Gaji
        </a>
    </div>



    {{-- Filter --}}
    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 mb-8">
        <form method="GET" action="{{ route('admin.salary.index') }}"
            class="flex flex-col sm:flex-row flex-wrap items-stretch sm:items-center gap-3 w-full lg:w-auto">
            <div class="relative w-full sm:w-64">
                <select name="member"
                    class="bg-dark-800/50 border border-dark-700 text-[11px] md:text-xs text-white rounded px-4 py-2.5 w-full focus:border-gold-400 focus:ring-0">
                    <option value="">Semua Anggota</option>
                    @foreach($members as $m)
                        <option value="{{ $m->id }}" {{ request('member') == $m->id ? 'selected' : '' }}>
                            {{ $m->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <input type="month" name="month" value="{{ request('month', date('Y-m')) }}"
                    class="bg-dark-800/50 border border-dark-700 text-[11px] md:text-xs text-white rounded px-4 py-2.5 flex-1 sm:w-40 focus:border-gold-400 focus:ring-0 [color-scheme:dark]">
            </div>
            <div class="flex items-center gap-3 w-full sm:w-auto">
                <button type="submit"
                    class="px-6 py-2.5 bg-gold-400 text-dark-950 text-[10px] md:text-xs font-bold uppercase tracking-widest rounded hover:bg-gold-300 transition-colors flex-1 sm:flex-none">Filter</button>
                @if(request('member') || request('month'))
                    <a href="{{ route('admin.salary.index') }}"
                        class="text-[10px] md:text-xs text-gray-500 hover:text-white transition-colors whitespace-nowrap text-center flex-1 sm:flex-none">Reset</a>
                @endif
            </div>
        </form>
    </div>

    {{-- Table --}}
    <div class="bg-dark-800/50 border border-dark-700 rounded overflow-hidden shadow-sm">
        <div class="w-full overflow-x-auto scrollbar-thin scrollbar-thumb-dark-700">
            <table class="min-w-[800px] w-full">
                <thead>
                    <tr
                        class="text-[10px] md:text-xs text-gray-500 uppercase tracking-widest border-b border-dark-700 bg-dark-900/40">
                        <th class="px-4 py-4 text-left font-bold w-10">No</th>
                        <th class="px-6 py-4 text-left font-bold">Anggota</th>
                        <th class="px-6 py-4 text-left font-bold">Tanggal</th>
                        <th class="px-6 py-4 text-left font-bold">Job Description</th>
                        <th class="px-6 py-4 text-left font-bold">Total Pembayaran</th>
                        <th class="px-6 py-4 text-right font-bold pr-10">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-dark-800">
                    @forelse($payments as $payment)
                        <tr class="hover:bg-dark-800/30 transition-colors group">
                            <td class="px-4 py-4 text-xs text-gray-500 text-center">
                                {{ ($payments->currentPage() - 1) * $payments->perPage() + $loop->iteration }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-8 h-8 rounded-full bg-dark-700 flex items-center justify-center text-[10px] font-bold text-gray-400 group-hover:bg-gold-400/20 group-hover:text-gold-400 transition-colors">
                                        {{ strtoupper(substr($payment->teamMember->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-white leading-none mb-1 uppercase tracking-tight">{{ $payment->teamMember->name ?? '-' }}</p>
                                        <p class="text-[10px] text-gray-500 leading-none">{{ $payment->teamMember->role ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-white font-medium">
                                {{ $payment->start_date->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-400 italic">
                                {{ $payment->job_description }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-sm text-gold-400 font-medium">Rp
                                    {{ number_format($payment->total_amount, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-3">

                                    <a href="{{ route('admin.salary.edit', $payment) }}"
                                        class="text-[10px] uppercase tracking-wider border border-dark-700 text-gold-400 px-3 py-1.5 rounded hover:bg-dark-700 hover:text-white transition-all">Edit</a>
                                    <form action="{{ route('admin.salary.destroy', $payment) }}" method="POST"
                                        onsubmit="return confirm('Hapus data pembayaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-[10px] uppercase tracking-wider border border-red-500/30 text-red-500/70 px-3 py-1.5 rounded hover:bg-red-500/10 hover:text-red-400 transition-all">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500 text-sm">
                                Belum ada data pembayaran gaji.
                                <a href="{{ route('admin.salary.create') }}" class="text-gold-400 hover:underline">Input
                                    sekarang</a>.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($payments->total() > 0)
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 px-6 py-4 border-t border-dark-700">
                <p class="text-xs text-gray-500">
                    Menampilkan
                    <span class="text-white font-semibold">{{ $payments->firstItem() }}</span>–<span
                        class="text-white font-semibold">{{ $payments->lastItem() }}</span>
                    dari <span class="text-white font-semibold">{{ $payments->total() }}</span> data
                </p>
                @if($payments->hasPages())
                <div class="flex items-center gap-1">
                    @if($payments->onFirstPage())
                        <span
                            class="px-3 py-1.5 text-[11px] rounded border border-dark-700 text-gray-600 cursor-not-allowed select-none">&lsaquo;</span>
                    @else
                        <a href="{{ $payments->previousPageUrl() }}"
                            class="px-3 py-1.5 text-[11px] rounded border border-dark-700 text-gray-400 hover:bg-dark-700 hover:text-white transition-colors">&lsaquo;</a>
                    @endif
                    @foreach($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                        @if($page == $payments->currentPage())
                            <span
                                class="px-3 py-1.5 text-[11px] rounded bg-gold-400 text-dark-950 font-bold cursor-default">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}"
                                class="px-3 py-1.5 text-[11px] rounded border border-dark-700 text-gray-400 hover:bg-dark-700 hover:text-white transition-colors">{{ $page }}</a>
                        @endif
                    @endforeach
                    @if($payments->hasMorePages())
                        <a href="{{ $payments->nextPageUrl() }}"
                            class="px-3 py-1.5 text-[11px] rounded border border-dark-700 text-gray-400 hover:bg-dark-700 hover:text-white transition-colors">&rsaquo;</a>
                    @else
                        <span
                            class="px-3 py-1.5 text-[11px] rounded border border-dark-700 text-gray-600 cursor-not-allowed select-none">&rsaquo;</span>
                    @endif
                </div>
                @endif
            </div>
        @endif
    </div>

@endsection