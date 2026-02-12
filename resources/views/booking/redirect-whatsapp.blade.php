<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Redirecting to WhatsApp...</title>
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
            to { transform: rotate(360deg); }
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
        <p>Anda akan diarahkan kembali ke halaman utama...</p>
    </div>

    <script>
        (function() {
            // Open WhatsApp in new tab/window
            var waUrl = '{{ $waUrl }}';
            var newWindow = window.open(waUrl, '_blank');
            
            // Fallback if popup blocked - try to open in same window
            if (!newWindow || newWindow.closed || typeof newWindow.closed == 'undefined') {
                // Popup blocked, open in same window
                window.location.replace(waUrl);
            } else {
                // Popup opened successfully, redirect current page to home
                // Use replace() to prevent back button from returning to this page
                window.location.replace('{{ route("home") }}');
            }
        })();
    </script>
</body>
</html>
