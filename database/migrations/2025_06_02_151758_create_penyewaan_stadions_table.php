<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penyewaan_stadions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('stadion_id')->constrained('stadion')->onDelete('cascade');
            
            // Kolom yang sudah disesuaikan dengan Controller
            $table->dateTime('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->dateTime('waktu_selesai');
            $table->integer('durasi_hari');
            $table->integer('durasi_jam');
            $table->integer('slot_waktu');
            $table->string('kondisi');
            $table->integer('harga');
            $table->string('bukti_pembayaran')->nullable();
            $table->string('verifikasi');
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak', 'Selesai'])->default('Menunggu');
            $table->text('catatan_tambahan')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaan_stadions');
    }
};