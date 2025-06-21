<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Ubah enum dengan raw SQL
        DB::statement("ALTER TABLE penyewaan_stadions MODIFY COLUMN kondisi ENUM('pagi-siang', 'siang-sore', 'full-day') NOT NULL");
    }

    public function down(): void
    {
        // Rollback ke enum sebelumnya (jika diperlukan)
        DB::statement("ALTER TABLE penyewaan_stadions MODIFY COLUMN kondisi ENUM('Pagi', 'Siang', 'Full') NOT NULL");
    }
};
