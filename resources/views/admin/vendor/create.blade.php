@extends('admin.layout')

@section('title', 'Manual Vendor Booking')
@section('header', 'Input Manual Booking (Vendor)')

@section('content')
    <div class="max-w-4xl bg-dark-900 border border-dark-800 p-6 rounded relative overflow-hidden">
        <div class="absolute top-0 right-0 w-32 h-32 bg-gold-400/5 rounded-bl-full pointer-events-none"></div>

        <h2 class="text-lg font-light tracking-widest uppercase text-white mb-6">Informasi Pesanan</h2>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.vendor.store') }}" method="POST" class="space-y-6 relative z-10">
            @csrf

            <!-- Package & Status -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Nama Package *</label>
                    <input type="text" name="custom_package_name" value="{{ old('custom_package_name') }}" required
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600"
                        placeholder="Contoh: Paket Custom Wedding">
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Harga Total (Rp) *</label>
                    <input type="number" name="package_price" value="{{ old('package_price') }}" required
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600"
                        placeholder="Contoh: 5000000">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Fitur / Isi Package (Satu per baris)</label>
                    <textarea name="custom_package_features" rows="5"
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600 resize-none"
                        placeholder="8-10 Hours Coverage&#10;2 Professional Photographers&#10;1 Videographer&#10;Unlimited Photos">{{ old('custom_package_features') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Status Pesanan *</label>
                    <div class="relative">
                        <select name="status" required
                            class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors appearance-none">
                            <option value="completed" selected>Completed (Selesai/Lunas/Sudah DP)</option>
                            <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>Pending (Menunggu)</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Customer Details -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Nama Klien *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600"
                        placeholder="Nama Lengkap Klien">
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Username IG *</label>
                    <input type="text" name="ig_username" value="{{ old('ig_username') }}" required
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600"
                        placeholder="@usernameig">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">No Telp / WA *</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required
                        maxlength="13" pattern="\d*" inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600"
                        placeholder="Contoh: 0812345678901">
                </div>
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Lokasi *</label>
                    <input type="text" name="location" value="{{ old('location') }}" required
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600"
                        placeholder="Alamat acara / Venue">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Date Picker -->
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-4">Pilih Tanggal Acara *</label>
                    @error('booking_date')
                        <div class="mb-4 p-3 bg-red-500/10 border border-red-500/20 text-red-400 text-xs rounded flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-medium text-white">Jadwal & Slot: <span id="calendar-month"></span></h3>
                        <div class="flex items-center gap-2">
                            <button type="button" id="prev-month"
                                class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button type="button" id="next-month"
                                class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div id="calendar-container" class="bg-dark-800/30 border border-dark-700 rounded-sm overflow-hidden">
                        <div class="grid grid-cols-7 border-b border-dark-700 bg-dark-900/50">
                            @foreach (['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'] as $dayName)
                                <div class="py-3 text-center text-[9px] md:text-[10px] uppercase tracking-widest text-gray-500 font-bold">
                                    {{ $dayName }}
                                </div>
                            @endforeach
                        </div>
                        <div id="calendar-days" class="grid grid-cols-7 gap-px bg-dark-700"></div>
                    </div>

                    <div class="mt-6 flex flex-wrap items-center gap-6 text-[10px] text-gray-500 uppercase tracking-widest">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-green-500/20 border border-green-500/30 rounded-sm"></div>
                            <span>Tersedia</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-red-500/20 border border-red-500/40 rounded-sm"></div>
                            <span>Penuh / Libur</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 bg-gold-400 rounded-sm"></div>
                            <span>Dipilih</span>
                        </div>
                    </div>
                    <input type="hidden" name="booking_date" id="selected-date" value="{{ old('booking_date') }}" required>
                    <p id="selected-date-text" class="text-sm text-gold-400 mt-2"></p>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Jam Acara *</label>
                    <input type="time" name="booking_time" value="{{ old('booking_time') }}" required
                        class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors [color-scheme:dark]">
                </div>
            </div>

            <!-- Payment Type -->
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-400 mb-4">Tipe Pembayaran *</label>
                    <div class="flex items-center gap-6">
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="radio" name="payment_type" value="dp" id="radio-dp"
                                    {{ old('payment_type') === 'dp' ? 'checked' : '' }}
                                    class="peer sr-only">
                                <div
                                    class="w-4 h-4 border border-dark-600 rounded-full peer-checked:border-gold-400 peer-checked:bg-gold-400 transition-colors">
                                </div>
                                <div
                                    class="absolute w-1.5 h-1.5 bg-dark-950 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <span class="text-sm text-gray-400 group-hover:text-white transition-colors">Down Payment (DP)</span>
                        </label>
                        <label class="flex items-center gap-3 cursor-pointer group">
                            <div class="relative flex items-center justify-center">
                                <input type="radio" name="payment_type" value="lunas" id="radio-lunas"
                                    {{ old('payment_type', 'lunas') === 'lunas' ? 'checked' : '' }}
                                    class="peer sr-only">
                                <div
                                    class="w-4 h-4 border border-dark-600 rounded-full peer-checked:border-gold-400 peer-checked:bg-gold-400 transition-colors">
                                </div>
                                <div
                                    class="absolute w-1.5 h-1.5 bg-dark-950 rounded-full opacity-0 peer-checked:opacity-100 transition-opacity">
                                </div>
                            </div>
                            <span class="text-sm text-gray-400 group-hover:text-white transition-colors">Lunas</span>
                        </label>
                    </div>

                    <div id="dp-input-container" class="mt-4 {{ old('payment_type') === 'dp' ? '' : 'hidden' }}">
                        <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Nominal DP (Rp) *</label>
                        <input type="number" name="down_payment" value="{{ old('down_payment') }}" id="dp-input"
                            class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600"
                            placeholder="Contoh: 1000000">
                    </div>
                </div>
            </div>

            <div>
                <label class="block text-xs uppercase tracking-widest text-gray-400 mb-2">Catatan Tambahan (Opsional)</label>
                <textarea name="notes" rows="3"
                    class="w-full bg-dark-950 border border-dark-800 text-white text-sm px-4 py-3 focus:border-gold-400 focus:ring-0 transition-colors placeholder-dark-600 resize-none"
                    placeholder="Catatan untuk pesanan ini...">{{ old('notes') }}</textarea>
            </div>

            <div class="pt-6 border-t border-dark-800 flex justify-end">
                <button type="submit"
                    class="px-6 py-2.5 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-colors">
                    Simpan Pesanan
                </button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    // Calendar functionality
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let datesData = {};
    let selectedDate = null;
    const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    async function fetchDates() {
        try {
            const res = await fetch(`/api/available-dates?month=${currentMonth + 1}&year=${currentYear}`);
            const data = await res.json();
            datesData = data.dates || {};
        } catch (e) {
            console.error('Failed to fetch dates', e);
        }
        renderCalendar();
    }

    function renderCalendar() {
        const container = document.getElementById('calendar-days');
        const monthLabel = document.getElementById('calendar-month');
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
            const isAvailable = !isPast && (dayData.remaining_slots > 0 && !dayData.is_blocked);
            const isSelected = selectedDate === dateStr;

            let classes = 'aspect-square relative flex flex-col items-center justify-center p-1 md:p-2 transition-all duration-200 group ';
            let statusText = '';

            if (isPast) {
                classes += 'bg-dark-900/40 opacity-40 cursor-default';
            } else if (isSelected) {
                classes += 'bg-gold-400 text-dark-950 font-semibold cursor-pointer';
            } else if (dayData.is_blocked && !isPast) {
                classes += 'bg-red-500/20 cursor-not-allowed';
            } else {
                classes += 'bg-dark-900 cursor-pointer hover:bg-dark-800';
            }

            const dayNumberClass = isToday ? 'text-gold-400 font-black' : (isSelected ? 'text-dark-950' : (dayData.is_blocked && !isPast ? 'text-red-500 font-black' : 'text-gray-300'));

            if (isPast) {
                statusText = '';
            } else if (dayData.is_blocked || (dayData.total_slots > 0 && dayData.remaining_slots <= 0)) {
                const blockMsg = dayData.is_blocked ? 'Libur' : 'Penuh';
                const weightClass = 'font-black tracking-tight';
                statusText = `<span class="text-[8px] md:text-[10px] uppercase ${weightClass} text-red-500 mt-1 md:mt-2">${blockMsg}</span>`;
            } else if (isAvailable) {
                statusText = `
                    <span class="text-xs md:text-sm font-black text-green-400 transition-colors leading-none">${dayData.remaining_slots}</span>
                    <span class="text-[6px] md:text-[7px] uppercase font-bold tracking-tighter text-gray-500 -mt-0.5 md:-mt-1 group-hover:text-gray-400 transition-colors">Slot</span>`;
            }

            html += `
                <div class="${classes}" ${isAvailable ? `onclick="selectDate('${dateStr}', ${day})"` : ''}>
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
    });

    document.getElementById('next-month').addEventListener('click', () => {
        currentMonth++;
        if (currentMonth > 11) { currentMonth = 0; currentYear++; }
        fetchDates();
    });

    // Initialize
    fetchDates();

    // Toggle DP Input
    const radioDp = document.getElementById('radio-dp');
    const radioLunas = document.getElementById('radio-lunas');
    const dpContainer = document.getElementById('dp-input-container');
    const dpInput = document.getElementById('dp-input');

    function toggleDpInput() {
        if (radioDp.checked) {
            dpContainer.classList.remove('hidden');
            dpInput.required = true;
        } else {
            dpContainer.classList.add('hidden');
            dpInput.required = false;
        }
    }

    radioDp.addEventListener('change', toggleDpInput);
    radioLunas.addEventListener('change', toggleDpInput);
    toggleDpInput(); // Run on load
</script>
@endpush
