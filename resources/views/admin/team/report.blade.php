<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Gaji - {{ $team->name }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            text-transform: uppercase;
        }

        .info-grid {
            margin-bottom: 30px;
        }

        .info-row {
            margin-bottom: 5px;
        }

        .info-label {
            width: 100px;
            display: inline-block;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
            text-transform: uppercase;
            font-size: 10px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f0f0f0;
        }

        .footer {
            margin-top: 80px;
            text-align: center;
            font-size: 11px;
            color: #666;
            font-style: italic;
        }

        .signature-box {
            width: 200px;
            display: inline-block;
            text-align: center;
        }

        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>LAPORAN RINGKASAN GAJI</h1>
        @if($month)
            <p>Periode: {{ \Carbon\Carbon::parse($month . '-01')->format('F Y') }}</p>
        @endif
        <p>Tanggal Cetak: {{ date('d F Y') }}</p>
    </div>

    <div class="info-grid">
        <div class="info-row">
            <span class="info-label">Nama</span>: {{ $team->name }}
        </div>
        <div class="info-row">
            <span class="info-label">Posisi</span>: {{ $team->role }}
        </div>
        <div class="info-row">
            <span class="info-label">Rekening</span>: {{ $team->bank_account ?? '-' }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="30">No</th>
                <th>Tanggal Kerja</th>
                <th>Job Description</th>
                <th align="right">Total</th>
            </tr>
        </thead>
        <tbody>
            @php $total = 0; @endphp
            @forelse($team->salaryPayments as $i => $payment)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $payment->start_date->format('d F Y') }}</td>
                    <td>{{ $payment->job_description }}</td>
                    <td align="right">Rp {{ number_format($payment->total_amount, 0, ',', '.') }}</td>
                </tr>
                @php $total += $payment->total_amount; @endphp
            @empty
                <tr>
                    <td colspan="4" align="center">Belum ada data pembayaran gaji.</td>
                </tr>
            @endforelse
        </tbody>
        @if($team->salaryPayments->isNotEmpty())
            <tfoot>
                <tr class="total-row">
                    <td colspan="3" align="right">TOTAL PEMBAYARAN TEAM</td>
                    <td align="right">Rp {{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        @endif
    </table>

    <div class="footer">
        <p>Dokumen ini diterbitkan secara digital oleh sistem LIVESOSTORY.CO</p>
        <p>Terima kasih atas dedikasi dan kontribusi Anda.</p>
    </div>
</body>

</html>