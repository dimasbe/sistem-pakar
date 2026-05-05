<?php

namespace Database\Factories;

use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition(): array
    {
        return [
            'email'         => $this->faker->unique()->safeEmail(),
            'nama_lengkap'  => $this->faker->name(),
            'kelas'         => $this->faker->randomElement(['X', 'XI', 'XII']) . ' ' . $this->faker->randomElement(['IPA', 'IPS']) . ' ' . $this->faker->numberBetween(1, 5),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'password'      => Hash::make('password'),
        ];
    }
}
