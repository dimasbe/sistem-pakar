<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KepribadianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'kode_kepribadian' => 'R',
                'nama_kepribadian' => 'Realistic',
                'deskripsi' => 'Menyukai pekerjaan yang bersifat praktis dan fisik, seperti membuat, merakit, serta memperbaiki sesuatu dengan menggunakan alat atau mesin, terutama di lingkungan kerja lapangan.',
            ],
            [
                'kode_kepribadian' => 'I',
                'nama_kepribadian' => 'Investigative',
                'deskripsi' => 'Menyukai pekerjaan yang menuntut kemampuan analitis dan ilmiah, seperti meneliti, mengamati, bereksperimen, serta memecahkan masalah secara logis dan sistematis.',
            ],
            [
                'kode_kepribadian' => 'A',
                'nama_kepribadian' => 'Artistic',
                'deskripsi' => 'Menyukai pekerjaan yang bersifat kreatif dan ekspresif, seperti berkarya melalui seni, musik, tulisan, atau desain dalam lingkungan yang fleksibel.',
            ],
            [
                'kode_kepribadian' => 'S',
                'nama_kepribadian' => 'Social',
                'deskripsi' => 'Menyukai pekerjaan yang melibatkan interaksi sosial, seperti mengajar, melatih, membantu, merawat, dan memberikan pelayanan kepada orang lain.',
            ],
            [
                'kode_kepribadian' => 'E',
                'nama_kepribadian' => 'Enterprising',
                'deskripsi' => 'Menyukai pekerjaan yang berkaitan dengan kepemimpinan, persuasi, dan kegiatan bisnis, serta melibatkan pengaruh dan pengambilan keputusan.',
            ],
            [
                'kode_kepribadian' => 'C',
                'nama_kepribadian' => 'Conventional',
                'deskripsi' => 'Menyukai pekerjaan yang terstruktur dan terorganisir, terutama yang berkaitan dengan administrasi, pengolahan data, angka, dan ketelitian.',
            ],
        ];

        foreach ($data as $item) {
            DB::table('kepribadian')->insert([
                'kode_kepribadian' => $item['kode_kepribadian'],
                'nama_kepribadian' => $item['nama_kepribadian'],
                'deskripsi'        => $item['deskripsi'],
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}
