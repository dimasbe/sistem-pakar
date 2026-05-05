<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin - Sikarir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>

<body class="bg-[#E5E5E5] min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md md:max-w-4xl w-full bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        {{-- Left Side: Hilang di mobile, muncul di desktop --}}
        <div class="hidden md:flex md:w-1/2 bg-[#2E6C9F] p-10 flex-col items-center justify-center relative">
            <a href="{{ route('landing.index') }}"
                class="absolute top-5 left-5 flex items-center justify-center w-8 h-8 border border-white/50 hover:bg-white hover:text-[#2E6C9F] rounded-full text-white transition-all duration-300"
                title="Kembali ke Beranda">
                <i class="fas fa-times text-sm"></i>
            </a>
            <div class="absolute top-5 right-5">
                <span class="bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                    <i class="fas fa-user-shield mr-1"></i> Admin
                </span>
            </div>
            <img src="{{ asset('images/heroauth.png') }}" alt="Ilustrasi Register" class="w-full h-auto object-contain">
        </div>

        {{-- Right Side --}}
        <div class="w-full md:w-1/2 p-8 md:p-10 relative">

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
            </div>

            {{-- Alert Section --}}
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

            <form id="registerForm" method="POST" action="{{ route('admin.register.submit') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label class="block text-gray-700 font-semibold text-sm mb-1" for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                        class="w-full px-4 py-2 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm"
                        placeholder="Masukkan nama admin">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 font-semibold text-sm mb-1" for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm"
                        placeholder="Masukkan email admin">
                </div>

                <div class="mb-3">
                    <label class="block text-gray-700 font-semibold text-sm mb-1" for="password">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-2 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm"
                            placeholder="Minimal 6 karakter">
                        <button type="button" onclick="togglePassword('password', 'passwordIcon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#2E6C9F]">
                            <i id="passwordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-semibold text-sm mb-1" for="password_confirmation">Konfirmasi
                        Password</label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            class="w-full px-4 py-2 bg-[#F3F4F6] border-none rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none transition text-sm"
                            placeholder="Ulangi password">
                        <button type="button" onclick="togglePassword('password_confirmation', 'confirmIcon')"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-[#2E6C9F]">
                            <i id="confirmIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#2E6C9F] text-white font-bold py-3 rounded-lg hover:bg-[#255A86] transition-all shadow-md">
                    Register Admin
                </button>
            </form>
        </div>
    </div>

    <script>
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

        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let errors = [];
            const nama = document.getElementById('nama').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;

            if (!nama) errors.push("Kolom Nama wajib diisi.");
            if (!email) errors.push("Kolom Email tidak boleh kosong.");
            if (password.length < 6) errors.push("Password minimal harus 6 karakter.");
            if (password !== confirm) errors.push("Konfirmasi password tidak cocok.");

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
</body>

</html>
