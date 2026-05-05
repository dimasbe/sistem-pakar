<?php

namespace Database\Factories;

use App\Models\Karir;
use App\Models\Kepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class KarirFactory extends Factory
{
    protected $model = Karir::class;

    public function definition(): array
    {
        return [
            'id_kepribadian'  => Kepribadian::factory(),
            'nama_karir'      => $this->faker->jobTitle(),
            'deskripsi_karir' => $this->faker->sentence(12),
        ];
    }
}
