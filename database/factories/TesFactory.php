<?php

namespace Database\Factories;

use App\Models\Tes;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

class TesFactory extends Factory
{
    protected $model = Tes::class;

    public function definition(): array
    {
        return [
            'id_siswa'       => Siswa::factory(),
            'tanggal_tes'    => now(),
            'id_kepribadian' => null,
            'nilai_cf_total' => 0,
            'id_karir'       => null,
        ];
    }
}