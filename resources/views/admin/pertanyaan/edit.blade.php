@extends('layouts.admin')

@section('title', 'Edit Pertanyaan')
@section('page-title', 'Edit Pertanyaan')

@section('content')
    <div class="max-w-full">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
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

            <form id="pertanyaanForm" action="{{ route('admin.pertanyaan.update', $pertanyaan->id_pertanyaan) }}"
                method="POST" novalidate>
                @csrf
                @method('PUT')
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-[#2E6C9F] mb-2 uppercase">Teks Pertanyaan</label>
                        <textarea name="teks_pertanyaan" id="teks_pertanyaan" rows="5"
                            class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none placeholder-gray-300"
                            placeholder="Contoh: Apakah Anda suka bekerja dengan mesin atau alat teknik?">{{ old('teks_pertanyaan', $pertanyaan->teks_pertanyaan) }}</textarea>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-xs text-[#2E6C9F] leading-relaxed">
                            <i class="fas fa-info-circle mr-1"></i> <strong>Tips:</strong> Buatlah pertanyaan yang jelas
                            untuk mempermudah siswa dalam mengerjakan tes.
                        </p>
                    </div>

                    <div class="pt-4 flex items-center gap-3">
                        <button type="submit"
                            class="bg-[#2E6C9F] text-white px-8 py-2.5 rounded-lg font-bold hover:bg-[#3D78A8] transition shadow-md">
                            Update Pertanyaan
                        </button>
                        <a href="{{ route('admin.pertanyaan.index') }}"
                            class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition flex items-center justify-center">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('pertanyaanForm').addEventListener('submit', function(e) {
            let errors = [];
            const teks = document.getElementById('teks_pertanyaan').value.trim();

            if (!teks) {
                errors.push("Teks Pertanyaan Tidak Boleh Kosong.");
            } else if (teks.length < 10) {
                errors.push("Pertanyaan Terlalu Pendek, Tolong Lebih diperjelas.");
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
