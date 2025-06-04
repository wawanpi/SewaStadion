<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stadion', function (Blueprint $table) {
            // Tambah kolom is_done dengan default false
            if (!Schema::hasColumn('stadion', 'is_done')) {
                $table->boolean('is_done')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('stadion', function (Blueprint $table) {
            if (Schema::hasColumn('stadion', 'is_done')) {
                $table->dropColumn('is_done');
            }
        });
    }
};
