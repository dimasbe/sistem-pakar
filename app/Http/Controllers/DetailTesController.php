<?php

namespace App\Http\Controllers;

use App\Models\DetailTes;
use App\Models\Tes;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DetailTesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detailTes = DetailTes::with(['tes', 'pertanyaan'])->latest()->paginate(10);
        return view('detail_tes.index', compact('detailTes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tes = Tes::all();
        $pertanyaan = Pertanyaan::all();
        return view('detail_tes.create', compact('tes', 'pertanyaan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_tes' => 'required|exists:tes,id_tes',
            'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
            'jawaban' => 'required|integer|min:1|max:5',
            'nilai_cf_user' => 'required|numeric|between:-1,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        DetailTes::create($request->all());

        return redirect()->route('detail-tes.index')
            ->with('success', 'Detail Tes berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detailTes = DetailTes::with(['tes', 'pertanyaan'])->findOrFail($id);
        return view('detail_tes.show', compact('detailTes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detailTes = DetailTes::findOrFail($id);
        $tes = Tes::all();
        $pertanyaan = Pertanyaan::all();
        return view('detail_tes.edit', compact('detailTes', 'tes', 'pertanyaan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detailTes = DetailTes::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_tes' => 'required|exists:tes,id_tes',
            'id_pertanyaan' => 'required|exists:pertanyaan,id_pertanyaan',
            'jawaban' => 'required|integer|min:1|max:5',
            'nilai_cf_user' => 'required|numeric|between:-1,1',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $detailTes->update($request->all());

        return redirect()->route('detail-tes.index')
            ->with('success', 'Detail Tes berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $detailTes = DetailTes::findOrFail($id);
        $detailTes->delete();

        return redirect()->route('detail-tes.index')
            ->with('success', 'Detail Tes berhasil dihapus');
    }
}
