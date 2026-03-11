<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Slip Gaji - {{ $salary->teamMember->name }}</title>
    <style>
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 12px;
            color: #1a1a1a;
            line-height: 1.6;
            margin: 0;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 5px;
            font-weight: bold;
        }

        .header p {
            margin: 5px 0 0;
            font-size: 12px;
            color: #333;
        }

        .main-info {
            width: 100%;
            margin-bottom: 30px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .company-col {
            width: 50%;
        }

        .employee-col {
            width: 50%;
        }

        .company-name {
            font-weight: bold;
            font-size: 14px;
            display: block;
            margin-bottom: 5px;
        }

        .label {
            width: 100px;
            color: #333;
        }

        .colon {
            width: 15px;
        }

        .value {
            font-weight: normal;
        }

        .divider {
            border-top: 1.5px solid #333;
            margin: 20px 0;
        }

        .section-header {
            font-weight: bold;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 15px;
            text-transform: capitalize;
        }

        .finance-table {
            width: 100%;
            border-collapse: collapse;
        }

        .finance-table td {
            padding: 8px 0;
        }

        .text-right {
            text-align: right;
        }

        .total-row {
            font-weight: bold;
            border-top: 1px solid #1a1a1a;
            font-size: 13px;
        }

        .grand-total {
            border-top: 1.5px solid #1a1a1a;
            border-bottom: 1.5px solid #1a1a1a;
            margin-top: 25px;
            padding: 12px 0;
        }

        .grand-total table {
            width: 100%;
        }

        .grand-total-text {
            font-weight: bold;
            font-size: 16px;
        }

        .footer {
            margin-top: 80px;
            text-align: center;
            font-size: 11px;
            color: #666;
            font-style: italic;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>SLIP GAJI</h1>
        <p>Tanggal: {{ $salary->start_date->format('d F Y') }}</p>
    </div>

    <table class="main-info">
        <tr>
            <td class="company-col">
                <span class="company-name">LIVESOSTORY.CO</span>
                Lampung, Indonesia<br>
                Email: livesostory.co@gmail.com<br>
                Instagram: @livesostory.co
            </td>
            <td class="employee-col">
                <table style="width: 100%;">
                    <tr>
                        <td class="label">Nama</td>
                        <td class="colon">:</td>
                        <td class="value">{{ $salary->teamMember->name }}</td>
                    </tr>
                    <tr>
                        <td class="label">Jabatan</td>
                        <td class="colon">:</td>
                        <td class="value">{{ $salary->teamMember->role }}</td>
                    </tr>
                    <tr>
                        <td class="label">Rekening</td>
                        <td class="colon">:</td>
                        <td class="value">{{ $salary->teamMember->bank_account ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="divider"></div>

    <div class="section-header">Penerimaan</div>
    <table class="finance-table">
        <tr>
            <td>Gaji {{ $salary->job_description }}</td>
            <td class="text-right">Rp {{ number_format($salary->total_amount, 0, ',', '.') }}</td>
        </tr>
    </table>

    <div class="grand-total">
        <table>
            <tr>
                <td class="grand-total-text">Total Diterima Karyawan</td>
                <td class="text-right grand-total-text">Rp {{ number_format($salary->total_amount, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <p>Dokumen ini diterbitkan secara digital oleh sistem LIVESOSTORY.CO</p>
        <p>Terima kasih atas dedikasi dan kontribusi Anda.</p>
    </div>
</body>

</html>