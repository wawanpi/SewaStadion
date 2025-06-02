<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StadionController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Resource routes stadion (kecuali show)
    Route::resource('stadion', StadionController::class)->except(['show']);

    // Route update status dengan parameter status dinamis
    Route::patch('stadion/{stadion}/status/{status}', [StadionController::class, 'updateStatus'])->name('stadion.updateStatus');

    // Route user index
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
});
require __DIR__.'/auth.php';    