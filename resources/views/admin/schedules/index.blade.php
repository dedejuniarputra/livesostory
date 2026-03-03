@extends('admin.layout')
@section('header', 'Schedule Management')
@section('content')

    @push('scripts')
        <script>
            const bookingData = {!! json_encode($bookings->map(function ($dateGroup) {
            return $dateGroup->map(function ($booking) {
                return [
                    'name' => $booking->name,
                    'package' => $booking->package->name ?? 'N/A',
                    'status' => $booking->status,
                    'time' => $booking->booking_time ?? 'Full Day'
                ];
            });
        })) !!};
        </script>
    @endpush

    <!-- Slots Management Section (Top) -->
    <div class="grid lg:grid-cols-2 gap-8 mb-8">
        <!-- Default Slots Setting -->
        <form action="{{ route('admin.settings.update') }}" method="POST"
            class="bg-dark-800/50 border border-dark-700 p-6 rounded h-full">
            @csrf @method('PUT')
            <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-2">Default Slot Per Hari</h3>
            <p class="text-xs text-gray-500 mb-6">Jumlah slot otomatis untuk hari-hari biasa.</p>
            <div class="flex items-center gap-4 mt-auto">
                <input type="number" name="default_slots_per_day" value="{{ $defaultSlots ?? 1 }}"
                    class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                <button type="submit"
                    class="whitespace-nowrap px-6 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update
                    Default</button>
            </div>
        </form>

        <!-- Custom Slot Setting -->
        <form action="{{ route('admin.schedules.block') }}" method="POST"
            class="bg-dark-800/50 border border-dark-700 p-6 rounded h-full">
            @csrf
            <h3 class="text-xs tracking-widest uppercase text-gold-400 mb-2">Atur Slot Tanggal Khusus</h3>
            <p class="text-xs text-gray-500 mb-4">Ubah jumlah slot untuk tanggal tertentu (bukan untuk tutup).</p>
            <div class="space-y-3">
                <div class="grid grid-cols-2 gap-3">
                    <input type="text" id="datepicker_slots" name="dates" placeholder="Pilih Tanggal" required
                        class="bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                    <input type="number" name="slots" value="1" min="1" required
                        class="bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded">
                </div>
                <button type="submit"
                    class="w-full px-4 py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors rounded">Update
                    Slot</button>
            </div>
        </form>
    </div>

    <div class="grid lg:grid-cols-2 gap-8">
        <!-- Block Schedule Form (Bottom) -->
        <div class="order-2 lg:order-1">
            <h3 class="text-sm font-medium mb-4 text-red-400">Block & Tutup Tanggal</h3>
            <form action="{{ route('admin.schedules.block') }}" method="POST"
                class="bg-dark-800/50 border border-dark-700 p-6 rounded space-y-4">
                @csrf
                <input type="hidden" name="slots" value="0">
                <div>
                    <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Pilih Tanggal
                        Libur/Tutup</label>
                    <input type="text" id="datepicker" name="dates" value="{{ old('dates') }}"
                        placeholder="Pilih satu atau beberapa tanggal" required
                        class="w-full bg-dark-800 border border-dark-600 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 rounded border-red-500/30">
                    <p class="text-[10px] text-gray-500 mt-1">Tanggal yang dipilih akan otomatis mendapatkan 0 slot (Tutup).
                    </p>
                </div>
                <button type="submit"
                    class="w-full px-4 py-2.5 bg-red-500 text-white text-xs tracking-widest uppercase font-semibold hover:bg-red-600 transition-colors rounded">Simpan
                    Pemblokiran</button>
            </form>

            <div class="mt-4 p-4 bg-dark-800/20 border border-dark-700/50 rounded">
                <p class="text-[11px] text-gold-400/80 leading-relaxed font-medium mb-1">💡 Cara Penggunaan:</p>
                <p class="text-[10px] text-gray-500 leading-relaxed">
                    Klik tanggal pada kalender di sebelah kanan untuk memilih tanggal. Tanggal yang Anda pilih akan muncul
                    otomatis di form "Block & Tutup" maupun "Atur Slot".
                </p>
            </div>

            <!-- Configured Dates List -->
            <div class="flex items-center justify-between mt-8 mb-4">
                <h3 class="text-sm font-medium">Pengaturan Tanggal Khusus</h3>
                @if($allBlockedDates->count() > 0)
                    <form action="{{ route('admin.schedules.purge') }}" method="POST"
                        onsubmit="return confirm('Hapus SEMUA pengaturan tanggal khusus? Tindakan ini tidak dapat dibatalkan.')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="text-[10px] text-red-400 hover:text-red-300 transition-colors uppercase tracking-widest font-bold">Delete
                            All</button>
                    </form>
                @endif
            </div>
            <div class="space-y-2">
                @forelse($allBlockedDates as $blocked)
                    <div class="flex items-center justify-between bg-dark-800/50 border border-dark-700 px-4 py-3 rounded">
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm">{{ $blocked->date->format('d F Y') }}</p>
                                @if($blocked->slots == 0)
                                    <span
                                        class="px-1.5 py-0.5 bg-red-500/20 text-red-400 text-[10px] uppercase tracking-tighter rounded">Tutup</span>
                                @else
                                    <span
                                        class="px-1.5 py-0.5 bg-gold-400/20 text-gold-400 text-[10px] uppercase tracking-tighter rounded">{{ $blocked->slots }}
                                        Slot</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500">{{ $blocked->reason ?? 'Tidak ada keterangan' }}</p>
                        </div>
                        <form action="{{ route('admin.schedules.unblock', $blocked) }}" method="POST"
                            onsubmit="return confirm('Kembalikan tgl ini ke pengaturan default?')">
                            @csrf @method('DELETE')
                            <button class="text-xs text-red-400 hover:text-red-300 transition-colors">Hapus</button>
                        </form>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Belum ada pengaturan tanggal khusus.</p>
                @endforelse
            </div>
        </div>

        <!-- Visual Calendar -->
        <div class="lg:col-span-1">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium">Jadwal & Slot: {{ Carbon\Carbon::create($year, $month, 1)->format('F Y') }}
                </h3>
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.schedules.index', ['month' => $month == 1 ? 12 : $month - 1, 'year' => $month == 1 ? $year - 1 : $year]) }}"
                        class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </a>
                    <a href="{{ route('admin.schedules.index', ['month' => $month == 12 ? 1 : $month + 1, 'year' => $month == 12 ? $year + 1 : $year]) }}"
                        class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-dark-800/30 border border-dark-700 rounded-sm overflow-hidden">
                <!-- Calendar Header -->
                <div class="grid grid-cols-7 border-b border-dark-700 bg-dark-900/50">
                    @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $dayName)
                        <div class="py-3 text-center text-[10px] uppercase tracking-widest text-gray-500 font-semibold">
                            {{ $dayName }}
                        </div>
                    @endforeach
                </div>

                <!-- Calendar Grid -->
                <div class="grid grid-cols-7 gap-px bg-dark-700">
                    @php
                        $firstDayOfMonth = Carbon\Carbon::create($year, $month, 1)->dayOfWeek;
                        $daysInMonth = Carbon\Carbon::create($year, $month, 1)->daysInMonth;
                        $today = Carbon\Carbon::today('Asia/Jakarta');
                    @endphp

                    {{-- Empty days --}}
                    @for($i = 0; $i < $firstDayOfMonth; $i++)
                        <div class="aspect-square bg-dark-950/40"></div>
                    @endfor

                    {{-- Month days --}}
                    @for($day = 1; $day <= $daysInMonth; $day++)
                        @php
                            $date = Carbon\Carbon::create($year, $month, $day, 0, 0, 0, 'Asia/Jakarta');
                            $dateStr = $date->format('Y-m-d');
                            $dayBookings = $bookings[$dateStr] ?? collect();
                            $blocked = $blockedDates[$dateStr] ?? null;
                            $totalSlots = $blocked ? $blocked->slots : $defaultSlots;
                            $remainingSlots = max(0, $totalSlots - $dayBookings->count());
                            $isPast = $date->lt($today);
                            $isToday = $date->toDateString() === $today->toDateString();
                            $isBlocked = $totalSlots == 0;
                            $isFull = !$isBlocked && $remainingSlots == 0;
                            $isAvailable = !$isPast && !$isBlocked && $remainingSlots > 0;
                        @endphp

                        <div class="calendar-day aspect-square relative flex flex-col items-center justify-center p-2 transition-all duration-200 group
                                                                                                            {{ $isPast ? 'bg-dark-900/40 opacity-40 cursor-default' : 'bg-dark-900 cursor-pointer hover:bg-dark-800' }}"
                            id="cell-{{ $dateStr }}" @if(!$isPast) onclick="toggleDateSelection('{{ $dateStr }}')" @endif>

                            <span
                                class="text-sm font-light {{ $isToday ? 'text-gold-400 font-bold' : 'text-gray-300' }} group-hover:text-white">{{ $day }}</span>

                            <div class="mt-2 flex flex-col items-center flex-1 justify-end pb-1 w-full">
                                @if($isBlocked)
                                    <span class="text-[10px] uppercase font-bold tracking-tight text-red-500/80">Libur</span>
                                @elseif($isFull)
                                    <span class="text-[10px] uppercase font-bold tracking-tight text-red-400">Penuh</span>
                                @elseif($isAvailable)
                                    <div class="flex flex-col items-center leading-none">
                                        <span class="text-sm font-black text-green-400">{{ $remainingSlots }}</span>
                                        <span
                                            class="text-[7px] uppercase font-bold tracking-tighter text-gray-500 group-hover:text-gray-400">Slot</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Selection Indicator: Customer style (full background or border) -->
                            <div
                                class="absolute inset-0 border-2 border-gold-400 bg-gold-400/5 pointer-events-none opacity-0 transition-opacity duration-200 selection-indicator">
                            </div>
                        </div>
                    @endfor

                    {{-- Empty days after --}}
                    @php
                        $lastDayOfMonth = Carbon\Carbon::create($year, $month, $daysInMonth)->dayOfWeek;
                    @endphp
                    @for($i = $lastDayOfMonth; $i < 6; $i++)
                        <div class="aspect-square bg-dark-950/40"></div>
                    @endfor
                </div>
            </div>

            <div class="mt-6 flex flex-wrap items-center gap-6 text-[10px] text-gray-500 uppercase tracking-widest">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-green-500/20 border border-green-500/30 rounded-sm"></div>
                    <span>Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-red-500/20 border border-red-500/30 rounded-sm"></div>
                    <span>Penuh / Libur</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 bg-gold-400 rounded-sm"></div>
                    <span>Dipilih</span>
                </div>
            </div>
        </div>
    </div>


    <!-- [REMOVED DETAILED POPUP] -->

    @push('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <style>
            .flatpickr-calendar {
                background: #1a1a1a !important;
                border: 1px solid #333 !important;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5) !important;
            }

            .flatpickr-day {
                color: #ccc !important;
            }

            .flatpickr-day.selected {
                background: #d4af37 !important;
                border-color: #d4af37 !important;
                color: #000 !important;
            }

            .flatpickr-day:hover {
                background: #333 !important;
            }

            .flatpickr-current-month,
            .flatpickr-month {
                color: #fff !important;
                fill: #fff !important;
            }

            .flatpickr-weekday {
                color: #d4af37 !important;
            }

            /* Fix for SVG arrows to prevent them from becoming huge */
            .flatpickr-prev-month svg,
            .flatpickr-next-month svg {
                width: 14px !important;
                height: 14px !important;
                fill: #d4af37 !important;
            }

            .custom-scrollbar::-webkit-scrollbar {
                width: 2px;
            }

            .custom-scrollbar::-webkit-scrollbar-track {
                background: transparent;
            }

            .custom-scrollbar::-webkit-scrollbar-thumb {
                background: #333;
                border-radius: 10px;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script>
            let picker_block, picker_slots;

            const commonConfig = {
                mode: "multiple",
                dateFormat: "Y-m-d",
                minDate: "today",
                conjunction: ",",
                onReady: function (selectedDates, dateStr, instance) {
                    syncCalendarHighlights();
                },
                onChange: function (selectedDates, dateStr, instance) {
                    // Sync common input values
                    setTimeout(() => {
                        const otherPicker = (instance.element.id === 'datepicker') ? picker_slots : picker_block;
                        if (otherPicker && otherPicker.input && otherPicker.input.value !== dateStr) {
                            otherPicker.setDate(dateStr, false);
                        }
                        syncCalendarHighlights();
                    }, 50);
                }
            };

            document.addEventListener('DOMContentLoaded', function () {
                picker_block = flatpickr("#datepicker", commonConfig);
                picker_slots = flatpickr("#datepicker_slots", commonConfig);
            });

            function syncCalendarHighlights() {
                const el = document.getElementById('datepicker');
                if (!el) return;
                const selectedStr = el.value;
                const selectedArray = selectedStr ? selectedStr.split(',') : [];

                document.querySelectorAll('.selection-indicator').forEach(el => el.style.opacity = '0');

                selectedArray.forEach(date => {
                    const cell = document.getElementById(`cell-${date}`);
                    if (cell) {
                        const indicator = cell.querySelector('.selection-indicator');
                        if (indicator) indicator.style.opacity = '1';
                    }
                });
            }

            function toggleDateSelection(date) {
                if (!picker_block || !picker_slots) return;

                let currentDates = picker_block.selectedDates.map(d => picker_block.formatDate(d, "Y-m-d"));
                const index = currentDates.indexOf(date);

                if (index > -1) {
                    currentDates.splice(index, 1);
                } else {
                    currentDates.push(date);
                }

                const finalDateStr = currentDates.join(',');
                picker_block.setDate(finalDateStr, true);
            }
        </script>
    @endpush

@endsection