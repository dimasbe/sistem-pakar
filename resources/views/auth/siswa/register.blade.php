<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Sikarir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Menghilangkan icon mata bawaan browser agar tidak double */
        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }

        /* Memperbaiki tampilan dropdown di iOS/Safari agar tidak terlihat bulat/default */
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 0.7rem center;
            background-size: 1em;
        }
    </style>
</head>

<body class="bg-[#E5E5E5] min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md md:max-w-4xl w-full bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        <div class="hidden md:flex md:w-1/2 bg-[#2E6C9F] p-10 items-center justify-center relative">
            <a href="{{ route('landing.index') }}"
                class="absolute top-5 left-5 flex items-center justify-center w-8 h-8 border border-white/50 hover:bg-white hover:text-[#2E6C9F] rounded-full text-white transition-all duration-300"
                title="Kembali ke Beranda">
                <i class="fas fa-times text-sm"></i>
            </a>
            <img src="{{ asset('images/heroauth.png') }}" alt="Ilustrasi Register" class="w-full h-auto object-contain">
        </div>

        <div class="w-full md:w-1/2 p-6 md:p-10 relative">

            <a href="{{ route('landing.index') }}"
                class="md:hidden absolute top-4 left-4 flex items-center justify-center w-8 h-8 border border-gray-300 hover:bg-[#2E6C9F] hover:text-white rounded-full text-gray-500 transition-all duration-300"
                title="Kembali ke Beranda">
                <i class="fas fa-times text-sm"></i>
            </a>

            <div class="flex flex-col items-center justify-center mb-6">
                <div class="text-[#2E6C9F] text-2xl font-bold flex items-center gap-2 mb-2">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-8 w-auto">
                    <span>Sikarir</span>
                </div>
                <h2 class="text-xl font-bold text-gray-800 text-center">Selamat Datang</h2>
                <p class="text-center text-gray-500 text-sm">Halaman Register Siswa</p>
            </div>

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

            <form id="siswaRegisterForm" method="POST" action="{{ route('siswa.register.submit') }}" novalidate>
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold text-sm mb-1" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2.5 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm"
                        placeholder="Masukan email">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold text-sm mb-1" for="nama_lengkap">Nama
                        Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}"
                        class="w-full px-4 py-2.5 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm"
                        placeholder="Masukan nama lengkap">
                </div>

                <div class="flex flex-col sm:flex-row gap-4 mb-4">
                    <div class="w-full sm:w-1/2">
                        <label class="block text-gray-700 font-semibold text-sm mb-1" for="kelas">Kelas</label>
                        <select id="kelas" name="kelas"
                            class="w-full px-4 py-2.5 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm cursor-pointer">
                            <option value="">Pilih Kelas</option>
                            <optgroup label="Kelas 10">
                                <option value="10 IPA" {{ old('kelas') == '10 IPA' ? 'selected' : '' }}>10 IPA</option>
                                <option value="10 IPS" {{ old('kelas') == '10 IPS' ? 'selected' : '' }}>10 IPS</option>
                            </optgroup>
                            <optgroup label="Kelas 11">
                                <option value="11 IPA" {{ old('kelas') == '11 IPA' ? 'selected' : '' }}>11 IPA</option>
                                <option value="11 IPS" {{ old('kelas') == '11 IPS' ? 'selected' : '' }}>11 IPS</option>
                            </optgroup>
                            <optgroup label="Kelas 12">
                                <option value="12 IPA" {{ old('kelas') == '12 IPA' ? 'selected' : '' }}>12 IPA</option>
                                <option value="12 IPS" {{ old('kelas') == '12 IPS' ? 'selected' : '' }}>12 IPS</option>
                            </optgroup>
                        </select>
                    </div>
                    <div class="w-full sm:w-1/2">
                        <label class="block text-gray-700 font-semibold text-sm mb-1" for="jenis_kelamin">Jenis
                            Kelamin</label>
                        <select id="jenis_kelamin" name="jenis_kelamin"
                            class="w-full px-4 py-2.5 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm cursor-pointer">
                            <option value="">Pilih Jenis</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki
                            </option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan
                            </option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-semibold text-sm mb-1" for="password">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2.5 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm pr-10"
                            placeholder="Masukan password">
                        <button type="button" onclick="togglePass('password', 'pIcon')"
                            class="absolute right-0 top-0 h-full px-3 flex items-center text-gray-500 hover:text-[#2E6C9F]">
                            <i id="pIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold text-sm mb-1"
                        for="password_confirmation">Konfirmasi
                        Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2.5 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm pr-10"
                            placeholder="Silahkan konfirmasi password">
                        <button type="button" onclick="togglePass('password_confirmation', 'cIcon')"
                            class="absolute right-0 top-0 h-full px-3 flex items-center text-gray-500 hover:text-[#2E6C9F]">
                            <i id="cIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#2E6C9F] text-white font-bold py-3 rounded-lg hover:bg-[#255A86] transition-all shadow-md active:scale-[0.98]">
                    Register
                </button>

                <div class="mt-4 text-center">
                    <p class="text-sm text-gray-600">
                        Sudah punya akun?
                        <a href="{{ route('siswa.login') }}" class="text-[#2E6C9F] font-bold hover:underline">
                            Login</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePass(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        document.getElementById('siswaRegisterForm').addEventListener('submit', function(e) {
            let errors = [];
            const email = document.getElementById('email').value;
            const nama = document.getElementById('nama_lengkap').value;
            const kelas = document.getElementById('kelas').value;
            const jk = document.getElementById('jenis_kelamin').value;
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;

            if (!email) errors.push("Email wajib diisi.");
            if (!nama) errors.push("Nama lengkap wajib diisi.");
            if (!kelas) errors.push("Silahkan pilih kelas Anda.");
            if (!jk) errors.push("Silahkan pilih jenis kelamin Anda.");
            if (!pass) errors.push("Password tidak boleh kosong.");
            if (pass && pass.length < 6) errors.push("Password minimal 6 karakter.");
            if (pass !== confirm) errors.push("Konfirmasi password tidak sesuai.");

            if (errors.length > 0) {
                e.preventDefault();
                const container = document.getElementById('alert-container');
                let html = `<div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded text-sm shadow-sm animate-pulse">
                                <ul class="list-disc list-inside">`;
                errors.forEach(err => {
                    html += `<li>${err}</li>`;
                });
                html += `</ul></div>`;
                container.innerHTML = html;
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });
    </script>
</body>

</html>
