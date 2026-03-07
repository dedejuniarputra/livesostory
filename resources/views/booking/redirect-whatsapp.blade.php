<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIVESOSTORY.CO — Redirecting to WhatsApp</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/ph.jpeg') }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            padding: 2rem;
        }

        .spinner {
            width: 50px;
            height: 50px;
            margin: 0 auto 1.5rem;
            border: 3px solid rgba(212, 175, 55, 0.2);
            border-top-color: #d4af37;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        h1 {
            font-size: 1.5rem;
            font-weight: 300;
            letter-spacing: 0.1em;
            margin-bottom: 0.5rem;
            color: #d4af37;
        }

        p {
            font-size: 0.875rem;
            color: #999;
            letter-spacing: 0.05em;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="spinner"></div>
        <h1>MEMBUKA WHATSAPP</h1>
        <p class="mb-8">Anda akan otomatis kembali ke Beranda setelah pesan terkirim.</p>
        <a href="{{ route('home') }}"
            class="text-[10px] tracking-[0.2em] uppercase text-gold-400/50 hover:text-gold-400 transition-colors border-b border-gold-400/20 pb-1">Klik
            di sini jika tidak otomatis kembali</a>
    </div>

    <script>
        (function () {
            var waUrl = '{{ $waUrl }}';
            var redirected = false;

            function goToHome() {
                if (!redirected) {
                    redirected = true;
                    // Use a slight delay to ensure the browser handles the location change smoothly
                    setTimeout(function () {
                        window.location.replace('{{ route("home") }}');
                    }, 500);
                }
            }

            // 1. Launch WhatsApp immediately
            window.location.href = waUrl;

            // 2. Arm the "Return home" listeners AFTER a delay
            // This prevents the focus/visibility events from firing prematurely
            // while the protocol handler (WhatsApp) is still launching.
            setTimeout(function() {
                // Detect when the window regains focus (means they came back from WA)
                window.addEventListener('focus', goToHome);

                // Detect visibility change (more reliable on some mobile browsers)
                document.addEventListener('visibilitychange', function () {
                    if (document.visibilityState === 'visible') {
                        goToHome();
                    }
                });

                // Detect pageshow (back button)
                window.addEventListener('pageshow', function (event) {
                    if (event.persisted) {
                        goToHome();
                    }
                });
            }, 2000);

            // 3. Fallback: If user clicks the manual link
            document.querySelector('a').addEventListener('click', function () {
                redirected = true;
            });

            // 4. Safety Timeout: If they stay on this page for too long
            // Increased to 10 seconds
            setTimeout(goToHome, 10000);
        })();
    </script>
</body>

</html>