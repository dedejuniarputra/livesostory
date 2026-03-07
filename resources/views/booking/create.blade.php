<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIVESOSTORY.CO — Book {{ $package->name }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="{{ asset('images/ph.jpeg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dark-950 text-white font-sans antialiased min-h-screen">

    <!-- Navbar -->
    <x-navbar class="bg-dark-950/95 backdrop-blur-md border-b border-dark-800" />

    <!-- Spacer to push content below the fixed navbar (navbar height = h-20) -->
    <div class="h-24"></div>

    <div class="max-w-5xl mx-auto px-6 lg:px-8 pb-12">
        <div class="grid lg:grid-cols-3 gap-10">
            <!-- Package Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 glass p-8">
                    <p class="text-gold-400 text-xs tracking-widest uppercase mb-2">Selected Package</p>
                    <h2 class="font-display text-2xl font-light tracking-wide mb-3">{{ $package->name }}</h2>
                    <p class="text-gray-500 text-sm mb-4 leading-relaxed">{{ $package->description }}</p>

                    <div class="border-t border-dark-700 pt-4 mb-4">
                        <span class="text-2xl font-light">{{ $package->formatted_price }}</span>
                    </div>

                    @if($package->features)
                        <ul class="space-y-2">
                            @foreach($package->features as $feature)
                                <li class="flex items-start text-xs text-gray-400">
                                    <svg class="w-3 h-3 text-gold-400 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    {{ $feature }}
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <h1 class="font-display text-3xl font-light tracking-wide mb-8">Book Your Session</h1>

                @if($errors->any())
                    <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 text-red-400 text-sm rounded">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store', $package) }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama
                                *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                placeholder="Contoh: Budi Santoso"
                                class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama IG / Link IG
                                anda *</label>
                            <input type="text" name="ig_username" value="{{ old('ig_username') }}" required
                                placeholder="Contoh: @budi_santoso atau instagram.com/budi_santoso"
                                class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">NO TELPON
                                *</label>
                            <input type="tel" name="phone" value="{{ old('phone') }}" required maxlength="13"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                placeholder="Contoh: 081234567890"
                                class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">JAM ACARA ANDA
                                *</label>
                            <input type="time" name="booking_time" value="{{ old('booking_time') }}" required
                                class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors [color-scheme:dark]">
                        </div>
                    </div>

                    <!-- Location / Alamat -->
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">ALAMAT/SERLOK ANDA
                            *</label>
                        <textarea name="location" rows="3" placeholder="Contoh: Taman Kota Bandung, Jl. Merdeka No. 123"
                            required
                            class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors resize-none placeholder-gray-600">{{ old('location') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-[11px] md:text-xs tracking-widest uppercase text-gray-400 mb-2">Metode
                            Pembayaran
                            *</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <label
                                class="relative flex flex-col p-4 md:p-6 bg-dark-800/50 border border-dark-700 cursor-pointer hover:border-gold-400 transition-colors group">
                                <input type="radio" name="payment_type" value="lunas" {{ old('payment_type', 'lunas') === 'lunas' ? 'checked' : '' }} class="sr-only peer">
                                <div
                                    class="absolute top-4 md:top-6 right-4 md:right-6 w-5 h-5 border-2 border-dark-600 rounded-full peer-checked:border-gold-400 peer-checked:bg-gold-400 transition-all flex items-center justify-center">
                                    <div class="w-2 h-2 bg-dark-950 rounded-full"></div>
                                </div>
                                <span
                                    class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-gray-400 group-hover:text-white transition-colors">Lunas
                                    (Pelunasan Di Awal)</span>
                                <span class="text-xl md:text-2xl font-light mt-2">{{ $package->formatted_price }}</span>
                                <span
                                    class="text-[9px] md:text-[10px] text-gray-500 mt-1 uppercase tracking-wider">Total
                                    Pembayaran
                                    Penuh</span>
                            </label>
                            <label
                                class="relative flex flex-col p-4 md:p-6 bg-dark-800/50 border border-dark-700 cursor-pointer hover:border-gold-400 transition-colors group">
                                <input type="radio" name="payment_type" value="dp" {{ old('payment_type') === 'dp' ? 'checked' : '' }} class="sr-only peer">
                                <div
                                    class="absolute top-4 md:top-6 right-4 md:right-6 w-5 h-5 border-2 border-dark-600 rounded-full peer-checked:border-gold-400 peer-checked:bg-gold-400 transition-all flex items-center justify-center">
                                    <div class="w-2 h-2 bg-dark-950 rounded-full"></div>
                                </div>
                                <span
                                    class="text-[10px] md:text-xs font-bold uppercase tracking-widest text-gray-400 group-hover:text-white transition-colors">DP
                                    (Booking Fee)</span>
                                <span
                                    class="text-xl md:text-2xl font-light mt-2">{{ $package->formatted_down_payment }}</span>
                                <span
                                    class="text-[9px] md:text-[10px] text-gray-500 mt-1 uppercase tracking-wider">Bayar
                                    DP Dulu
                                    Untuk Ambil Slot</span>
                            </label>
                        </div>
                    </div>

                    <!-- Date Picker -->
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-4">Pilih Tanggal
                            *</label>
                        @error('booking_date')
                            <div
                                class="mb-4 p-3 bg-red-500/10 border border-red-500/20 text-red-400 text-xs rounded flex items-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-sm font-medium text-white">Jadwal & Slot: <span id="calendar-month"></span>
                            </h3>
                            <div class="flex items-center gap-2">
                                <button type="button" id="prev-month"
                                    class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                </button>
                                <button type="button" id="next-month"
                                    class="p-1.5 bg-dark-800 border border-dark-700 rounded hover:bg-dark-700 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                        {{ $dayName }}
                                    </div>
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
                                <span>Penuh / Libur</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <div class="w-3 h-3 bg-gold-400 rounded-sm"></div>
                                <span>Dipilih</span>
                            </div>
                        </div>
                        <input type="hidden" name="booking_date" id="selected-date" value="{{ old('booking_date') }}"
                            required>
                        <p id="selected-date-text" class="text-sm text-gold-400 mt-2"></p>
                    </div>

                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Catatan
                            Tambahan</label>
                        <textarea name="notes" rows="3" placeholder="Konsep foto, request khusus, dll..."
                            class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors resize-none placeholder-gray-600">{{ old('notes') }}</textarea>
                    </div>

                    <button type="submit"
                        class="w-full px-8 py-4 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-semibold hover:bg-gold-300 transition-all duration-300">
                        Lanjut ke Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>

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
    </script>
</body>

</html>