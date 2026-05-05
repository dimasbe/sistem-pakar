<?php

namespace App\Http\Controllers;

use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException; // Tambahkan ini di atas

class PertanyaanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $pertanyaan = Pertanyaan::when($search, function ($query) use ($search) {
            $query->where('teks_pertanyaan', 'LIKE', '%' . $search . '%');
        })
            ->latest()
            ->paginate(10);

        return view('admin.pertanyaan.index', compact('pertanyaan'));
    }

    public function create()
    {
        return view('admin.pertanyaan.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'teks_pertanyaan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Pertanyaan::create($request->all());

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        return view('admin.pertanyaan.edit', compact('pertanyaan'));
    }

    public function update(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'teks_pertanyaan' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $pertanyaan->update($request->all());

        return redirect()->route('admin.pertanyaan.index')
            ->with('success', 'Pertanyaan berhasil diupdate');
    }

    public function destroy($id)
    {
        try {
            $pertanyaan = Pertanyaan::findOrFail($id);
            $pertanyaan->delete();

            return redirect()->route('admin.pertanyaan.index')
                ->with('success', 'Pertanyaan berhasil dihapus');
        } catch (QueryException $e) {
            // Jika data pertanyaan sudah dijawab (ada di tabel hasil/jawaban)
            if ($e->getCode() == "23000") {
                return redirect()->route('admin.pertanyaan.index')
                    ->with('error', 'Pertanyaan ini tidak bisa dihapus karena sudah memiliki data keterkaitan.');
            }

            return redirect()->route('admin.pertanyaan.index')
                ->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }
}
