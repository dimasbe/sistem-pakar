<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - Sikarir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F0F2F5;
        }

        .sidebar-link.active {
            background-color: rgba(255, 255, 255, 0.1);
            font-weight: 500;
        }

        .sidebar-link:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Animasi Transisi Sidebar Mobile */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            #sidebar.closed {
                transform: translateX(-100%);
            }
        }
    </style>
    @stack('styles')
</head>

<body class="text-gray-800 overflow-hidden">

    {{-- Overlay untuk Mobile saat sidebar terbuka --}}
    <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden transition-opacity"></div>

    <div class="flex h-screen overflow-hidden">

        {{-- ======== SIDEBAR ======== --}}
        <aside id="sidebar"
            class="fixed inset-y-0 left-0 w-64 bg-[#2E6C9F] text-white z-50 md:relative md:translate-x-0 closed flex-shrink-0 flex flex-col">
            {{-- Logo Section --}}
            <div class="p-6 md:p-8 pb-4 flex items-center justify-between">
                <div class="flex items-center gap-1">
                    <img src="{{ asset('images/logo2.png') }}" alt="Logo Sikarir" class="w-10 h-10 object-contain">
                    <span class="text-2xl font-bold tracking-tight">Sikarir</span>
                </div>
                {{-- Close button (hanya mobile) --}}
                <button id="closeSidebar" class="md:hidden text-white/70 hover:text-white">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>

            <div class="px-8">
                <div class="border-t border-white/30 w-full"></div>
            </div>

            {{-- Navigation --}}
            <nav class="flex-1 px-4 py-4 overflow-y-auto no-scrollbar">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fas fa-desktop w-5 text-center"></i>
                            <span class="text-sm">Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.siswas.index') }}"
                            class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.siswas.*') ? 'active' : '' }}">
                            <i class="fas fa-graduation-cap w-5 text-center"></i>
                            <span class="text-sm">Siswa</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.kepribadian.index') }}"
                            class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.kepribadian.*') ? 'active' : '' }}">
                            <i class="fas fa-walking w-5 text-center"></i>
                            <span class="text-sm">Kepribadian</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pertanyaan.index') }}"
                            class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.pertanyaan.*') ? 'active' : '' }}">
                            <i class="far fa-question-circle w-5 text-center"></i>
                            <span class="text-sm">Pertanyaan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.karir.index') }}"
                            class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.karir.*') ? 'active' : '' }}">
                            <i class="fas fa-briefcase w-5 text-center"></i>
                            <span class="text-sm">Karir</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.aturan.index') }}"
                            class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.aturan.*') ? 'active' : '' }}">
                            <i class="fas fa-sliders-h w-5 text-center"></i>
                            <span class="text-sm">Aturan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tes.index') }}"
                            class="sidebar-link flex items-center gap-4 px-4 py-3 rounded-lg transition {{ request()->routeIs('admin.tes.*') ? 'active' : '' }}">
                            <i class="fas fa-history w-5 text-center"></i>
                            <span class="text-sm">Hasil Tes</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        {{-- ======== MAIN CONTENT ======== --}}
        <div class="flex-1 flex flex-col overflow-hidden">

            {{-- Mobile Top Navbar --}}
            <header class="md:hidden bg-white border-b border-gray-100 p-4 flex items-center justify-between shadow-sm">
                <button id="openSidebar" class="text-[#2E6C9F] p-2 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                {{-- Nama Admin di Mobile --}}
                <div class="text-center">
                    <span class="font-bold text-[#2E6C9F] text-sm block">
                        {{ Auth::guard('admin')->user()->nama ?? 'Sikarir' }}
                    </span>
                </div>
                <div class="w-10"></div>
            </header>

            <main class="flex-1 overflow-y-auto p-4 md:p-8">

                {{-- Header Biru + User Info --}}
                <div
                    class="bg-[#3D78A8] rounded-xl px-4 py-4 md:px-8 md:py-5 mb-6 md:mb-8 shadow-sm flex justify-between items-center text-white relative">
                    <h2 class="text-lg md:text-2xl font-semibold truncate mr-2">@yield('page-title', 'Beranda')</h2>

                    <div class="relative flex-shrink-0">
                        <button id="userDropdownBtn"
                            class="flex items-center gap-2 md:gap-3 hover:bg-white/10 px-3 py-2 rounded-lg transition focus:outline-none">
                            {{-- Nama Admin Langsung Tampil --}}
                            <div class="text-right hidden sm:block">
                                <p class="text-sm font-bold leading-none">
                                    {{ Auth::guard('admin')->user()->nama ?? 'Admin Sikarir' }}</p>
                            </div>
                            {{-- Avatar/Icon untuk Mobile --}}
                            <div class="w-9 h-9 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user-circle text-xl"></i>
                            </div>
                            <i class="fas fa-chevron-down text-[10px] opacity-70"></i>
                        </button>

                        {{-- Dropdown Menu (Hanya Logout) --}}
                        <div id="userDropdownMenu"
                            class="hidden absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-xl border border-gray-100 py-1 z-50 animate__animated animate__fadeIn animate__faster">
                            <form method="POST" action="{{ route('admin.logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center gap-3 transition font-semibold">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Alert --}}
                @if (session('success'))
                    <div
                        class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm flex justify-between items-center animate__animated animate__fadeIn">
                        <span class="text-sm">{{ session('success') }}</span>
                        <button onclick="this.parentElement.remove()" class="text-xl">&times;</button>
                    </div>
                @endif

                {{-- Konten --}}
                <div class="w-full">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Logika Dropdown User
        const userBtn = document.getElementById('userDropdownBtn');
        const userMenu = document.getElementById('userDropdownMenu');

        userBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            userMenu.classList.toggle('hidden');
        });

        // Logika Sidebar Responsif
        const sidebar = document.getElementById('sidebar');
        const openSidebar = document.getElementById('openSidebar');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('sidebarOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('closed');
            overlay.classList.toggle('hidden');
        }

        openSidebar.addEventListener('click', toggleSidebar);
        closeSidebar.addEventListener('click', toggleSidebar);
        overlay.addEventListener('click', toggleSidebar);

        // Klik di luar untuk menutup semua menu
        window.addEventListener('click', () => {
            if (!userMenu.classList.contains('hidden')) {
                userMenu.classList.add('hidden');
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
