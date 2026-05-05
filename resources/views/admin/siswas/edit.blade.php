@extends('layouts.admin')

@section('title', 'Edit Siswa')
@section('page-title', 'Edit Siswa')

@section('content')
    <div class="max-w-full">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            {{-- Alert Section untuk Validasi JS --}}
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

            <form id="editSiswaForm" action="{{ route('admin.siswas.update', $siswa->id_siswa) }}" method="POST" novalidate>
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-bold text-[#2E6C9F] mb-2">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                            value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}"
                            class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none"
                            placeholder="Masukkan nama lengkap">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- E-mail --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2">E-mail</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $siswa->email) }}"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none"
                                placeholder="email@gmail.com">
                        </div>
                        {{-- Kelas Dropdown --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2">Kelas</label>
                            <select name="kelas" id="kelas"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none">
                                <option value="">Pilih Kelas</option>
                                <option value="10" {{ old('kelas', $siswa->kelas) == '10' ? 'selected' : '' }}>10
                                </option>
                                <option value="11" {{ old('kelas', $siswa->kelas) == '11' ? 'selected' : '' }}>11
                                </option>
                                <option value="12" {{ old('kelas', $siswa->kelas) == '12' ? 'selected' : '' }}>12
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Jenis Kelamin --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2">Jenis Kelamin</label>
                            <select name="jenis_kelamin"
                                class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none">
                                <option value="L"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki (L)
                                </option>
                                <option value="P"
                                    {{ old('jenis_kelamin', $siswa->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan (P)
                                </option>
                            </select>
                        </div>
                        {{-- Password --}}
                        <div>
                            <label class="block text-sm font-bold text-[#2E6C9F] mb-2">Password (Kosongkan jika tidak
                                diubah)</label>
                            <div class="relative">
                                <input type="password" name="password" id="password"
                                    class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:ring-2 focus:ring-[#2E6C9F] focus:outline-none"
                                    placeholder="******">
                                <button type="button" onclick="togglePassword('password', 'passwordIcon')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#2E6C9F]">
                                    <i id="passwordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 flex gap-3">
                        <button type="submit"
                            class="bg-[#2E6C9F] text-white px-8 py-2.5 rounded-lg font-bold hover:bg-[#3D78A8] transition shadow-md">
                            Update Siswa
                        </button>
                        <a href="{{ route('admin.siswas.index') }}"
                            class="bg-gray-100 text-gray-600 px-8 py-2.5 rounded-lg font-bold hover:bg-gray-200 transition">
                            Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Fungsi Toggle Password
        function togglePassword(inputId, iconId) {
            const passwordInput = document.getElementById(inputId);
            const passwordIcon = document.getElementById(iconId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        // Validasi Form
        document.getElementById('editSiswaForm').addEventListener('submit', function(e) {
            let errors = [];
            const nama = document.getElementById('nama_lengkap').value;
            const email = document.getElementById('email').value;
            const kelas = document.getElementById('kelas').value;
            const password = document.getElementById('password').value;

            if (!nama) errors.push("Nama Lengkap wajib diisi.");
            if (!email) errors.push("E-mail tidak boleh kosong.");
            if (!kelas) errors.push("Silakan pilih kelas.");

            // Password pada edit bersifat opsional, tapi jika diisi harus min 6 karakter
            if (password.length > 0 && password.length < 6) {
                errors.push("Password minimal harus 6 karakter jika ingin diubah.");
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
