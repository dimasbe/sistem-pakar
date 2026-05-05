<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sikarir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }

        input::-ms-reveal,
        input::-ms-clear {
            display: none;
        }
    </style>
</head>

<body class="bg-[#E5E5E5] min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md md:max-w-4xl w-full bg-white rounded-xl shadow-2xl overflow-hidden flex flex-col md:flex-row">

        <div class="hidden md:flex md:w-1/2 bg-[#2E6C9F] p-10 items-center justify-center relative">
            <a href="{{ route('landing.index') }}"
                class="absolute top-5 left-5 flex items-center justify-center w-8 h-8 border border-white/50 hover:bg-white hover:text-[#2E6C9F] rounded-full text-white transition-all duration-300">
                <i class="fas fa-times text-sm"></i>
            </a>

            @if ($role === 'admin')
                <div class="absolute top-5 right-5">
                    <span class="bg-white/20 text-white text-xs font-semibold px-3 py-1 rounded-full">
                        <i class="fas fa-user-shield mr-1"></i> Admin
                    </span>
                </div>
            @endif

            <img src="{{ asset('images/heroauth.png') }}" class="w-full h-auto object-contain">
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 relative">

            <a href="{{ route('landing.index') }}"
                class="md:hidden absolute top-4 left-4 flex items-center justify-center w-8 h-8 border border-gray-300 hover:bg-[#2E6C9F] hover:text-white rounded-full text-gray-500 transition-all duration-300">
                <i class="fas fa-times text-sm"></i>
            </a>

            <div class="flex flex-col items-center justify-center mb-4">
                <div class="text-[#2E6C9F] text-3xl font-bold flex items-center gap-2 mb-4">
                    <img src="{{ asset('images/logo1.png') }}" class="h-10 w-auto">
                    <span>Sikarir</span>
                </div>
                <h2 class="text-xl md:text-2xl font-bold text-gray-800 text-center">Silahkan Login</h2>
                <p class="text-center text-gray-500 text-sm">
                    {{ $role === 'admin' ? 'Login sebagai Administrator' : 'Login sebagai Siswa' }}
                </p>
            </div>

            @if (session('success'))
                <div
                    class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center gap-2 text-sm">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="alert-container"></div>

            <form id="loginForm" method="POST"
                action="{{ $role === 'admin' ? route('admin.login.submit') : route('siswa.login.submit') }}">
                @csrf

                <div class="mb-5">
                    <label class="block text-gray-700 font-semibold mb-2 text-sm md:text-base">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-3 bg-[#F3F4F6] rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none text-sm"
                        placeholder="Masukan email">
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-semibold mb-2 text-sm md:text-base">Password</label>
                    <div class="relative">
                        <input type="password" id="password" name="password"
                            class="w-full px-4 py-3 bg-[#F3F4F6] rounded-lg focus:ring-2 focus:ring-[#2E6C9F] outline-none text-sm pr-12"
                            placeholder="Masukan password">
                        <button type="button" onclick="togglePassword()"
                            class="absolute right-0 top-0 h-full px-4 flex items-center text-gray-500 hover:text-[#2E6C9F]">
                            <i id="passwordIcon" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <button type="submit"
                    class="w-full bg-[#2E6C9F] text-white font-bold py-3 rounded-lg hover:bg-[#255A86] transition-all shadow-md active:scale-[0.98]">
                    Login
                </button>

                @if ($role === 'siswa')
                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('siswa.register') }}" class="text-[#2E6C9F] font-bold hover:underline">
                                Register
                            </a>
                        </p>
                    </div>
                @endif
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }


        // 🔥 AUTOFILL (HP & Laptop)
        document.addEventListener("DOMContentLoaded", function() {

            const savedEmail = localStorage.getItem("remember_email");
            const savedPassword = localStorage.getItem("remember_password");

            if (savedEmail) {
                document.getElementById("email").value = savedEmail;
            }

            if (savedPassword) {
                document.getElementById("password").value = savedPassword;
            }

        });


        // VALIDASI + SIMPAN LOGIN
        document.getElementById('loginForm').addEventListener('submit', function(e) {

            let errors = [];

            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!email) errors.push("Email wajib diisi.");
            if (!password) errors.push("Password wajib diisi.");
            if (password && password.length < 6) errors.push("Password minimal 6 karakter.");

            if (errors.length > 0) {

                e.preventDefault();

                const container = document.getElementById('alert-container');
                container.innerHTML = "";

                let html = `
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg text-sm shadow-sm animate-pulse">
            <ul class="list-disc list-inside">
        `;

                errors.forEach(err => {
                    html += `<li>${err}</li>`;
                });

                html += `</ul></div>`;

                container.innerHTML = html;

                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });

            } else {

                // 🔥 SIMPAN KE LOCAL STORAGE
                localStorage.setItem("remember_email", email);
                localStorage.setItem("remember_password", password);
            }
        });
    </script>

</body>

</html>
