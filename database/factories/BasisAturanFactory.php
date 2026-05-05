<?php

namespace Database\Factories;

use App\Models\BasisAturan;
use App\Models\Kepribadian;
use App\Models\Pertanyaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class BasisAturanFactory extends Factory
{
    protected $model = BasisAturan::class;

    public function definition(): array
    {
        return [
            'id_pertanyaan'  => Pertanyaan::factory(),
            'id_kepribadian' => Kepribadian::factory(),
            'cf_pakar'       => $this->faker->randomFloat(2, 0.1, 1.0),
        ];
    }
}