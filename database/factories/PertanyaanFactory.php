<?php

namespace Database\Factories;

use App\Models\Pertanyaan;
use Illuminate\Database\Eloquent\Factories\Factory;

class PertanyaanFactory extends Factory
{
    protected $model = Pertanyaan::class;

    public function definition(): array
    {
        return [
            'teks_pertanyaan' => $this->faker->sentence(8) . '?',
        ];
    }
}
