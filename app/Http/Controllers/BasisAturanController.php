<?php

namespace App\Http\Controllers;

use App\Models\BasisAturan;
use App\Models\Pertanyaan;
use App\Models\Kepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BasisAturanController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $basisAturan = BasisAturan::with(['pertanyaan', 'kepribadian'])
            ->when($search, function ($query) use ($search) {
                $query->whereHas('pertanyaan', function ($q) use ($search) {
                    $q->where('teks_pertanyaan', 'LIKE', "%$search%");
                });
            })
            ->orderBy('id_kepribadian', 'asc')
            ->orderBy('id_pertanyaan', 'asc')
            ->paginate(10);

        return view('admin.aturan.index', compact('basisAturan'));
    }

    public function create()
    {
        $pertanyaan = Pertanyaan::all();
        $kepribadian = Kepribadian::all();
        return view('admin.aturan.create', compact('pertanyaan', 'kepribadian'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
            'id_kepribadian' => 'required|exists:kepribadian,id_kepribadian',
            'cf_pakar' => 'required|numeric|between:-1,1',
        ]);

        BasisAturan::create($request->all());

        return redirect()->route('admin.aturan.index')
            ->with('success', 'Basis Aturan berhasil ditambahkan');
    }

    public function show($id)
    {
        $basisAturan = BasisAturan::with(['pertanyaan', 'kepribadian.karir'])->findOrFail($id);
        return view('admin.aturan.show', compact('basisAturan'));
    }

    public function edit($id)
    {
        $basisAturan = BasisAturan::findOrFail($id);
        $pertanyaan = Pertanyaan::all();
        $kepribadian = Kepribadian::all();
        return view('admin.aturan.edit', compact('basisAturan', 'pertanyaan', 'kepribadian'));
    }

    public function update(Request $request, $id)
    {
        $basisAturan = BasisAturan::findOrFail($id);

        $request->validate([
            'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
            'id_kepribadian' => 'required|exists:kepribadian,id_kepribadian',
            'cf_pakar' => 'required|numeric|between:-1,1',
        ]);

        $basisAturan->update($request->all());

        return redirect()->route('admin.aturan.index')
            ->with('success', 'Basis Aturan berhasil diupdate');
    }

    public function destroy($id)
    {
        $basisAturan = BasisAturan::findOrFail($id);
        $basisAturan->delete();

        return redirect()->route('admin.aturan.index')
            ->with('success', 'Basis Aturan berhasil dihapus');
    }
}
