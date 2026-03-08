<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LIVESOSTORY.CO — Redirecting to WhatsApp</title>
    <meta http-equiv="refresh" content="4;url={{ $redirectUrl }}">
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
        <p class="mb-8">Anda akan otomatis kembali ke Halaman Pembayaran setelah pesan terkirim.</p>
        <a href="{{ $redirectUrl }}"
            class="text-[10px] tracking-[0.2em] uppercase text-gold-400/50 hover:text-gold-400 transition-colors border-b border-gold-400/20 pb-1">Klik
            di sini jika tidak otomatis kembali</a>
    </div>

    <script>
        (function () {
            var waUrl = '{!! $waUrl !!}';
            var redirectUrl = '{!! $redirectUrl !!}';
            var redirected = false;

            function goToTarget() {
                if (!redirected) {
                    redirected = true;
                    setTimeout(function () {
                        window.location.replace(redirectUrl);
                    }, 100);
                }
            }

            // 1. Launch WhatsApp
            window.location.href = waUrl;

            // 2. React gracefully when user returns to this tab
            setTimeout(function () {
                window.addEventListener('focus', goToTarget);
                document.addEventListener('visibilitychange', function () {
                    if (document.visibilityState === 'visible') {
                        goToTarget();
                    }
                });
                window.addEventListener('pageshow', function (event) {
                    if (event.persisted) {
                        goToTarget();
                    }
                });
            }, 1000);

            // 3. Fallback timeout if they stay on this page too long or events fail
            setTimeout(goToTarget, 4000);
        })();
    </script>
</body>

</html>