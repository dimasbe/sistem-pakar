<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $siswa = Siswa::when($search, function ($query) use ($search) {
            $query->where('nama_lengkap', 'LIKE', '%' . $search . '%');
        })
            ->latest()
            ->paginate(10);

        return view('admin.siswas.index', compact('siswa'));
    }

    public function create()
    {
        return view('admin.siswas.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|unique:siswa,email',
            'nama_lengkap' => 'required|string|max:100',
            'kelas' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        Siswa::create([
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
            'password' => Hash::make($request->password),
        ]);

        // Perbaikan: Redirect ke rute dengan prefix admin.
        return redirect()->route('admin.siswas.index')
            ->with('success', 'Siswa berhasil ditambahkan');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        // Perbaikan: Arahkan ke folder admin/siswas
        return view('admin.siswas.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:100|unique:siswa,email,' . $id . ',id_siswa',
            'nama_lengkap' => 'required|string|max:100',
            'kelas' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'password' => 'nullable|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'email' => $request->email,
            'nama_lengkap' => $request->nama_lengkap,
            'kelas' => $request->kelas,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        // Perbaikan: Redirect ke rute dengan prefix admin.
        return redirect()->route('admin.siswas.index')
            ->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        // Perbaikan: Redirect ke rute dengan prefix admin.
        return redirect()->route('admin.siswas.index')
            ->with('success', 'Siswa berhasil dihapus');
    }
}
