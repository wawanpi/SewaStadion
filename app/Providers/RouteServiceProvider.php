@extends('penyewaan-stadion.Admin.Adminindex') {{-- Extend file admin index Anda --}}

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Penyewaan</h1>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">ID Penyewaan: {{ $penyewaan->id }}</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <p><strong>Nama Stadion:</strong> {{ $penyewaan->stadion->nama }}</p>
                    <p><strong>Nama Penyewa:</strong> {{ $penyewaan->user->name }}</p>
                    <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d F Y H:i') }}</p>
                </div>
                <div class="col-md-6">
                    <p><strong>Status:</strong> 
                        <span class="badge 
                            @if($penyewaan->status == 'Diterima') badge-success
                            @elseif($penyewaan->status == 'Ditolak') badge-danger
                            @elseif($penyewaan->status == 'Menunggu') badge-warning
                            @else badge-info
                            @endif">
                            {{ $penyewaan->status }}
                        </span>
                    </p>
                    <p><strong>Total Harga:</strong> Rp {{ number_format($penyewaan->harga, 0, ',', '.') }}</p>
                    <p><strong>Durasi:</strong> {{ $penyewaan->durasi_hari }} hari ({{ $penyewaan->durasi_jam }} jam)</p>
                </div>
            </div>

            @if($penyewaan->catatan_tambahan)
                <div class="mt-4">
                    <h5>Catatan Tambahan</h5>
                    <p>{{ $penyewaan->catatan_tambahan }}</p>
                </div>
            @endif

            @if($penyewaan->bukti_pembayaran)
                <div class="mt-4">
                    <h5>Bukti Pembayaran</h5>
                    <img src="{{ asset('storage/'.$penyewaan->bukti_pembayaran) }}" 
                         class="img-fluid rounded" style="max-height: 300px;">
                </div>
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('admin.penyewaan.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection