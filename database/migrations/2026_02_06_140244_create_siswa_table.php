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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id('id_siswa'); // ← Ganti jadi ini (otomatis auto increment)
            $table->string('email', 100)->unique();
            $table->string('nama_lengkap', 100);
            $table->string('kelas', 100);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('password', 255);
            $table->timestamps(); // ← Ganti jadi ini (lebih simple)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
