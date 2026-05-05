<?php

namespace App\Http\Controllers;

use App\Models\Tes;
use App\Models\Pertanyaan;
use App\Services\TesService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TesController extends Controller
{
    protected TesService $tesService;

    public function __construct(TesService $tesService)
    {
        $this->tesService = $tesService;
    }

    public function adminIndex(Request $request)
    {
        $search = $request->input('search');
        $query = Tes::with(['siswa', 'kepribadian']);

        if ($search) {
            $query->whereHas('siswa', function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%');
            });
        }

        $tes = $query->latest()->paginate(10);
        $hasilKombinasi = [];

        foreach ($tes as $item) {
            $hasilKombinasi[$item->id_tes] = $this->tesService->hitungHasilKepribadian($item->id_tes)->take(3);
        }

        return view('admin.tes.index', compact('tes', 'hasilKombinasi'));
    }

    public function adminShow($id)
    {
        try {
            $tes = Tes::with([
                'siswa',
                'kepribadian',
                'karir',
                'detailTes.pertanyaan.basisAturan'
            ])->findOrFail($id);

            $hasilKepribadian = $this->tesService->hitungHasilKepribadian($id);

            return view('admin.tes.show', compact('tes', 'hasilKepribadian'));
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function destroy($id)
    {
        try {
            $tes = Tes::findOrFail($id);
            $tes->delete();
            return redirect()->route('admin.tes.index')->with('success', 'Data hasil tes berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.tes.index')->with('error', 'Gagal menghapus data.');
        }
    }

    public function printAll()
    {
        $tesList = Tes::with(['siswa', 'kepribadian', 'karir'])->latest()->get();

        $hasilKombinasi = [];
        foreach ($tesList as $tes) {
            $top3 = $this->tesService->hitungHasilKepribadian($tes->id_tes)->take(3);
            $dominan = $top3->first();

            $hasilKombinasi[$tes->id_tes] = [
                'kode'         => $top3->pluck('kode_kepribadian')->implode('') ?: '-',
                'nama_dominan' => $dominan?->nama_kepribadian ?? 'N/A',
                'cf'           => $dominan?->cf_total ?? 0,
            ];
        }

        return view('admin.tes.print_all', compact('tesList', 'hasilKombinasi'));
    }

    /*
    |--------------------------------------------------------------------------
    | BAGIAN SISWA
    |--------------------------------------------------------------------------
    */

    public function myTests()
    {
        $siswa = Auth::guard('siswa')->user();
        $tes = Tes::where('id_siswa', $siswa->id_siswa)->with(['kepribadian'])->latest()->paginate(10);
        return view('siswa.tes.riwayat', compact('tes'));
    }

    public function intro()
    {
        $totalPertanyaan = Pertanyaan::count();
        return view('siswa.tes.intro', compact('totalPertanyaan'));
    }

    public function create()
    {
        if (!session()->has('urutan_soal')) {
            $ids = Pertanyaan::pluck('id_pertanyaan')->toArray();
            shuffle($ids);
            session(['urutan_soal' => $ids]);
        }

        $orderedIds = session('urutan_soal');

        $pertanyaan = Pertanyaan::whereIn('id_pertanyaan', $orderedIds)
            ->orderByRaw("FIELD(id_pertanyaan, " . implode(',', $orderedIds) . ")")
            ->get();

        return view('siswa.tes.create', compact('pertanyaan'));
    }

    public function store(Request $request)
    {
        $siswa = Auth::guard('siswa')->user();

        $request->validate([
            'jawaban'   => 'required|array',
            'jawaban.*' => 'required|numeric|between:-1,1',
        ]);

        $tes = $this->tesService->simpanTes($siswa->id_siswa, $request->jawaban);

        session()->forget('urutan_soal');

        // Jika jawaban seragam (nilai_cf_total = 0 dan id_kepribadian null)
        if ($tes->nilai_cf_total == 0 && is_null($tes->id_kepribadian)) {
            return redirect()->route('siswa.tes.result', $tes->id_tes)
                ->with('error', 'Jawaban Anda terlalu seragam. Silakan ulangi tes dengan jawaban yang lebih bervariasi.');
        }

        return redirect()->route('siswa.tes.result', $tes->id_tes)
            ->with('success', 'Tes Anda berhasil diproses!');
    }

    public function show($id)
    {
        $siswa = Auth::guard('siswa')->user();

        $tes = Tes::where('id_siswa', $siswa->id_siswa)
            ->with(['kepribadian', 'karir'])
            ->findOrFail($id);

        $hasilKepribadian = $this->tesService->hitungHasilKepribadian($id) ?? collect();
        $rekomendasiKarir = $this->tesService->getRekomendasiKarir($id) ?? collect();

        $kepribadianDominan = $tes->kepribadian;

        return view('siswa.tes.result', compact(
            'tes',
            'hasilKepribadian',
            'kepribadianDominan',
            'rekomendasiKarir'
        ));
    }

    public function result($id)
    {
        return $this->show($id);
    }

    public function print($id)
    {
        $tes = Tes::with(['siswa', 'kepribadian.karir'])->findOrFail($id);
        $hasilKepribadian = $this->tesService->hitungHasilKepribadian($id) ?? collect();
        $rekomendasiKarir = $this->tesService->getRekomendasiKarir($id) ?? collect();
        $kepribadianDominan = $tes->kepribadian;

        return view('siswa.tes.print', compact(
            'tes',
            'hasilKepribadian',
            'rekomendasiKarir',
            'kepribadianDominan'
        ));
    }
}
