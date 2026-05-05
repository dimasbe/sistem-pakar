<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            KepribadianSeeder::class,
            PertanyaanSeeder::class,
            KarirSeeder::class,
            BasisAturanSeeder::class,
        ]);
    }
}
