<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PertanyaanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['teks_pertanyaan' => 'Saya suka bekerja dengan mesin'],
            ['teks_pertanyaan' => 'Saya suka membangun sesuatu'],
            ['teks_pertanyaan' => 'Saya suka merawat binatang'],
            ['teks_pertanyaan' => 'Saya menikmati menyusun atau memasang sesuatu'],
            ['teks_pertanyaan' => 'Saya suka bekerja dengan koordinasi dan kekuatan fisik'],
            ['teks_pertanyaan' => 'Saya menyukai pekerjaan yang praktis'],
            ['teks_pertanyaan' => 'Saya senang bekerja di luar ruangan'],
            ['teks_pertanyaan' => 'Saya suka puzzle'],
            ['teks_pertanyaan' => 'Saya senang melakukan percobaan'],
            ['teks_pertanyaan' => 'Saya menikmati ilmu sains atau alam'],
            ['teks_pertanyaan' => 'Saya suka mencari tahu cara kerja suatu benda'],
            ['teks_pertanyaan' => 'Saya menikmati kegiatan menganalisa masalah'],
            ['teks_pertanyaan' => 'Saya senang bekerja dengan angka atau grafik'],
            ['teks_pertanyaan' => 'Kemampuan matematika saya bagus'],
            ['teks_pertanyaan' => 'Saya prima saat bekerja sendirian'],
            ['teks_pertanyaan' => 'Saya suka membaca tentang seni dan musik'],
            ['teks_pertanyaan' => 'Saya menikmati puisi atau cerita'],
            ['teks_pertanyaan' => 'Saya senang menonton konser pertunjukan seni'],
            ['teks_pertanyaan' => 'Saya senang bermain alat musik dan bernyanyi'],
            ['teks_pertanyaan' => 'Saya senang berakting dalam drama'],
            ['teks_pertanyaan' => 'Saya senang menggambar'],
            ['teks_pertanyaan' => 'Saya suka bekerja dalam tim'],
            ['teks_pertanyaan' => 'Saya senang melatih orang atau mengajar orang'],
            ['teks_pertanyaan' => 'Saya suka membantu orang menyelesaikan masalah'],
            ['teks_pertanyaan' => 'Saya tertarik untuk menyembuhkan orang sakit'],
            ['teks_pertanyaan' => 'Saya menikmati belajar kebudayaan yang berbeda'],
            ['teks_pertanyaan' => 'Saya ingin terlibat dalam diskusi suatu topik'],
            ['teks_pertanyaan' => 'Saya suka membantu lansia dan bermain dengan anak'],
            ['teks_pertanyaan' => 'Saya tegas dan senang mendapat penugasan'],
            ['teks_pertanyaan' => 'Saya senang mencoba mengajak orang'],
            ['teks_pertanyaan' => 'Saya suka menjual produk'],
            ['teks_pertanyaan' => 'Saya berani mengambil risiko'],
            ['teks_pertanyaan' => 'Saya ingin memulai bisnis saya sendiri'],
            ['teks_pertanyaan' => 'Saya suka memimpin'],
            ['teks_pertanyaan' => 'Saya menikmati berpidato'],
            ['teks_pertanyaan' => 'Saya suka mengatur barang-barang'],
            ['teks_pertanyaan' => 'Saya senang untuk berhati-hati, akurat dan tepat'],
            ['teks_pertanyaan' => 'Saya tidak keberatan kerja tugas 8 jam di dalam ruang'],
            ['teks_pertanyaan' => 'Saya memperhatikan detail'],
            ['teks_pertanyaan' => 'Saya menyukai membuat file atau mengetik'],
            ['teks_pertanyaan' => 'Saya membuat rencana dengan cermat'],
            ['teks_pertanyaan' => 'Saya ingin bekerja di dalam ruangan'],
        ];

        foreach ($data as $item) {
            DB::table('pertanyaan')->insert([
                'teks_pertanyaan' => $item['teks_pertanyaan'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
