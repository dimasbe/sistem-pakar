@extends('layouts.admin')

@section('title', 'Edit Karir')
@section('page-title', 'Edit Karir')

@section('content')
    <div class="max-w-full">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            {{-- Alert Container --}}
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

            <form id="karirForm" action="{{ route('admin.karir.update', $karir->id_karir) }}" method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 gap-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama Karir --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2 uppercase">Nama Karir</label>
                            <input type="text" name="nama_karir" id="nama_karir"
                                value="{{ old('nama_karir', $karir->nama_karir) }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none uppercase placeholder-gray-300"
                                placeholder="Contoh: Software Engineer">
                        </div>

                        {{-- Kaitan Tipe Kepribadian (Dropdown Cantik) --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2 uppercase">Kaitan Tipe
                                Kepribadian</label>
                            <div class="relative">
                                <select name="id_kepribadian" id="id_kepribadian"
                                    class="appearance-none w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none cursor-pointer bg-white">
                                    <option value="">-- Pilih Tipe Kepribadian --</option>
                                    @foreach ($kepribadian as $kp)
                                        <option value="{{ $kp->id_kepribadian }}"
                                            {{ old('id_kepribadian', $karir->id_kepribadian) == $kp->id_kepribadian ? 'selected' : '' }}>
                                            {{ $kp->kode_kepribadian }} - {{ $kp->nama_kepribadian }}
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

                    {{-- Deskripsi Karir --}}
                    <div>
                        <label class="block text-sm font-bold text-[#2E6C9F] mb-2 uppercase">Deskripsi Karir</label>
                        <textarea name="deskripsi_karir" id="deskripsi_karir" rows="5"
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none placeholder-gray-300"
                            placeholder="Jelaskan tentang pekerjaan ini...">{{ old('deskripsi_karir', $karir->deskripsi_karir) }}</textarea>
                    </div>

                    {{-- Tips Section --}}
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-xs text-[#2E6C9F] leading-relaxed">
                            <i class="fas fa-info-circle mr-1"></i> <strong>Tips:</strong>
                            Hubungkan karir dengan tipe kepribadian yang paling relevan agar hasil rekomendasi akurat bagi
                            siswa.
                        </p>
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="submit"
                            class="bg-[#2E6C9F] text-white px-8 py-2.5 rounded-lg font-bold hover:bg-[#3D78A8] transition shadow-md">
                            Update Karir
                        </button>
                        <a href="{{ route('admin.karir.index') }}"
                            class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition flex items-center justify-center shadow-sm">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('karirForm').addEventListener('submit', function(e) {
            let errors = [];
            const nama = document.getElementById('nama_karir').value.trim();
            const kepribadian = document.getElementById('id_kepribadian').value;
            const deskripsi = document.getElementById('deskripsi_karir').value.trim();

            if (!nama) {
                errors.push("Nama Karir jangan dikosongkan ya.");
            }
            if (!kepribadian) {
                errors.push("Pilih salah satu Tipe Kepribadian yang berkaitan.");
            }
            if (!deskripsi) {
                errors.push("Deskripsi karirnya tolong diisi dulu.");
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
