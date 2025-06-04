<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StadionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PenyewaanStadionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Stadion routes (resource, tanpa show)
    Route::resource('stadion', StadionController::class)->except(['show']);
    Route::patch('stadion/{stadion}/status/{status}', [StadionController::class, 'updateStatus'])->name('stadion.updateStatus');

    // User management
    Route::get('/user', [UserController::class, 'index'])->name('user.index');

    // Penyewaan stadion routes
    Route::get('/penyewaan-stadion', [PenyewaanStadionController::class, 'index'])->name('penyewaan-stadion.index');
    Route::get('/penyewaan-stadion/create', [PenyewaanStadionController::class, 'create'])->name('penyewaan-stadion.create');
    Route::post('/penyewaan-stadion', [PenyewaanStadionController::class, 'store'])->name('penyewaan-stadion.store');
    Route::get('/penyewaan-stadion/my-bookings', [PenyewaanStadionController::class, 'myBookings'])->name('penyewaan-stadion.my');
    Route::delete('/penyewaan-stadion/{penyewaan}', [PenyewaanStadionController::class, 'destroy'])->name('penyewaan-stadion.destroy');

    // Admin routes for approving/rejecting booking
    Route::get('/admin/penyewaan-stadion', [PenyewaanStadionController::class, 'adminIndex'])->name('admin.penyewaan.index');
    Route::patch('/admin/penyewaan-stadion/{booking}/approve', [PenyewaanStadionController::class, 'approve'])->name('admin.penyewaan.approve');
    Route::patch('/admin/penyewaan-stadion/{booking}/reject', [PenyewaanStadionController::class, 'reject'])->name('admin.penyewaan.reject');
});

require __DIR__.'/auth.php';
