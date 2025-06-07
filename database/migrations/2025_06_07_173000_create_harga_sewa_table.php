<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('harga_sewa', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stadion_id')->constrained('stadion')->onDelete('cascade');
            $table->enum('kondisi', ['pagi', 'siang', 'full']);
            $table->integer('harga'); // misal: 150000
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('harga_sewa');
    }
};
