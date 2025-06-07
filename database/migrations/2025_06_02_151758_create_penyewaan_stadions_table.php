<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('penyewaan_stadions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('stadion_id')->constrained('stadion')->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->integer('durasi'); // misal 1, 2, 3
            $table->enum('kondisi', ['Pagi', 'Siang', 'Full']); // pilihan kondisi sewa
            $table->integer('harga');
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak', 'Selesai'])->default('Menunggu');
            $table->text('catatan_tambahan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('penyewaan_stadions');
    }
};
