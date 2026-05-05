<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Tes Kepribadian') - Sikarir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-100">

    {{-- Header --}}
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logo1.png') }}" alt="Logo" class="h-8 w-auto">
                    <div>
                        <span class="text-lg font-bold text-[#2E6C9F]">Sikarir</span>
                        <span class="block text-xs text-gray-500">TES RIASEC</span>
                    </div>
                </div>

                {{-- User Info --}}
                <div class="flex items-center gap-3">
                    <div class="text-right hidden sm:block">
                        <p class="text-sm font-semibold text-gray-800">{{ Auth::guard('siswa')->user()->nama_lengkap }}
                        </p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::guard('siswa')->user()->nama_lengkap) }}&background=2E6C9F&color=fff"
                        alt="Avatar" class="w-10 h-10 rounded-full border-2 border-[#2E6C9F]">
                </div>
            </div>
        </div>
    </header>

    {{-- Alert Messages --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        @if (session('success'))
            <div
                class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg">
                <div class="flex items-center gap-2 mb-2">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span class="font-semibold">Terdapat kesalahan:</span>
                </div>
                <ul class="list-disc list-inside ml-6">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    {{-- Main Content --}}
    <main class="py-1">
        @yield('content')
    </main>

    @include('partials.footer')

    @stack('scripts')
</body>

</html>
