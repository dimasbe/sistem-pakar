<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_tes', function (Blueprint $table) {
            $table->id('id_detail_tes');
            $table->unsignedBigInteger('id_tes');
            $table->unsignedBigInteger('id_pertanyaan');
            $table->integer('jawaban');
            $table->decimal('nilai_cf_user', 4, 2);
            $table->timestamps();
            $table->foreign('id_tes')
                ->references('id_tes')
                ->on('tes')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('id_pertanyaan')
                ->references('id_pertanyaan')
                ->on('pertanyaan')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_tes');
    }
};
