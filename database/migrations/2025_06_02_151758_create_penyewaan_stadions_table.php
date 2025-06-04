<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        // database/migrations/xxxx_xx_xx_create_penyewaan_stadions_table.php
    public function up()
    {
        Schema::create('penyewaan_stadions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('stadion_id')->constrained('stadion')->onDelete('cascade');
            $table->date('tanggal_sewa');
            $table->integer('durasi');
            $table->text('catatan_tambahan')->nullable();
            $table->string('bukti_pembayaran')->nullable();
            $table->enum('status', ['Menunggu', 'Diterima', 'Ditolak', 'Selesai'])->default('Menunggu');
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
