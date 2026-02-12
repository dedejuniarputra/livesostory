<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book {{ $package->name }} — LIVESOSTORY.CO</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-dark-950 text-white font-sans antialiased min-h-screen">

    <!-- Navbar -->
    <nav class="bg-dark-900 border-b border-dark-800">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <a href="/" class="text-white tracking-ultra-wide text-sm font-light uppercase">LIVESOSTORY.CO</a>
                <a href="/" class="text-xs tracking-widest uppercase text-gray-400 hover:text-gold-400 transition-colors">← Back to Home</a>
            </div>
        </div>
    </nav>

    <div class="max-w-5xl mx-auto px-6 lg:px-8 py-12">
        <div class="grid lg:grid-cols-3 gap-10">
            <!-- Package Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 glass p-8">
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
                                    <svg class="w-3 h-3 text-gold-400 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
                            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors">
                        </div>
                        <div>
                            <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">No. Telepon *</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" required
                               class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors">
                    </div>

                    <!-- Location -->
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Lokasi / Alamat</label>
                        <textarea name="location" rows="3" placeholder="Contoh: Taman Kota Bandung, Jl. Merdeka No. 123" class="w-full bg-dark-800/50 border border-dark-700 text-white text-sm px-5 py-3.5 focus:border-gold-400 focus:ring-0 transition-colors resize-none placeholder-gray-600">{{ old('location') }}</textarea>
                    </div>

                    <!-- Date Picker -->
                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-4">Pilih Tanggal *</label>
                        <div id="calendar-container" class="bg-dark-800/50 border border-dark-700 p-6">
                            <div class="flex items-center justify-between mb-6">
                                <button type="button" id="prev-month" class="text-gray-400 hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </button>
                                <h3 id="calendar-month" class="text-sm tracking-widest uppercase text-white"></h3>
                                <button type="button" id="next-month" class="text-gray-400 hover:text-white transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>
                            <div class="grid grid-cols-7 gap-1 mb-2">
                                <div class="text-center text-xs text-gray-500 py-2">Min</div>
                                <div class="text-center text-xs text-gray-500 py-2">Sen</div>
                                <div class="text-center text-xs text-gray-500 py-2">Sel</div>
                                <div class="text-center text-xs text-gray-500 py-2">Rab</div>
                                <div class="text-center text-xs text-gray-500 py-2">Kam</div>
                                <div class="text-center text-xs text-gray-500 py-2">Jum</div>
                                <div class="text-center text-xs text-gray-500 py-2">Sab</div>
                            </div>
                            <div id="calendar-days" class="grid grid-cols-7 gap-1"></div>

                            <div class="flex items-center gap-6 mt-4 pt-4 border-t border-dark-700">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-green-500/30 border border-green-500 rounded-sm"></div>
                                    <span class="text-xs text-gray-500">Tersedia</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-red-500/30 border border-red-500 rounded-sm"></div>
                                    <span class="text-xs text-gray-500">Tidak Tersedia</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-gold-400 rounded-sm"></div>
                                    <span class="text-xs text-gray-500">Dipilih</span>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="booking_date" id="selected-date" value="{{ old('booking_date') }}" required>
                        <p id="selected-date-text" class="text-sm text-gold-400 mt-2"></p>
                    </div>

                    <div>
                        <label class="block text-xs tracking-widest uppercase text-gray-400 mb-2">Catatan Tambahan</label>
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
        let bookedDates = [];
        let blockedDates = [];
        let selectedDate = null;

        const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        async function fetchDates() {
            try {
                const res = await fetch(`/api/available-dates?month=${currentMonth + 1}&year=${currentYear}`);
                const data = await res.json();
                bookedDates = data.booked || [];
                blockedDates = data.blocked || [];
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
                html += '<div></div>';
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
                const dateObj = new Date(currentYear, currentMonth, day);
                const isPast = dateObj <= today;
                const isBooked = bookedDates.includes(dateStr);
                const isBlocked = blockedDates.includes(dateStr);
                const isSelected = selectedDate === dateStr;
                const isUnavailable = isPast || isBooked || isBlocked;

                let classes = 'text-center py-2.5 text-sm rounded-sm transition-all duration-200 ';

                if (isSelected) {
                    classes += 'bg-gold-400 text-dark-950 font-semibold cursor-pointer';
                } else if (isUnavailable) {
                    classes += 'bg-red-500/10 text-red-400/50 cursor-not-allowed line-through';
                } else {
                    classes += 'bg-green-500/10 text-green-400 cursor-pointer hover:bg-gold-400/20 hover:text-gold-400';
                }

                html += `<div class="${classes}" ${!isUnavailable ? `onclick="selectDate('${dateStr}', ${day})"` : ''} title="${isBooked ? 'Sudah dibooking' : isBlocked ? 'Diblokir' : isPast ? 'Sudah lewat' : 'Tersedia'}">${day}</div>`;
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
