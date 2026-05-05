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
        Schema::create('kepribadian', function (Blueprint $table) {
            $table->id('id_kepribadian'); // ← Ubah jadi id()
            $table->char('kode_kepribadian', 1)->unique();
            $table->string('nama_kepribadian', 100);
            $table->text('deskripsi');
            $table->timestamps(); // ← Lebih simple
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kepribadian');
    }
};
