<?php

namespace Database\Factories;

use App\Models\DetailTes;
use App\Models\Tes;
use App\Models\Pertanyaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailTesFactory extends Factory
{
    protected $model = DetailTes::class;

    public function definition(): array
    {
        $nilaiCfUser = $this->faker->randomElement([0.00, 0.25, 0.50, 0.75, 1.00]);
        $mapping = [
            '0.00' => 1,
            '0.25' => 2,
            '0.50' => 3,
            '0.75' => 4,
            '1.00' => 5,
        ];

        return [
            'id_tes'         => Tes::factory(),
            'id_pertanyaan'  => Pertanyaan::factory(),
            'jawaban'        => $mapping[number_format($nilaiCfUser, 2)],
            'nilai_cf_user'  => $nilaiCfUser,
        ];
    }
}