@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Penyewaan</h1>
        <a href="{{ route('admin.penyewaan.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm"></i> Kembali ke Daftar
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">
                ID Penyewaan: #{{ $penyewaan->id }}
            </h6>
            <span class="badge badge-{{ 
                $penyewaan->status == 'Diterima' ? 'success' : 
                ($penyewaan->status == 'Ditolak' ? 'danger' : 
                ($penyewaan->status == 'Selesai' ? 'info' : 'warning')) 
            }}">
                {{ $penyewaan->status }}
            </span>
        </div>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%">ID Penyewaan</th>
                            <td>{{ $penyewaan->id }}</td>
                        </tr>
                        <tr>
                            <th>ID Penyewa</th>
                            <td>{{ $penyewaan->user_id }}</td>
                        </tr>
                        <tr>
                            <th>ID Stadion</th>
                            <td>{{ $penyewaan->stadion_id }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Mulai</th>
                            <td>{{ $penyewaan->tanggal_mulai }}</td>
                        </tr>
                        <tr>
                            <th>Slot Waktu</th>
                            <td>{{ $penyewaan->slot_waktu }}</td>
                        </tr>
                        <tr>
                            <th>Waktu Selesai</th>
                            <td>{{ $penyewaan->waktu_selesai }}</td>
                        </tr>
                        <tr>
                            <th>Durasi (Hari)</th>
                            <td>{{ $penyewaan->durasi_hari }}</td>
                        </tr>
                        <tr>
                            <th>Durasi (Jam)</th>
                            <td>{{ $penyewaan->durasi_jam }}</td>
                        </tr>
                        <tr>
                            <th>Kondisi</th>
                            <td>{{ $penyewaan->kondisi }}</td>
                        </tr>
                        <tr>
                            <th>Harga</th>
                            <td>Rp {{ number_format($penyewaan->harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $penyewaan->status }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Tombol Aksi -->
            <div class="mt-4 d-flex justify-content-end">
                @if($penyewaan->status == 'Menunggu')
                <form action="{{ route('admin.penyewaan.reject', $penyewaan->id) }}" method="POST" class="mr-2">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </form>
                <form action="{{ route('admin.penyewaan.approve', $penyewaan->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check"></i> Setujui
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection