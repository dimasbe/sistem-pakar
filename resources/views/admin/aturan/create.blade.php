@extends('layouts.admin')

@section('title', 'Tambah Aturan')
@section('page-title', 'Tambah Aturan')

@section('content')
    <div class="max-w-full">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            {{-- Alert Container untuk Validasi JS --}}
            <div id="alert-container">
                @if ($errors->any())
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <form id="aturanForm" action="{{ route('admin.aturan.store') }}" method="POST" novalidate>
                @csrf
                <div class="grid grid-cols-1 gap-6">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Pilih Pertanyaan --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2 uppercase">Pilih Pertanyaan</label>
                            <div class="relative">
                                <select name="id_pertanyaan" id="id_pertanyaan"
                                    class="appearance-none w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none cursor-pointer bg-white text-sm">
                                    <option value="">-- Pilih Pertanyaan --</option>
                                    @foreach ($pertanyaan as $p)
                                        <option value="{{ $p->id_pertanyaan }}"
                                            {{ old('id_pertanyaan') == $p->id_pertanyaan ? 'selected' : '' }}>
                                            {{ $p->kode_pertanyaan }} - {{ Str::limit($p->teks_pertanyaan, 100) }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>

                        {{-- Pilih Kepribadian --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2 uppercase">Kaitan Tipe
                                Kepribadian</label>
                            <div class="relative">
                                <select name="id_kepribadian" id="id_kepribadian"
                                    class="appearance-none w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none cursor-pointer bg-white">
                                    <option value="">-- Pilih Tipe --</option>
                                    @foreach ($kepribadian as $k)
                                        <option value="{{ $k->id_kepribadian }}"
                                            {{ old('id_kepribadian') == $k->id_kepribadian ? 'selected' : '' }}>
                                            {{ $k->kode_kepribadian }} - {{ $k->nama_kepribadian }}
                                        </option>
                                    @endforeach
                                </select>
                                <div
                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-3 text-gray-400">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Nilai CF Pakar (Tanpa Spinner/Dropdown Angka) --}}
                    <div>
                        <label class="block text-sm font-bold text-[#2E6C9F] mb-2 uppercase">Nilai CF Pakar</label>
                        <input type="text" name="cf_pakar" id="cf_pakar" value="{{ old('cf_pakar') }}"
                            placeholder="Masukkan nilai (Contoh: 0.8)"
                            class="w-full md:w-1/3 px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none placeholder-gray-300">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit"
                            class="bg-[#2E6C9F] text-white px-8 py-2.5 rounded-lg font-bold hover:bg-[#3D78A8] transition shadow-md">
                            Simpan Aturan
                        </button>
                        <a href="{{ route('admin.aturan.index') }}"
                            class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition flex items-center justify-center shadow-sm">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('aturanForm').addEventListener('submit', function(e) {
            let errors = [];
            const pertanyaan = document.getElementById('id_pertanyaan').value;
            const kepribadian = document.getElementById('id_kepribadian').value;
            const cf = document.getElementById('cf_pakar').value;

            if (!pertanyaan) {
                errors.push("Silakan pilih pertanyaan terlebih dahulu.");
            }
            if (!kepribadian) {
                errors.push("Tipe kepribadian harus dikaitkan.");
            }
            if (cf === "") {
                errors.push("Nilai CF Pakar tidak boleh kosong.");
            } else {
                // Mengizinkan format angka desimal
                const val = parseFloat(cf.replace(',', '.'));
                if (isNaN(val)) {
                    errors.push("Nilai CF Pakar harus berupa angka.");
                } else if (val < -1 || val > 1) {
                    errors.push("Nilai CF Pakar harus di antara -1.0 sampai 1.0.");
                }
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
