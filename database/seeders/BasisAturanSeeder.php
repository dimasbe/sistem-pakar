<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BasisAturanSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('basis_aturan')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $aturan = [
            // Realistic (R) - 1-7
            ['id_pertanyaan' => 1, 'id_kepribadian' => 1, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 2, 'id_kepribadian' => 1, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 3, 'id_kepribadian' => 1, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 4, 'id_kepribadian' => 1, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 5, 'id_kepribadian' => 1, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 6, 'id_kepribadian' => 1, 'cf_pakar' => 0.4],
            ['id_pertanyaan' => 7, 'id_kepribadian' => 1, 'cf_pakar' => 0.4],

            // Investigative (I) - 8-14
            ['id_pertanyaan' => 8,  'id_kepribadian' => 2, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 9,  'id_kepribadian' => 2, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 10, 'id_kepribadian' => 2, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 11, 'id_kepribadian' => 2, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 12, 'id_kepribadian' => 2, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 13, 'id_kepribadian' => 2, 'cf_pakar' => 0.4],
            ['id_pertanyaan' => 14, 'id_kepribadian' => 2, 'cf_pakar' => 0.4],

            // Artistic (A) - 15-21
            ['id_pertanyaan' => 15, 'id_kepribadian' => 3, 'cf_pakar' => 0.4],
            ['id_pertanyaan' => 16, 'id_kepribadian' => 3, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 17, 'id_kepribadian' => 3, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 18, 'id_kepribadian' => 3, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 19, 'id_kepribadian' => 3, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 20, 'id_kepribadian' => 3, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 21, 'id_kepribadian' => 3, 'cf_pakar' => 0.4],

            // Social (S) - 22-28
            ['id_pertanyaan' => 22, 'id_kepribadian' => 4, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 23, 'id_kepribadian' => 4, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 24, 'id_kepribadian' => 4, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 25, 'id_kepribadian' => 4, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 26, 'id_kepribadian' => 4, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 27, 'id_kepribadian' => 4, 'cf_pakar' => 0.4],
            ['id_pertanyaan' => 28, 'id_kepribadian' => 4, 'cf_pakar' => 0.4],

            // Enterprising (E) - 29-35
            ['id_pertanyaan' => 29, 'id_kepribadian' => 5, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 30, 'id_kepribadian' => 5, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 31, 'id_kepribadian' => 5, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 32, 'id_kepribadian' => 5, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 33, 'id_kepribadian' => 5, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 34, 'id_kepribadian' => 5, 'cf_pakar' => 0.4],
            ['id_pertanyaan' => 35, 'id_kepribadian' => 5, 'cf_pakar' => 0.4],

            // Conventional (C) - 36-42
            ['id_pertanyaan' => 36, 'id_kepribadian' => 6, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 37, 'id_kepribadian' => 6, 'cf_pakar' => 0.8],
            ['id_pertanyaan' => 38, 'id_kepribadian' => 6, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 39, 'id_kepribadian' => 6, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 40, 'id_kepribadian' => 6, 'cf_pakar' => 0.6],
            ['id_pertanyaan' => 41, 'id_kepribadian' => 6, 'cf_pakar' => 0.4],
            ['id_pertanyaan' => 42, 'id_kepribadian' => 6, 'cf_pakar' => 0.4],
        ];

        foreach ($aturan as $item) {
            DB::table('basis_aturan')->insert([
                'id_pertanyaan'  => $item['id_pertanyaan'],
                'id_kepribadian' => $item['id_kepribadian'],
                'cf_pakar'       => $item['cf_pakar'],
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
        }
    }
}
