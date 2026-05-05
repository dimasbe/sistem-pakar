<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Sikarir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            overflow-x: hidden;
        }

        .header-bg {
            background-image: url("{{ asset('images/bg-dashboard.png') }}");
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 200px;
            position: absolute;
            top: 0;
            left: 0;
            z-index: -1;
        }

        /* SIDEBAR MOBILE */
        @media (max-width: 1024px) {
            #sidebarPanel {
                position: fixed !important;
                top: 0;
                bottom: 0;
                left: -100%;
                width: 280px;
                background: white;
                z-index: 10000 !important;
                transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                margin: 0 !important;
                border-radius: 0 30px 30px 0 !important;
                box-shadow: 20px 0 50px rgba(0, 0, 0, 0.1);
            }

            #sidebarPanel.active {
                left: 0;
            }

            #sidebarOverlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0, 0, 0, 0.5);
                backdrop-filter: blur(8px);
                z-index: 9999 !important;
            }

            #sidebarOverlay.active {
                display: block;
            }
        }

        /* DESKTOP: Sidebar Melayang & Mentok Bawah */
        @media (min-width: 1024px) {
            #sidebarPanel {
                height: calc(100vh - 1rem);
                position: sticky;
                top: 1rem;
            }
        }
    </style>
</head>

<body class="antialiased">
    <div class="header-bg"></div>

    <div id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div class="flex items-start">
        <aside id="sidebarPanel"
            class="w-72 bg-white shadow-2xl lg:rounded-t-[30px] flex flex-col shrink-0 lg:mt-4 lg:ml-10 overflow-hidden">
            <div class="p-8 text-center border-b border-gray-50 relative">
                <button type="button" onclick="toggleSidebar()"
                    class="lg:hidden absolute top-4 right-4 text-gray-400 p-2">
                    <i class="fas fa-times text-2xl"></i>
                </button>

                <div class="w-24 h-24 rounded-full border-2 border-dashed border-blue-400 p-1.5 mx-auto mb-4">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('siswa')->user()->nama_lengkap) }}&background=2E6C9F&color=fff"
                        class="w-full h-full rounded-full object-cover">
                </div>
                <h2 class="text-blue-600 font-bold text-sm uppercase">{{ Auth::guard('siswa')->user()->nama_lengkap }}
                </h2>
                <p class="text-gray-400 text-xs mt-1">Siswa</p>
            </div>

            <nav class="p-4 py-6 flex-1 overflow-y-auto">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('siswa.dashboard') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-xl {{ request()->routeIs('siswa.dashboard') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                            <i class="fas fa-desktop w-5"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.tes.intro') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-xl {{ request()->routeIs('siswa.tes.*') && !request()->routeIs('siswa.tes.riwayat') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                            <i class="fas fa-clipboard-list w-5"></i>
                            <span class="text-sm">Mulai Tes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('siswa.tes.riwayat') }}"
                            class="flex items-center gap-4 px-5 py-3 rounded-xl {{ request()->routeIs('siswa.tes.riwayat') ? 'bg-blue-50 text-blue-600 font-semibold' : 'text-gray-500 hover:bg-gray-50' }}">
                            <i class="fas fa-history w-5"></i>
                            <span class="text-sm">Riwayat Tes</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 min-h-screen flex flex-col min-w-0">
            <header class="w-full px-6 md:px-10 py-6 flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <button type="button" onclick="toggleSidebar()"
                        class="lg:hidden text-white text-2xl p-2 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="text-white font-bold text-lg md:text-2xl uppercase tracking-widest leading-none">
                        @yield('title')
                    </h1>
                </div>

                <div class="flex items-center">
                    <a href="{{ route('siswa.logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="text-white flex items-center gap-2 hover:opacity-80 transition-all">
                        <i class="fas fa-sign-out-alt"></i>
                        <span class="text-xs font-medium hidden md:inline">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('siswa.logout') }}" method="POST" class="hidden">@csrf
                    </form>
                </div>
            </header>

            <main class="flex-1 px-4 md:px-10 pb-10">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebarPanel');
            const overlay = document.getElementById('sidebarOverlay');

            sidebar.classList.toggle('active');
            overlay.classList.toggle('active');

            if (sidebar.classList.contains('active')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        }
    </script>
</body>

</html>
