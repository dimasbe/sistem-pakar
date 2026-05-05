<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karir', function (Blueprint $table) {
            $table->id('id_karir'); // ← Ubah jadi id()
            $table->unsignedBigInteger('id_kepribadian'); // ← Ubah jadi unsignedBigInteger
            $table->string('nama_karir', 100);
            $table->text('deskripsi_karir');
            $table->timestamps();

            // Foreign key
            $table->foreign('id_kepribadian')
                ->references('id_kepribadian')
                ->on('kepribadian')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('karir');
    }
};
