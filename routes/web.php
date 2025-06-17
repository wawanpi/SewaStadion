<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StadionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenyewaanStadionController;
use App\Http\Controllers\HargaSewaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiketController; 

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [StadionController::class, 'showDashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// Route untuk user yang sudah login dengan prefix 'dashboard'
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Penyewaan stadion routes (user biasa)
    Route::get('/penyewaan-stadion/create', [PenyewaanStadionController::class, 'create'])->name('penyewaan-stadion.create');
    Route::post('/penyewaan-stadion', [PenyewaanStadionController::class, 'store'])->name('penyewaan_stadion.store');
    Route::get('/penyewaan-stadion/my-bookings', [PenyewaanStadionController::class, 'myBookings'])->name('penyewaan-stadion.my');
    Route::delete('/penyewaan-stadion/{penyewaan}', [PenyewaanStadionController::class, 'destroy'])->name('penyewaan-stadion.destroy');
    Route::get('/penyewaan-stadion/lihat-jadwal', [PenyewaanStadionController::class, 'lihatJadwal'])->name('penyewaan_stadion.lihat_jadwal');
    Route::get('/penyewaan-stadion/pembayaran', [PenyewaanStadionController::class, 'showPembayaran'])->name('penyewaan.pembayaran');
    Route::post('/penyewaan/{booking}/upload-bukti', [PenyewaanStadionController::class, 'uploadBuktiPembayaran'])->name('penyewaan.uploadBukti');
    Route::get('/api/ketersediaan', [PenyewaanStadionController::class, 'getKetersediaan'])->name('ketersediaan');



    // **Tambahan route AJAX untuk hitung harga sewa**
    // routes/web.php
    Route::post('/penyewaan-stadion/hitung-harga', [PenyewaanStadionController::class, 'hitungHargaTotal'])->name('penyewaan-stadion.hitung-harga');
    //Iket
    Route::get('/tiket/{id}/pdf', [TiketController::class, 'downloadTiket'])->name('tiket.download');
    //Pembayaran
    Route::get('/penyewaan-stadion/pembayaran', [PenyewaanStadionController::class, 'showPembayaran'])
    ->name('penyewaan.pembayaran');


});

// Route khusus admin (harus login dan admin)
Route::middleware(['auth', 'admin'])->prefix('dashboard')->group(function () {
    // Stadion routes (resource, tanpa show)
    Route::resource('stadion', StadionController::class)->except(['show']);
    Route::patch('stadion/{stadion}/status/{status}', [StadionController::class, 'updateStatus'])->name('stadion.updateStatus');

    // Harga Sewa (CRUD)
    Route::resource('harga-sewa', HargaSewaController::class)->except(['show']);

    // User management
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    // Admin routes for approving/rejecting booking
    Route::get('/admin/penyewaan-stadion', [PenyewaanStadionController::class, 'adminIndex'])->name('admin.penyewaan.index');
    Route::patch('/admin/penyewaan-stadion/{booking}/approve', [PenyewaanStadionController::class, 'approve'])->name('admin.penyewaan.approve');
    Route::patch('/admin/penyewaan-stadion/{booking}/reject', [PenyewaanStadionController::class, 'reject'])->name('admin.penyewaan.reject');

    // Penyewaan stadion management
    Route::get('/daftar-penyewaan-stadion', [PenyewaanStadionController::class, 'index'])->name('penyewaan-stadion.index');
    Route::patch('/penyewaan-stadion/{booking}/finish', [PenyewaanStadionController::class, 'finish'])->name('penyewaan_stadion.finish');
});
    // routes/web.php (sudah kamu punya)
    Route::get('/tiket/{id}/pdf', [TiketController::class, 'downloadTiket'])->name('tiket.download');
require __DIR__.'/auth.php';
