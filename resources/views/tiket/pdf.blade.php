<!-- resources/views/tiket/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tiket Penyewaan</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        .header { text-align: center; margin-bottom: 20px; }
        .content { border: 1px solid #000; padding: 20px; }
        .row { margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Tiket Penyewaan Stadion</h2>
    </div>
    <div class="content">
        <div class="row"><strong>Nama Penyewa:</strong> {{ $penyewaan->user->name }}</div>
        <div class="row"><strong>Stadion:</strong> {{ $penyewaan->stadion->nama }}</div>
        <div class="row"><strong>Tanggal Sewa:</strong> {{ $penyewaan->tanggal_sewa }}</div>
        <div class="row"><strong>Durasi:</strong> {{ $penyewaan->durasi }} jam</div>
        <div class="row"><strong>Status:</strong> {{ ucfirst($penyewaan->status) }}</div>
        <div class="row"><strong>Catatan:</strong> {{ $penyewaan->catatan ?? '-' }}</div>
    </div>
</body>
</html>
