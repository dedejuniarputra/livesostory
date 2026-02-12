<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Booking #{{ $booking->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #000;
            line-height: 1.5;
            padding: 30px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #000;
        }
        .header h1 {
            font-size: 20px;
            margin: 0 0 5px 0;
        }
        .header p {
            font-size: 10px;
            margin: 0;
            color: #666;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin: 20px 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #ddd;
        }
        td {
            padding: 8px 0;
            vertical-align: top;
        }
        .label {
            width: 35%;
            font-weight: bold;
        }
        .value {
            width: 65%;
        }
        .status {
            display: inline-block;
            padding: 3px 10px;
            background: #f0f0f0;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
        .package-box {
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 10px;
        }
        .package-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .package-price {
            font-size: 16px;
            font-weight: bold;
            margin-top: 10px;
        }
        ul {
            margin: 10px 0;
            padding-left: 20px;
        }
        li {
            margin: 5px 0;
        }
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 9px;
            color: #999;
        }
        .link {
            color: #0066cc;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>LIVESOSTORY.CO</h1>
        <p>Detail Booking</p>
    </div>

    <!-- Booking Info -->
    <div class="section-title">INFORMASI BOOKING</div>
    <table>
        <tr>
            <td class="label">Booking ID</td>
            <td class="value">#{{ $booking->id }}</td>
        </tr>
        <tr>
            <td class="label">Tanggal Booking</td>
            <td class="value">{{ $booking->created_at->format('d F Y, H:i') }} WIB</td>
        </tr>
        <tr>
            <td class="label">Status</td>
            <td class="value"><span class="status">{{ strtoupper($booking->status) }}</span></td>
        </tr>
    </table>

    <!-- Client Info -->
    <div class="section-title">DATA CLIENT</div>
    <table>
        <tr>
            <td class="label">Nama</td>
            <td class="value">{{ $booking->name }}</td>
        </tr>
        <tr>
            <td class="label">Email</td>
            <td class="value">{{ $booking->email }}</td>
        </tr>
        <tr>
            <td class="label">Telepon</td>
            <td class="value">{{ $booking->phone }}</td>
        </tr>
    </table>

    <!-- Event Details -->
    <div class="section-title">DETAIL ACARA</div>
    <table>
        <tr>
            <td class="label">Tanggal Acara</td>
            <td class="value">{{ $booking->booking_date->format('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Lokasi</td>
            <td class="value">{{ $booking->location ?? '-' }}</td>
        </tr>
        @if(!empty($booking->notes))
        <tr>
            <td class="label">Catatan</td>
            <td class="value">{{ $booking->notes }}</td>
        </tr>
        @endif
    </table>

    <!-- Package Details -->
    <div class="section-title">PAKET YANG DIPILIH</div>
    <div class="package-box">
        <div class="package-name">{{ $booking->package->name }}</div>
        
        @if($booking->package->description)
        <p style="color: #666; font-size: 11px; margin: 5px 0;">{{ $booking->package->description }}</p>
        @endif
        
        @if($booking->package->features && count($booking->package->features) > 0)
        <ul>
            @foreach($booking->package->features as $feature)
            <li>{{ $feature }}</li>
            @endforeach
        </ul>
        @endif
        
        <div class="package-price">{{ $booking->package->formatted_price }}</div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem LIVESOSTORY.CO</p>
        <p>Tanggal Cetak: {{ now()->format('d F Y, H:i') }} WIB</p>
    </div>
</body>
</html>
