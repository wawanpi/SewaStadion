<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('stadion', function (Blueprint $table) {
            $table->dropColumn('is_done'); // hapus kolom lama
            $table->string('status')->default('menunggu'); // kolom status dengan default 'menunggu'
        });

    }

    public function down(): void
    {
        Schema::table('stadion', function (Blueprint $table) {
            $table->dropColumn('is_done');
        });
    }
};
