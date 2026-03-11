@extends('admin.layout')
@section('header', 'Edit Booking')
@section('content')

    <div class="max-w-4xl">
        <div class="bg-dark-800/50 border border-dark-700 rounded p-6 sm:p-8">
            <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- Client Info Section -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gold-400 mb-6 flex items-center gap-2">
                        <span class="w-8 h-px bg-gold-400"></span>
                        Informasi Client
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Nama Client
                                *</label>
                            <input type="text" name="name" value="{{ old('name', $booking->name) }}" required
                                class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors">
                            @error('name') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">No Telp / WA
                                (Opsional)</label>
                            <input type="text" name="phone" value="{{ old('phone', $booking->phone) }}"
                                class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors">
                            @error('phone') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Username IG
                                (Opsional)</label>
                            <input type="text" name="ig_username" value="{{ old('ig_username', $booking->ig_username) }}"
                                class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors">
                            @error('ig_username') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <!-- Schedule & Location Section -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gold-400 mb-6 flex items-center gap-2">
                        <span class="w-8 h-px bg-gold-400"></span>
                        Jadwal & Lokasi
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Pilih Paket
                                *</label>
                            <select name="package_id" required
                                class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors">
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ old('package_id', $booking->package_id) == $package->id ? 'selected' : '' }}>
                                        {{ $package->name }} - Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('package_id') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Lokasi
                                Acara</label>
                            <input type="text" name="location" value="{{ old('location', $booking->location) }}"
                                class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors">
                            @error('location') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-4">Pilih Tanggal Baru
                                (Opsional) *</label>

                            <div class="flex items-center justify-between mb-4">
                                <h3 class="font-display text-sm font-medium text-white">Jadwal & Slot: <span
                                        id="calendar-month"></span></h3>
                                <div class="flex items-center gap-2">
                                    <button type="button" id="prev-month"
                                        class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 19l-7-7 7-7" />
                                        </svg>
                                    </button>
                                    <button type="button" id="next-month"
                                        class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 5l7 7-7 7" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div id="calendar-container"
                                class="bg-dark-800/30 border border-dark-700 rounded-sm overflow-hidden">
                                <div class="grid grid-cols-7 border-b border-dark-700 bg-dark-900/50">
                                    @foreach(['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $dayName)
                                        <div
                                            class="py-3 text-center text-[9px] md:text-[10px] uppercase tracking-widest text-gray-500 font-bold">
                                            {{ $dayName }}</div>
                                    @endforeach
                                </div>
                                <div id="calendar-days" class="grid grid-cols-7 gap-px bg-dark-700"></div>
                            </div>

                            <div
                                class="mt-6 flex flex-wrap items-center gap-6 text-[10px] text-gray-500 uppercase tracking-widest">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-green-500/20 border border-green-500/30 rounded-sm"></div>
                                    <span>Tersedia</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-red-500/20 border border-red-500/40 rounded-sm"></div>
                                    <span>Penuh</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-gold-400 rounded-sm"></div>
                                    <span>Dipilih</span>
                                </div>
                            </div>

                            <input type="hidden" name="booking_date" id="selected-date"
                                value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}" required>
                            <p id="selected-date-text" class="text-sm text-gold-400 mt-2">Tanggal dipilih:
                                {{ $booking->booking_date->format('d M Y') }}</p>
                            @error('booking_date') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Jam Acara
                                *</label>
                            <input type="time" name="booking_time" value="{{ old('booking_time', $booking->booking_time) }}"
                                required
                                class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors [color-scheme:dark]">
                            @error('booking_time') <p class="text-red-500 text-[10px] mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Catatan
                            Tambahan</label>
                        <textarea name="notes" rows="3"
                            class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors">{{ old('notes', $booking->notes) }}</textarea>
                    </div>
                </div>

                <!-- Payment & Status Section -->
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-widest text-gold-400 mb-6 flex items-center gap-2">
                        <span class="w-8 h-px bg-gold-400"></span>
                        Pembayaran & Status
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-4">Tipe Pembayaran *</label>
                            <div class="flex items-center gap-8">
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="payment_type" value="dp" 
                                        {{ old('payment_type', $booking->payment_type) == 'dp' ? 'checked' : '' }} required
                                        class="w-5 h-5 bg-dark-900 border-dark-700 text-gold-400 focus:ring-0 focus:ring-offset-0 transition-colors cursor-pointer appearance-none rounded-full border-2 checked:border-gold-400 checked:bg-gold-400">
                                    <span class="text-sm tracking-wide text-gray-300 group-hover:text-white transition-colors">Down Payment (DP)</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer group">
                                    <input type="radio" name="payment_type" value="lunas" 
                                        {{ old('payment_type', $booking->payment_type) == 'lunas' ? 'checked' : '' }} required
                                        class="w-5 h-5 bg-dark-900 border-dark-700 text-gold-400 focus:ring-0 focus:ring-offset-0 transition-colors cursor-pointer appearance-none rounded-full border-2 checked:border-gold-400 checked:bg-gold-400">
                                    <span class="text-sm tracking-wide text-gray-300 group-hover:text-white transition-colors">Lunas</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Total yang Dibayar *</label>
                            <input type="number" name="amount_to_pay"
                                value="{{ old('amount_to_pay', $booking->amount_to_pay) }}" required
                                class="w-full bg-dark-900/50 border border-dark-700 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-[10px] uppercase tracking-widest text-gray-400 mb-2">Status Pesanan</label>
                            <div class="w-full bg-dark-900/50 border border-dark-700 px-4 py-3 text-gold-400 text-sm font-medium">
                                Completed (Selesai/Lunas/Sudah DP)
                            </div>
                            <input type="hidden" name="status" value="completed">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-4">
                    <button type="submit"
                        class="px-8 py-3 bg-gold-400 text-dark-950 text-xs font-bold uppercase tracking-widest hover:bg-gold-300 transition-colors">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.bookings.index') }}"
                        class="px-8 py-3 bg-dark-700 text-white text-xs font-bold uppercase tracking-widest hover:bg-dark-600 transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Calendar functionality
        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        let currentMonth = {{ (int) $booking->booking_date->format('m') - 1 }};
        let currentYear = {{ (int) $booking->booking_date->format('Y') }};
        let datesData = {};
        let selectedDate = '{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}';

        async function fetchDates() {
            try {
                const res = await fetch(`/api/available-dates?month=${currentMonth + 1}&year=${currentYear}`);
                if (res.ok) {
                    const data = await res.json();
                    datesData = data.dates || {};
                    renderCalendar();
                }
            } catch (e) {
                console.error('Failed to fetch dates', e);
            }
        }

        function renderCalendar() {
            const container = document.getElementById('calendar-days');
            const monthLabel = document.getElementById('calendar-month');
            if (!container || !monthLabel) return;

            monthLabel.textContent = `${months[currentMonth]} ${currentYear}`;

            const firstDay = new Date(currentYear, currentMonth, 1).getDay();
            const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            let html = '';

            // Empty cells
            for (let i = 0; i < firstDay; i++) {
                html += '<div class="aspect-square bg-dark-950/40"></div>';
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dateObj = new Date(currentYear, currentMonth, day);
                const isPast = dateObj < today;
                const isToday = dateObj.getTime() === today.getTime();

                const dayData = datesData[dateStr] || { remaining_slots: 0, total_slots: 0, is_blocked: false };
                const isAvailable = !isPast && (dayData.total_slots === 0 || (dayData.remaining_slots > 0 && !dayData.is_blocked));
                const isSelected = selectedDate === dateStr;

                let classes = 'aspect-square relative flex flex-col items-center justify-center p-1 md:p-2 transition-all duration-200 group ';
                let statusText = '';

                if (isSelected) {
                    classes += 'bg-gold-400 text-dark-950 font-semibold cursor-pointer';
                } else if (isPast) {
                    classes += 'bg-dark-900/40 opacity-40 cursor-default';
                } else if (dayData.is_blocked) {
                    classes += 'bg-red-500/20 cursor-not-allowed';
                } else {
                    classes += 'bg-dark-900 cursor-pointer hover:bg-dark-800';
                }

                const dayNumberClass = isSelected ? 'text-dark-950' : (isToday ? 'text-gold-400 font-black' : (dayData.is_blocked && !isPast ? 'text-red-500 font-black' : 'text-gray-300'));

                if (!isPast) {
                    if (dayData.is_blocked || (dayData.total_slots > 0 && dayData.remaining_slots <= 0)) {
                        const blockMsg = 'Penuh';
                        statusText = `<span class="text-[8px] md:text-[10px] uppercase font-black text-red-500 mt-1 md:mt-2">${blockMsg}</span>`;
                    } else if (dayData.total_slots > 0 && dayData.remaining_slots > 0) {
                        statusText = `
                            <span class="text-xs md:text-sm font-black text-green-400 transition-colors leading-none">${dayData.remaining_slots}</span>
                            <span class="text-[6px] md:text-[7px] uppercase font-bold tracking-tighter text-gray-500 -mt-0.5 md:-mt-1 group-hover:text-gray-400 transition-colors">Slot</span>`;
                    }
                }

                html += `
                    <div class="${classes}" ${(!isPast && !dayData.is_blocked) || isSelected ? `onclick="selectDate('${dateStr}', ${day})"` : ''}>
                        <span class="${dayNumberClass} text-xs md:text-sm font-light group-hover:text-white transition-colors h-5 md:h-6 flex items-center justify-center">${day}</span>
                        <div class="mt-1 md:mt-2 flex flex-col items-center flex-1 justify-end pb-0.5 md:pb-1 w-full text-center">
                            ${statusText}
                        </div>
                        ${isSelected ? '' : `
                        <div class="absolute inset-x-0 bottom-0 h-0.5 bg-gold-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-300 origin-center opacity-50"></div>
                        `}
                    </div>`;
            }

            container.innerHTML = html;
        }

        function selectDate(dateStr, day) {
            selectedDate = dateStr;
            document.getElementById('selected-date').value = dateStr;
            document.getElementById('selected-date-text').textContent = `Tanggal dipilih: ${day} ${months[currentMonth]} ${currentYear}`;
            renderCalendar();
        }

        document.getElementById('prev-month').addEventListener('click', () => {
            currentMonth--;
            if (currentMonth < 0) { currentMonth = 11; currentYear--; }
            fetchDates();
            renderCalendar();
        });

        document.getElementById('next-month').addEventListener('click', () => {
            currentMonth++;
            if (currentMonth > 11) { currentMonth = 0; currentYear++; }
            fetchDates();
            renderCalendar();
        });

        // Initialize
        renderCalendar();
        fetchDates();
    </script>
@endpush