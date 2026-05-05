<?php

namespace Database\Factories;

use App\Models\Kepribadian;
use Illuminate\Database\Eloquent\Factories\Factory;

class KepribadianFactory extends Factory
{
    protected $model = Kepribadian::class;

    public function definition(): array
    {
        $kode = $this->faker->unique()->randomElement(['R', 'I', 'A', 'S', 'E', 'C']);

        $nama = [
            'R' => 'Realistic',
            'I' => 'Investigative',
            'A' => 'Artistic',
            'S' => 'Social',
            'E' => 'Enterprising',
            'C' => 'Conventional',
        ];

        return [
            'kode_kepribadian' => $kode,
            'nama_kepribadian' => $nama[$kode],
            'deskripsi'        => $this->faker->sentence(10),
        ];
    }
}
