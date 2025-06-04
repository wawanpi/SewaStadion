<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tiket Penyewaan Stadion</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .tiket {
            border: 2px solid #000;
            padding: 20px;
            width: 100%;
        }
        .judul {
            text-align: center;
            margin-bottom: 20px;
        }
        .info {
            margin-bottom: 20px;
        }
        .qr {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="tiket">
        <h2 class="judul">Tiket Penyewaan Stadion</h2>

        <div class="info">
            <p><strong>Nama Pemesan:</strong> {{ $booking->user->name }}</p>
            <p><strong>Nama Stadion:</strong> {{ $booking->stadion->nama }}</p>
            <p><strong>Tanggal Sewa:</strong> {{ \Carbon\Carbon::parse($booking->tanggal_sewa)->translatedFormat('l, d F Y') }}</p>
            <p><strong>Durasi:</strong> {{ $booking->durasi }} jam</p>
            <p><strong>Status:</strong> {{ $booking->status }}</p>
        </div>

        <div class="qr">
            <p><strong>Kode Tiket:</strong> {{ $booking->id }}</p>
            {!! QrCode::size(150)->generate('Tiket ID: ' . $booking->id . ' | ' . $booking->user->name . ' | ' . $booking->stadion->nama) !!}
        </div>
    </div>
</body>
</html>
