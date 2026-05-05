<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Tes;
use App\Models\Kepribadian;
use App\Models\Pertanyaan;
use App\Models\Karir;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function adminDashboard()
    {
        // Statistik untuk admin
        $totalSiswa = Siswa::count();
        $totalTes = Tes::count();
        $totalKepribadian = Kepribadian::count();
        $totalPertanyaan = Pertanyaan::count();
        $totalKarir = Karir::count();

        // Siswa yang sudah mengerjakan tes
        $siswaTesTaken = Siswa::has('tes')->count();

        // Siswa yang belum mengerjakan tes
        $siswaBelumTes = $totalSiswa - $siswaTesTaken;

        // Tes terbaru (10 terakhir)
        $recentTests = Tes::with(['siswa'])
            ->latest()
            ->take(10)
            ->get();

        // Grafik: Distribusi kepribadian dari semua tes
        $kepribadianStats = DB::table('tes')
            ->whereNotNull('tes.id_kepribadian')
            ->join('kepribadian', 'tes.id_kepribadian', '=', 'kepribadian.id_kepribadian')
            ->select('kepribadian.nama_kepribadian', DB::raw('count(tes.id_tes) as total'))
            ->groupBy('kepribadian.id_kepribadian', 'kepribadian.nama_kepribadian')
            ->get();

        return view('admin.dashboard', compact(
            'totalSiswa',
            'totalTes',
            'totalKepribadian',
            'totalPertanyaan',
            'totalKarir',
            'siswaTesTaken',
            'siswaBelumTes',
            'recentTests',
            'kepribadianStats'
        ));
    }

    /**
     * Siswa Dashboard
     */
    public function siswaDashboard()
    {
        $siswa = Auth::guard('siswa')->user();

        // 1. Hitung total tes
        $totalTes = Tes::where('id_siswa', $siswa->id_siswa)->count();

        // 2. Ambil data tes terakhir beserta relasi kepribadiannya
        // Kita asumsikan tabel 'tes' punya kolom 'id_kepribadian' dan 'nilai_cf_total'
        $lastResult = Tes::where('id_siswa', $siswa->id_siswa)
            ->with(['kepribadian'])
            ->latest()
            ->first();

        // 3. Riwayat tes (5 terakhir)
        $tesHistory = Tes::where('id_siswa', $siswa->id_siswa)
            ->with(['kepribadian'])
            ->latest()
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact(
            'siswa',
            'totalTes',
            'lastResult',
            'tesHistory'
        ));
    }
}
