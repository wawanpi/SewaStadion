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
        Schema::table('harga_sewa', function (Blueprint $table) {
            // Ubah kolom 'kondisi' untuk menambahkan 'malam' ke dalam pilihan ENUM.
            $table->enum('kondisi', ['pagi-siang', 'siang-sore', 'full-day', 'malam'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('harga_sewa', function (Blueprint $table) {
            // Jika di-rollback, kembalikan ke kondisi semula (tanpa 'malam').
            $table->enum('kondisi', ['pagi-siang', 'siang-sore', 'full-day'])->change();
        });
    }
};