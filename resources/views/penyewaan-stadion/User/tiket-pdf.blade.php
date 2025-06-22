<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Tiket Penyewaan Stadion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 12px;
        }
        .ticket {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            border: 2px solid #3a7bd5;
            border-radius: 8px;
            padding: 15px;
            box-sizing: border-box;
        }
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px dashed #3a7bd5;
        }
        .header h1 {
            color: #3a7bd5;
            margin: 0;
            font-size: 18px;
        }
        .header p {
            color: #666;
            margin: 5px 0 0;
            font-size: 12px;
        }
        .info-section {
            margin-bottom: 15px;
        }
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            width: 120px;
            color: #555;
        }
        .info-value {
            flex: 1;
        }
        .qr-section {
            text-align: center;
            margin: 15px 0;
            padding: 10px;
            background: #f5f9ff;
            border-radius: 5px;
        }
        .footer {
            text-align: center;
            font-size: 10px;
            color: #888;
            margin-top: 15px;
            padding-top: 5px;
            border-top: 1px dashed #3a7bd5;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <div class="header">
            <h1>TIKET PENYEWAAN STADION</h1>
            <p>Nomor Tiket: {{ $booking->id }}</p>
        </div>

        <div class="info-section">
            <div class="info-row">
                <div class="info-label">Nama Pemesan:</div>
                <div class="info-value">{{ $booking->user->name }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Stadion:</div>
                <div class="info-value">{{ $booking->stadion->nama }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Mulai:</div>
                <div class="info-value">{{ Carbon\Carbon::parse($booking->tanggal_mulai)->translatedFormat('l, d F Y H:i') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal Selesai:</div>
                <div class="info-value">{{ Carbon\Carbon::parse($booking->waktu_selesai)->translatedFormat('l, d F Y H:i') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Durasi:</div>
                <div class="info-value">{{ $booking->durasi_hari }} hari ({{ $booking->durasi_jam }} jam)</div>
            </div>
            <div class="info-row">
                <div class="info-label">Total Harga:</div>
                <div class="info-value">Rp {{ number_format($booking->harga, 0, ',', '.') }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Status:</div>
                <div class="info-value" style="color: {{ $booking->status == 'Diterima' ? 'green' : 'blue' }}">
                    {{ $booking->status }}
                </div>
            </div>
        </div>

        <div class="qr-section">
            <p><strong>Scan QR Code untuk validasi tiket</strong></p>
            {!! $qrCode !!}
            <p style="margin-top: 5px;">Kode Tiket: {{ $booking->id }}</p>
        </div>

        <div class="footer">
            <p>Harap tunjukkan tiket ini saat check-in di lokasi</p>
            <p>&copy; {{ date('Y') }} AYO Sewa Stadion</p>
        </div>
    </div>
</body>
</html>