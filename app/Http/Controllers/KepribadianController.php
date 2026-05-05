<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Kepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KepribadianController extends Controller
{
    public function index()
    {
        $kepribadian = Kepribadian::latest()->paginate(10);
        return view('admin.kepribadian.index', compact('kepribadian'));
    }

    public function create()
    {
        return view('admin.kepribadian.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_kepribadian' => 'required|string|size:1|unique:kepribadian,kode_kepribadian',
            'nama_kepribadian' => 'required|string|max:100',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Kepribadian::create($request->all());

        return redirect()->route('admin.kepribadian.index')
            ->with('success', 'Kepribadian berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kepribadian = Kepribadian::findOrFail($id);
        return view('admin.kepribadian.edit', compact('kepribadian'));
    }

    public function update(Request $request, $id)
    {
        $kepribadian = Kepribadian::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'kode_kepribadian' => 'required|string|size:1|unique:kepribadian,kode_kepribadian,' . $id . ',id_kepribadian',
            'nama_kepribadian' => 'required|string|max:100',
            'deskripsi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $kepribadian->update($request->all());

        return redirect()->route('admin.kepribadian.index')
            ->with('success', 'Kepribadian berhasil diupdate');
    }

    public function destroy($id)
    {
        try {
            $kepribadian = Kepribadian::findOrFail($id);

            // 1. Cek Relasi Karir
            if ($kepribadian->karir()->exists()) {
                return redirect()->route('admin.kepribadian.index')
                    ->with('error', "Gagal! Tipe '{$kepribadian->nama_kepribadian}' masih terikat dengan data Karir.");
            }

            // 2. Cek Relasi Basis Aturan
            if ($kepribadian->basisAturan()->exists()) {
                return redirect()->route('admin.kepribadian.index')
                    ->with('error', "Gagal! Tipe '{$kepribadian->nama_kepribadian}' masih digunakan dalam Basis Aturan.");
            }

            // 3. Cek Riwayat Tes
            $cekTes = DB::table('tes')->where('id_kepribadian', $id)->exists();
            if ($cekTes) {
                return redirect()->route('admin.kepribadian.index')
                    ->with('error', "Gagal! Data tidak bisa dihapus karena sudah ada riwayat Tes Siswa.");
            }

            $kepribadian->delete();

            return redirect()->route('admin.kepribadian.index')
                ->with('success', 'Tipe kepribadian berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('admin.kepribadian.index')
                ->with('error', 'Terjadi kesalahan sistem saat mencoba menghapus.');
        }
    }
}
