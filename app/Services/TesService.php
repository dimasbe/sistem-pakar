<?php

namespace App\Services;

use App\Models\Tes;
use App\Models\DetailTes;
use App\Models\Karir;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TesService
{
    public function simpanTes(int $id_siswa, array $jawaban): Tes
    {
        return DB::transaction(function () use ($id_siswa, $jawaban) {

            // 1. Buat record tes baru
            $tes = Tes::create([
                'id_siswa'    => $id_siswa,
                'tanggal_tes' => now(),
            ]);

            // Mapping untuk menyimpan angka pilihan (1-5) ke kolom 'jawaban'
            $reverseMapping = [
                '0.00' => 1, // Tidak Sesuai
                '0.25' => 2, // Kurang Sesuai
                '0.50' => 3, // Cukup Sesuai
                '0.75' => 4, // Sesuai
                '1.00' => 5, // Sangat Sesuai
            ];

            // Simpan setiap jawaban ke tabel detail_tes
            foreach ($jawaban as $id_pertanyaan => $nilaiCfUser) {
                $key = number_format((float)$nilaiCfUser, 2);
                $jawabanId = $reverseMapping[$key] ?? 3;

                DetailTes::create([
                    'id_tes'        => $tes->id_tes,
                    'id_pertanyaan' => $id_pertanyaan,
                    'jawaban'       => $jawabanId,
                    'nilai_cf_user' => (float)$nilaiCfUser,
                ]);
            }

            // CEK APAKAH JAWABAN SERAGAM (SEMUA SAMA)
            $nilaiUnik = array_unique(array_values($jawaban));
            $isUniform = (count($nilaiUnik) === 1);

            if ($isUniform) {
                // Update tes dengan status tidak teranalisis
                $tes->update([
                    'id_kepribadian' => null,
                    'nilai_cf_total' => 0,
                    'id_karir'       => null,
                ]);

                Log::info('Tes siswa #' . $id_siswa . ' ditolak karena jawaban seragam (semua sama)');

                return $tes;
            }

            // PROSES NORMAL (Jawaban bervariasi)
            $hasilSemuaKepribadian = $this->hitungHasilKepribadian($tes->id_tes);
            $dominan = $hasilSemuaKepribadian->first();

            $karir = $dominan ? Karir::where('id_kepribadian', $dominan->id_kepribadian)->first() : null;

            $tes->update([
                'id_kepribadian' => $dominan ? $dominan->id_kepribadian : null,
                'nilai_cf_total' => $dominan ? $dominan->cf_total : 0,
                'id_karir'       => $karir ? $karir->id_karir : null,
            ]);

            return $tes;
        });
    }

    public function hitungHasilKepribadian(int $id_tes)
    {
        $dataAturan = DB::table('detail_tes')
            ->join('basis_aturan', 'detail_tes.id_pertanyaan', '=', 'basis_aturan.id_pertanyaan')
            ->join('kepribadian', 'basis_aturan.id_kepribadian', '=', 'kepribadian.id_kepribadian')
            ->where('detail_tes.id_tes', $id_tes)
            ->select(
                'kepribadian.id_kepribadian',
                'kepribadian.nama_kepribadian',
                'kepribadian.kode_kepribadian',
                'kepribadian.deskripsi',
                'basis_aturan.cf_pakar',
                'detail_tes.nilai_cf_user'
            )
            ->get()
            ->groupBy('id_kepribadian');

        $hasilAkhir = collect();

        foreach ($dataAturan as $id_kepribadian => $items) {
            $cf_total = 0;

            foreach ($items as $index => $item) {
                $cf_gejala = $item->cf_pakar * $item->nilai_cf_user;

                if ($index === 0) {
                    $cf_total = $cf_gejala;
                } else {
                    $cf_total = $cf_total + ($cf_gejala * (1 - $cf_total));
                }
            }

            $hasilAkhir->push((object) [
                'id_kepribadian'   => $id_kepribadian,
                'nama_kepribadian' => $items->first()->nama_kepribadian,
                'kode_kepribadian' => $items->first()->kode_kepribadian,
                'deskripsi'        => $items->first()->deskripsi,
                'cf_total'         => $cf_total
            ]);
        }

        $urutanRiasec = ['R', 'I', 'A', 'S', 'E', 'C'];

        return $hasilAkhir->sortBy([
            ['cf_total', 'desc'],
            function ($item) use ($urutanRiasec) {
                return array_search($item->kode_kepribadian, $urutanRiasec);
            }
        ])->values();
    }

    public function getKepribadianDominan(int $id_tes)
    {
        return $this->hitungHasilKepribadian($id_tes)->first();
    }

    public function getRekomendasiKarir(int $id_tes)
    {
        $top3 = $this->hitungHasilKepribadian($id_tes)->take(3);
        if ($top3->isEmpty()) return collect();

        $ids = $top3->pluck('id_kepribadian')->toArray();

        return Karir::with('kepribadian')
            ->whereIn('id_kepribadian', $ids)
            ->get()
            ->groupBy('id_kepribadian');
    }

    public function hitungCFUser($value): float
    {
        return (float) $value;
    }
}
