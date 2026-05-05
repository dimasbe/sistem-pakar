<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tes', function (Blueprint $table) {
            $table->id('id_tes'); // PK id_tes INT

            // FK id_siswa INT
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id_siswa')->on('siswa')->onDelete('cascade');

            // tanggal_tes DATETIME
            $table->dateTime('tanggal_tes');

            // FK id_kepribadian INT (Hasil kepribadian dominan)
            $table->unsignedBigInteger('id_kepribadian')->nullable();
            $table->foreign('id_kepribadian')->references('id_kepribadian')->on('kepribadian');

            // nilai_cf_total DECIMAL(5,3)
            $table->decimal('nilai_cf_total', 5, 3)->nullable();

            // FK id_karir INT (Hasil rekomendasi karir utama)
            $table->unsignedBigInteger('id_karir')->nullable();
            $table->foreign('id_karir')->references('id_karir')->on('karir');

            $table->timestamps(); // created_at & updated_at TIMESTAMP
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tes');
    }
};
