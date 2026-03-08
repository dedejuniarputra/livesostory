<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $booking->name }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
            margin: 0;
            padding: 20px;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            background: #fff;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #1a1a1a;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-section {
            width: 100%;
            margin-bottom: 30px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            vertical-align: top;
            padding: 4px 0;
        }

        .label {
            font-weight: bold;
            color: #555;
            width: 120px;
        }

        .value {
            color: #111;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            border: 1px solid #ddd;
        }

        .details-table th,
        .details-table td {
            padding: 12px 15px;
            border: 1px solid #ccc;
            /* More visible border */
            text-align: left;
        }

        .details-table th {
            /* background-color: #f8f9fa; Removing background for cleaner look as in reference */
            color: #333;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 1px;
            border-bottom: 2px solid #ddd;
        }

        .text-right {
            text-align: right !important;
        }

        .text-center {
            text-align: center !important;
        }

        .total-row td {
            font-weight: bold;
            font-size: 12px;
            /* background-color: #f8f9fa; Removing background for cleaner look */
        }

        .total-amount {
            color: #b8860b;
            /* Dark goldenrod */
            font-size: 16px !important;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            border-radius: 4px;
            letter-spacing: 1px;
        }

        .status-completed {
            background-color: #d1ead7;
            color: #125732;
            border: 1px solid #c2e2c9;
        }

        .status-pending {
            background-color: #fef7d9;
            color: #8c6a08;
            border: 1px solid #f6ecbe;
        }

        .status-other {
            background-color: #eaeaea;
            color: #444;
            border: 1px solid #ddd;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 11px;
            color: #777;
            /* border-top: 1px solid #eee; Removed top border */
            padding-top: 20px;
        }

        .payment-info {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .payment-info h4 {
            margin: 0 0 10px 0;
            color: #111;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <div class="header">
            <h1>LIVESOSTORY.CO</h1>
            <p>Invoice / Bukti Pemesanan</p>
        </div>

        <div class="info-section">
            <table class="info-table">
                <tr>
                    <td style="width: 50%;">
                        <table class="info-table">
                            <tr>
                                <td class="label">Nama Client</td>
                                <td class="value">: {{ $booking->name }}</td>
                            </tr>
                            <tr>
                                <td class="label">No. Telepon</td>
                                <td class="value">: {{ $booking->phone }}</td>
                            </tr>
                            <tr>
                                <td class="label">Instagram</td>
                                <td class="value">: {{ $booking->ig_username ?? '-' }}</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 50%;">
                        <table class="info-table">
                            <tr>
                                <td class="label">Lokasi Acara</td>
                                <td class="value">: <span
                                        style="word-wrap: break-word; word-break: break-all; max-width: 250px; display: inline-block; vertical-align: top;">{{ $booking->location ?? '-' }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="label">Tanggal Booking</td>
                                <td class="value">: {{ $booking->created_at->format('d F Y') }}</td>
                            </tr>
                            <tr>
                                <td class="label">Status</td>
                                <td class="value">:
                                    @if($booking->status === 'completed')
                                        <span class="status-badge status-completed">COMPLETED</span>
                                    @elseif($booking->status === 'pending')
                                        <span class="status-badge status-pending">PENDING</span>
                                    @else
                                        <span class="status-badge status-other">{{ strtoupper($booking->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>

        <table class="details-table">
            <thead>
                <tr>
                    <th style="width: 40%;">Deskripsi Layanan</th>
                    <th class="text-center" style="width: 20%;">Tanggal Acara</th>
                    <th class="text-center" style="width: 15%;">Jam Acara</th>
                    <th class="text-right" style="width: 25%;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding-top: 20px; padding-bottom: 20px;">
                        <strong>Paket: {{ $booking->package->name ?? '-' }}</strong>

                        @if($booking->package && $booking->package->features)
                            <div style="margin-top: 8px; font-size: 10px; color: #555; line-height: 1.4;">
                                <ul style="margin: 0; padding-left: 15px;">
                                    @foreach(is_array($booking->package->features) ? $booking->package->features : explode("\n", $booking->package->features) as $feature)
                                        @if(trim($feature))
                                            <li>{{ trim($feature) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if($booking->notes)
                            <br><br>
                            <span style="font-size: 10px; color: #777;">Catatan Tambahan:</span><br>
                            <span style="font-size: 11px;">{{ $booking->notes }}</span>
                        @endif
                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        {{ $booking->booking_date->format('d M Y') }}
                    </td>
                    <td class="text-center" style="vertical-align: middle;">{{ $booking->booking_time ?? '-' }}</td>
                    <td class="text-right" style="vertical-align: middle;">Rp
                        {{ number_format($booking->package->price ?? 0, 0, ',', '.') }}
                    </td>
                </tr>
                @if(strtolower($booking->payment_type) === 'dp')
                    <tr>
                        <td colspan="3" class="text-right" style="font-size: 11px;">TOTAL HARGA PAKET</td>
                        <td class="text-right" style="font-size: 12px;">Rp
                            {{ number_format($booking->package->price ?? 0, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right" style="font-size: 11px;">PEMBAYARAN DP</td>
                        <td class="text-right" style="font-size: 12px; color: #125732;">- Rp
                            {{ number_format($booking->amount_to_pay, 0, ',', '.') }}
                        </td>
                    </tr>
                    <tr class="total-row">
                        <td colspan="3" class="text-right" style="color: #b8860b; padding-top: 15px;">SISA PEMBAYARAN</td>
                        <td class="text-right total-amount" style="color: #b8860b; padding-top: 15px;">
                            Rp {{ number_format(($booking->package->price ?? 0) - $booking->amount_to_pay, 0, ',', '.') }}
                        </td>
                    </tr>
                @else
                    <tr class="total-row">
                        <td colspan="3" class="text-right">TOTAL PEMBAYARAN (LUNAS)</td>
                        <td class="text-right total-amount">Rp {{ number_format($booking->amount_to_pay, 0, ',', '.') }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="payment-info">
            <h4>KETERANGAN PEMBAYARAN</h4>
            <div style="font-size: 11px; color: #555; line-height: 1.6;">
                <ul style="margin-top: 5px; margin-bottom: 5px; padding-left: 15px;">
                    <li></strong>Pembayaran yang tercatat pada invoice ini berjenis
                        <strong>{{ strtoupper($booking->payment_type) }}</strong>.
                    </li>
                    <li>Apabila cancel Dp = <strong>HANGUS</strong></li>
                    <li>Pelunasan max H+3 setelah acara</li>
                    <li>Belum Lunas = <strong>Belum di proses</strong></li>
                    <li>File Akan di kirim 3-7 Hari setelah pelunasan pengerjaan sesuai antrian, <strong>No
                            Spam</strong>.</li>
                    <li>Album dan video estimasi pengerjaan 3 Mingguan bisa kurang bisa lebih di kerjakan sesuai antrian
                        jangan tanyakan berulang</li>
                    <li>Harap simpan invoice ini sebagai tanda bukti pemesanan jadwal yang sah dari LIVESOSTORY.CO.</li>
                </ul>
            </div>
        </div>

        <div class="footer">
            <h3 style="color: #1a1a1a; margin-bottom: 5px; font-size: 14px; letter-spacing: 1px;">TERIMA KASIH</h3>
            <p style="margin-top: 0; margin-bottom: 15px;">Atas kepercayaannya memilih LIVESOSTORY.CO untuk mengabadikan
                momen berharga Anda.</p>
            <p>IG: @livesostory.co</p>
        </div>
    </div>
</body>

</html>