<?php

namespace App\Http\Controllers;

use App\Models\Karir;
use App\Models\Kepribadian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KarirController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $karir = Karir::with('kepribadian')
            ->when($search, function ($query) use ($search) {
                $query->where('nama_karir', 'LIKE', '%' . $search . '%');
            })
            ->latest()
            ->paginate(10);

        return view('admin.karir.index', compact('karir'));
    }

    public function create()
    {
        $kepribadian = Kepribadian::all();
        return view('admin.karir.create', compact('kepribadian'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_kepribadian' => 'required|exists:kepribadian,id_kepribadian',
            'nama_karir' => 'required|string|max:100',
            'deskripsi_karir' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Karir::create($request->all());

        return redirect()->route('admin.karir.index')
            ->with('success', 'Karir berhasil ditambahkan');
    }

    public function edit($id)
    {
        $karir = Karir::findOrFail($id);
        $kepribadian = Kepribadian::all();
        return view('admin.karir.edit', compact('karir', 'kepribadian'));
    }

    public function update(Request $request, $id)
    {
        $karir = Karir::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'id_kepribadian' => 'required|exists:kepribadian,id_kepribadian',
            'nama_karir' => 'required|string|max:100',
            'deskripsi_karir' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $karir->update($request->all());

        return redirect()->route('admin.karir.index')
            ->with('success', 'Karir berhasil diupdate');
    }

    public function destroy($id)
    {
        try {
            $karir = Karir::findOrFail($id);
            $karir->delete();

            return redirect()->route('admin.karir.index')
                ->with('success', 'Karir berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('admin.karir.index')
                ->with('error', 'Gagal menghapus data karir.');
        }
    }

    public function show($id)
    {
        $karir = Karir::with('kepribadian')->findOrFail($id);
        return view('admin.karir.show', compact('karir'));
    }
}
