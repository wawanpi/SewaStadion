<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement("ALTER TABLE harga_sewa MODIFY kondisi ENUM('pagi-siang', 'siang-sore', 'full-day') NOT NULL");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE harga_sewa MODIFY kondisi ENUM('pagi', 'siang', 'full') NOT NULL");
    }
};

