<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tes', function (Blueprint $table) {
            // Kita ubah ke (10, 8) agar bisa menyimpan hingga 0.99999999
            $table->decimal('nilai_cf_total', 10, 8)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('tes', function (Blueprint $table) {
            // Kembalikan ke format awal jika diperlukan rollback
            $table->decimal('nilai_cf_total', 5, 3)->nullable()->change();
        });
    }
};
