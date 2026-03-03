<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIVESOSTORY.CO — Pembayaran</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/jpeg" href="{{ asset('build/assets/ph.jpeg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dark-950 text-white font-sans antialiased min-h-screen">

    <!-- Navbar -->
    <x-navbar class="bg-dark-950/95 backdrop-blur-md border-b border-dark-800" />

    <div class="max-w-3xl mx-auto px-6 lg:px-8 pt-32 pb-12">
        <!-- Success Message -->
        <div class="text-center mb-10">
            <div
                class="w-16 h-16 bg-green-500/10 border border-green-500/30 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="font-display text-3xl font-light tracking-wide mb-2">Booking Berhasil!</h1>
            <p class="text-gray-500 text-sm mb-6">Silakan lakukan pembayaran untuk mengonfirmasi booking Anda.</p>

            <!-- Timer Wrapper -->
            <div class="max-w-xl mx-auto border border-red-500/30 bg-red-500/5 p-4 mb-8">
                <div class="flex flex-col items-center">
                    <span id="timer-display"
                        class="font-mono text-3xl text-red-500 font-bold tracking-[0.2em] mb-1">10:00</span>
                    <span class="text-[10px] text-red-400 uppercase tracking-[0.3em] font-semibold">Sisa Waktu
                        Pembayaran</span>
                </div>
            </div>
        </div>

        <!-- Payment Modal Popup -->
        <div id="payment-modal" class="fixed inset-0 z-[60] flex items-center justify-center hidden p-6">
            <div class="absolute inset-0 bg-dark-950/80 backdrop-blur-sm" onclick="closeModal()"></div>
            <div class="relative bg-dark-900 border border-gold-400/30 p-8 max-w-lg w-full shadow-2xl transform transition-all duration-300 scale-95 opacity-0"
                id="modal-content">
                <div class="flex items-start gap-5 mb-6">
                    <div class="w-12 h-12 bg-gold-400/20 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg class="w-6 h-6 text-gold-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-display text-gold-400 tracking-wide mb-1">Informasi Penting</h3>
                        <p class="text-sm text-gray-400 leading-relaxed">
                            Mohon lakukan transfer sesuai dengan paket <b>{{ $booking->package->name }}</b>
                            ({{ $booking->package->formatted_price }}) secara tepat.
                        </p>
                    </div>
                </div>

                <div class="space-y-4 mb-8 max-h-[40vh] overflow-y-auto custom-scrollbar pr-2">
                    @if($paymentInstructions)
                        @foreach(explode("\n", $paymentInstructions) as $line)
                            @if(trim($line))
                                <div class="flex items-start gap-3 text-xs text-gray-400">
                                    <div class="w-1.5 h-1.5 bg-gold-400 rounded-full mt-1.5 flex-shrink-0"></div>
                                    <p>{!! nl2br(e(ltrim(trim($line), '• '))) !!}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <div class="flex items-start gap-3 text-xs text-gray-400">
                            <div class="w-1.5 h-1.5 bg-gold-400 rounded-full mt-1.5"></div>
                            <p>Segera kirimkan <b>bukti pembayaran</b> setelah transfer dilakukan.</p>
                        </div>
                        <div class="flex items-start gap-3 text-xs text-gray-400">
                            <div class="w-1.5 h-1.5 bg-gold-400 rounded-full mt-1.5"></div>
                            <p>Gunakan tombol <b>Konfirmasi WhatsApp</b> di bawah untuk mengirim bukti.</p>
                        </div>
                    @endif
                </div>

                <button onclick="closeModal()"
                    class="w-full py-3 bg-gold-400 text-dark-950 text-xs tracking-widest uppercase font-bold hover:bg-gold-300 transition-colors">
                    SAYA MENGERTI
                </button>
            </div>
        </div>

        <!-- Booking Summary -->
        <div class="bg-dark-800/50 border border-dark-700 p-6 mb-8">
            <h2 class="text-xs tracking-widest uppercase text-gold-400 mb-4">Ringkasan Booking</h2>
            <div class="space-y-3">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Nama</span>
                    <span>{{ $booking->name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Paket</span>
                    <span>{{ $booking->package->name }}</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-400">Tanggal</span>
                    <span>{{ $booking->booking_date->format('d F Y') }}</span>
                </div>

                @if($booking->location)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Lokasi</span>
                        <span>{{ $booking->location }}</span>
                    </div>
                @endif
                @if($booking->location_link)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Link Lokasi</span>
                        <a href="{{ $booking->location_link }}" target="_blank"
                            class="text-gold-400 hover:text-gold-300 transition-colors underline">Buka Maps</a>
                    </div>
                @endif
                @if($booking->notes)
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-400">Catatan</span>
                        <span class="text-right max-w-[200px]">{{ $booking->notes }}</span>
                    </div>
                @endif
                <div class="border-t border-dark-700 pt-3 flex justify-between">
                    <span class="text-sm text-gray-400">Total Pembayaran</span>
                    <span class="text-xl font-light text-gold-400">{{ $booking->package->formatted_price }}</span>
                </div>
            </div>
        </div>

        <!-- Payment Accounts -->
        <div class="bg-dark-800/50 border border-dark-700 p-6 mb-8">
            <h2 class="text-xs tracking-widest uppercase text-gold-400 mb-4">Transfer ke Rekening</h2>

            @if($paymentAccounts->count() > 0)
                <div class="space-y-4">
                    @foreach($paymentAccounts as $account)
                        <div class="border border-dark-600 p-4 hover:border-gold-400/30 transition-colors">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-sm font-medium text-white">{{ $account->bank_name }}</span>
                                <button type="button" onclick="copyToClipboard('{{ $account->account_number }}')"
                                    class="text-xs text-gold-400 hover:text-gold-300 transition-colors">
                                    Copy
                                </button>
                            </div>
                            <p class="text-lg font-mono text-white tracking-wider">{{ $account->account_number }}</p>
                            <p class="text-xs text-gray-500 mt-1">a.n. {{ $account->account_holder }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-sm">Informasi rekening belum tersedia. Silakan hubungi kami.</p>
            @endif
        </div>

        <!-- Important Notes -->
        <div class="bg-yellow-500/5 border border-yellow-500/20 p-6 mb-8">
            <h3 class="text-xs tracking-widest uppercase text-yellow-400 mb-3">Catatan Penting</h3>
            <ul class="space-y-2 text-sm text-gray-400">
                @if($paymentInstructions)
                    @foreach(explode("\n", $paymentInstructions) as $line)
                        @if(trim($line))
                            <li class="flex items-start">
                                <span class="text-yellow-400 mr-2">•</span>
                                {!! nl2br(e(ltrim(trim($line), '• '))) !!}
                            </li>
                        @endif
                    @endforeach
                @else
                    <li class="flex items-start">
                        <span class="text-yellow-400 mr-2">•</span>
                        Transfer sesuai <b>Nominal Paket</b> yang tertera (Tanpa pembulatan)
                    </li>
                    <li class="flex items-start">
                        <span class="text-yellow-400 mr-2">•</span>
                        Setelah transfer, klik tombol di bawah untuk <b>Kirim Bukti Pembayaran</b> via WhatsApp
                    </li>
                    <li class="flex items-start">
                        <span class="text-yellow-400 mr-2">•</span>
                        Booking akan dikonfirmasi oleh team kami dalam 1x24 jam setelah bukti diterima
                    </li>
                @endif
            </ul>
        </div>

        <!-- Confirm Button -->
        <form action="{{ route('booking.confirm', $booking) }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full px-8 py-4 bg-green-600 text-white text-sm tracking-widest uppercase font-semibold hover:bg-green-500 transition-all duration-300 flex items-center justify-center gap-3">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
                Kirim Bukti & Konfirmasi via WhatsApp
            </button>
        </form>

        <form action="{{ route('booking.cancel', $booking) }}" method="POST" class="mt-4">
            @csrf
            <button type="submit"
                class="w-full px-8 py-3 border border-dark-700 text-gray-400 text-xs tracking-widest uppercase font-semibold hover:bg-red-500/10 hover:text-red-400 hover:border-red-500/30 transition-all duration-300">
                Batal & Pilih Tanggal Lain
            </button>
        </form>
    </div>
    </div>

    <script>
        const createdAt = new Date("{{ $booking->created_at->toIso8601String() }}").getTime();
        const expiryTime = createdAt + (10 * 60 * 1000); // 10 minutes

        function updateTimer() {
            const now = new Date().getTime();
            const distance = expiryTime - now;

            if (distance < 0) {
                clearInterval(timerInterval);
                handleExpiry();
                return;
            }

            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("timer-display").innerHTML =
                (minutes < 10 ? "0" + minutes : minutes) + ":" +
                (seconds < 10 ? "0" + seconds : seconds);

            if (distance < 60000) { // Critical state
                document.getElementById("timer-display").parentElement.parentElement.classList.add('animate-pulse');
            }
        }

        async function handleExpiry() {
            try {
                await fetch("{{ route('booking.cancel', $booking) }}", {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    }
                });
            } catch (e) {
                console.error('Failed to cancel automatically', e);
            }

            window.location.href = "{{ route('booking.create', $booking->package_id) }}?expired=1";
        }

        const timerInterval = setInterval(updateTimer, 1000);
        updateTimer();

        window.addEventListener('DOMContentLoaded', (event) => {
            const modal = document.getElementById('payment-modal');
            const content = document.getElementById('modal-content');

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 100);
        });

        function closeModal() {
            const modal = document.getElementById('payment-modal');
            const content = document.getElementById('modal-content');

            content.classList.remove('scale-100', 'opacity-100');
            content.classList.add('scale-95', 'opacity-0');
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                alert('Nomor rekening berhasil disalin!');
            });
        }
    </script>
</body>

</html>