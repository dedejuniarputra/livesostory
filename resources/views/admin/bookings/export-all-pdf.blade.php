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

        .text-gold {
            color: #856404;
            font-weight: bold;
        }

        .small-gray {
            font-size: 8px;
            color: #777;
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
                <td style="border:none; padding:0; width: 60%;">
                    <strong>Kategori:</strong> {{ ucfirst($status) }}<br>
                    @if(request('search'))
                        <strong>Pencarian:</strong> "{{ request('search') }}"<br>
                    @endif
                    @if(request('date'))
                        <strong>Tanggal:</strong> {{ \Carbon\Carbon::parse(request('date'))->format('d M Y') }}<br>
                    @endif
                    @if(request('month'))
                        <strong>Bulan:</strong> {{ \Carbon\Carbon::parse(request('month'))->format('F Y') }}<br>
                    @endif
                </td>
                <td style="border:none; padding:0; text-align: right; vertical-align: top;">
                    <strong>Tanggal Cetak:</strong> {{ now()->format('d M Y, H:i') }} WIB
                </td>
            </tr>
        </table>
    </div>

    <table>
        <thead>
            <tr>
                <th width="4%" class="text-center">No</th>
                <th width="18%">Pelanggan</th>
                <th width="10%">IG</th>
                <th width="15%">Paket</th>
                <th width="13%">Waktu</th>
                <th width="15%">Pembayaran</th>
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
                    <td>{{ $booking->ig_username ?? '-' }}</td>
                    <td>{{ $booking->package->name ?? '-' }}</td>
                    <td>
                        {{ $booking->booking_date->format('d M Y') }}<br>
                        <span class="small-gray">Jam: {{ $booking->booking_time ?? '-' }}</span>
                    </td>
                    <td>
                        <span
                            style="text-transform: uppercase; font-size: 8px; font-weight: bold; color: #666;">{{ $booking->payment_type }}</span><br>
                        <span class="text-gold">Rp {{ number_format($booking->amount_to_pay, 0, ',', '.') }}</span>
                    </td>
                    <td style="word-wrap: break-word;">{{ $booking->location ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data booking.</td>
                </tr>
            @endforelse
        </tbody>
        @if($bookings->count() > 0)
            <tfoot>
                <tr>
                    <td colspan="5" style="text-align: right; font-weight: bold; background-color: #f9fafb; padding: 10px;">
                        TOTAL OMSET:</td>
                    <td colspan="2"
                        style="font-size: 14px; color: #155724; font-weight: bold; background-color: #f9fafb; padding: 10px;">
                        Rp {{ number_format($bookings->sum('amount_to_pay'), 0, ',', '.') }}
                    </td>
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem LIVESOSTORY.CO</p>
    </div>
</body>

</html>