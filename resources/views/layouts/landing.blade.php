<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sikarir')</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-[#F8FAFC] min-h-screen flex flex-col">

    <nav class="bg-[#2E6C9F] px-6 md:px-10 py-4 sticky top-0 z-50 shadow-md">
        <div class="flex items-center justify-between">

            {{-- Logo --}}
            <a href="{{ route('landing.index') }}" class="flex items-center gap-2">
                <img src="{{ asset('images/logo2.png') }}" class="w-10 h-10 object-contain brightness-0 invert">
                <span class="text-white font-bold text-xl">
                    Sikarir
                </span>
            </a>

            {{-- Desktop Buttons --}}
            <div class="hidden md:flex gap-3 text-sm">
                <a href="{{ route('siswa.login') }}"
                    class="bg-white text-[#2E6C9F] px-5 py-2 rounded-full font-semibold hover:bg-gray-100 transition">
                    Login
                </a>
                <a href="{{ route('siswa.register') }}"
                    class="border border-white text-white px-5 py-2 rounded-full font-semibold hover:bg-white hover:text-[#2E6C9F] transition">
                    Register
                </a>
            </div>

            {{-- Hamburger --}}
            <button id="mobile-menu-button" class="md:hidden text-white text-2xl focus:outline-none">
                <i class="fas fa-bars" id="menu-icon"></i>
            </button>

        </div>

        {{-- Mobile Dropdown --}}
        <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-white/20">

            <div class="flex flex-col gap-3 pt-4">
                <a href="{{ route('siswa.login') }}"
                    class="bg-white text-[#2E6C9F] text-center py-2 rounded-full font-semibold">
                    Login
                </a>

                <a href="{{ route('siswa.register') }}"
                    class="border border-white text-white text-center py-2 rounded-full font-semibold">
                    Register
                </a>
            </div>

        </div>
    </nav>

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('partials.footer')

    <script>
        const btn = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        const icon = document.getElementById('menu-icon');

        btn.addEventListener('click', () => {

            menu.classList.toggle('hidden');

            if (menu.classList.contains('hidden')) {
                icon.classList.replace('fa-times', 'fa-bars');
            } else {
                icon.classList.replace('fa-bars', 'fa-times');
            }

        });
    </script>

</body>

</html>
