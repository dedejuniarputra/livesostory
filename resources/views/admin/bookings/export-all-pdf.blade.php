<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Data Booking - {{ ucfirst($status) }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 10px;
            color: #666;
        }

        .info {
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #fef9c3;
            /* Soft Yellow (Tailwind yellow-100) */
            font-weight: bold;
            text-align: left;
            border: 1px solid #ddd;
            padding: 8px;
        }

        td {
            border: 1px solid #ddd;
            padding: 8px;
            vertical-align: top;
        }

        .text-center {
            text-align: center;
        }

        .footer {
            margin-top: 30px;
            font-size: 9px;
            text-align: center;
            color: #999;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .badge-pending {
            background: #fff3cd;
            color: #856404;
        }

        .badge-completed {
            background: #d4edda;
            color: #155724;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LIVESOSTORY.CO</h1>
        <p>Laporan Data Booking Pelanggan</p>
    </div>

    <div class="info">
        <table>
            <tr>
                <td style="border:none; padding:0; width: 50%;">
                    <strong>Kategori:</strong> {{ ucfirst($status) }}
                </td>
                <td style="border:none; padding:0; text-align: right;">
                    <strong>Tanggal Cetak:</strong> {{ now()->format('d M Y, H:i') }} WIB
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="25%">Pelanggan</th>
                <th width="30%">Paket</th>
                <th width="15%">Tanggal Acara</th>
                <th width="25%">Lokasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($bookings as $index => $booking)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $booking->name }}</strong><br>
                        {{ $booking->phone }}
                    </td>
                    <td>{{ $booking->package->name ?? '-' }}</td>
                    <td>{{ $booking->booking_date->format('d M Y') }}</td>
                    <td>{{ $booking->location ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data booking.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem LIVESOSTORY.CO</p>
    </div>
</body>

</html>