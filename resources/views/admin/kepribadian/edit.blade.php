@extends('layouts.admin')

@section('title', 'Edit Kepribadian')
@section('page-title', 'Edit Kepribadian')

@section('content')
    <div class="max-w-full">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            {{-- Alert Container --}}
            <div id="alert-container">
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>
                                    @if (str_contains($error, 'already been taken'))
                                        kode ini sudah ada, coba ganti dengan kode yang lain.
                                    @else
                                        {{ $error }}
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form id="editKepribadianForm" action="{{ route('admin.kepribadian.update', $kepribadian->id_kepribadian) }}"
                method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        {{-- Kode Kepribadian - Input Teks Biasa --}}
                        <div class="md:col-span-1">
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2">Kode</label>
                            <input type="text" name="kode_kepribadian" id="kode_kepribadian"
                                value="{{ old('kode_kepribadian', $kepribadian->kode_kepribadian) }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none text-center font-bold uppercase"
                                placeholder="R/I/A/S/E/C" maxlength="1">
                        </div>

                        {{-- Nama Tipe Kepribadian --}}
                        <div class="md:col-span-3">
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2">Nama Tipe Kepribadian</label>
                            <input type="text" name="nama_kepribadian" id="nama_kepribadian"
                                value="{{ old('nama_kepribadian', $kepribadian->nama_kepribadian) }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none uppercase"
                                placeholder="Masukkan nama kepribadian">
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-bold text-[#2E6C9F] mb-2">Deskripsi Lengkap</label>
                        <textarea name="deskripsi" id="deskripsi" rows="6"
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none"
                            placeholder="Jelaskan karakteristik tipe kepribadian ini...">{{ old('deskripsi', $kepribadian->deskripsi) }}</textarea>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <button type="submit"
                            class="bg-[#2E6C9F] text-white px-8 py-2.5 rounded-lg font-bold hover:bg-[#3D78A8] transition shadow-md">
                            Update Kepribadian
                        </button>
                        <a href="{{ route('admin.kepribadian.index') }}"
                            class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition flex items-center justify-center">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('editKepribadianForm').addEventListener('submit', function(e) {
            let errors = [];
            const kode = document.getElementById('kode_kepribadian').value.trim();
            const nama = document.getElementById('nama_kepribadian').value.trim();
            const deskripsi = document.getElementById('deskripsi').value.trim();

            if (!kode) {
                errors.push("Kode Tidak Boleh Kosong.");
            }
            if (!nama) {
                errors.push("Nama Tipe Kepribadian jangan dikosongkan.");
            }
            if (!deskripsi) {
                errors.push("Deskripsi lengkapnya tolong diisi.");
            }

            if (errors.length > 0) {
                e.preventDefault();
                const alertBox = document.getElementById('alert-container');
                let html = `<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                                <ul class="list-disc list-inside">`;
                errors.forEach(err => {
                    html += `<li>${err}</li>`;
                });
                html += `</ul></div>`;
                alertBox.innerHTML = html;
                window.scrollTo(0, 0);
            }
        });
    </script>
@endsection
