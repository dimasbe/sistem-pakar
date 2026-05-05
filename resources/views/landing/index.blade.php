@extends('layouts.landing')

@section('title', 'Landing - Sikarir')

@section('content')

    {{-- ================= HERO ================= --}}
    <section
        class="bg-white px-6 md:px-20 lg:px-32 py-10 md:py-16 flex flex-col md:flex-row items-center justify-center md:justify-between min-h-[calc(100vh-80px)]">

        {{-- Container Gambar (Muncul di atas pada Mobile) --}}
        <div class="w-full md:w-1/2 flex justify-center order-1 md:order-2">
            <div class="relative">
                <img src="{{ asset('images/hero.png') }}" alt="Siswa"
                    class="relative z-10 w-56 sm:w-64 md:w-[450px] h-auto object-contain">
            </div>
        </div>

        {{-- Container Teks (Muncul di bawah pada Mobile) --}}
        <div class="w-full md:w-1/2 text-center md:text-left order-2 md:order-1 mt-8 md:mt-0">
            <h1 class="text-[#2E6C9F] text-2xl sm:text-3xl lg:text-4xl font-bold leading-tight">
                SELAMAT DATANG<br>
                <div class="mt-2 md:mt-0">
                    DI <span
                        class="inline-block bg-[#2E6C9F] text-white px-4 py-1 rounded-xl font-bold shadow-sm tracking-wide">
                        Sikarir
                    </span>
                </div>
            </h1>

            <p class="mt-4 md:mt-6 text-gray-600 max-w-md mx-auto md:mx-0 text-sm md:text-base leading-relaxed">
                Sebuah platform untuk identifikasi kepribadian dan perencanaan karir siswa
            </p>

            <div class="mt-8 md:mt-10">
                <a href="{{ route('siswa.register') }}"
                    class="inline-flex items-center justify-center gap-2 
                bg-[#2E6C9F] text-white px-8 py-3.5 rounded-full
                font-semibold hover:bg-[#255A86] transition shadow-lg text-sm md:text-base">
                    Mulai Tes Sekarang !
                </a>
            </div>
        </div>

    </section>

    {{-- ================= TENTANG SISTEM ================= --}}
    <section class="bg-[#F8FAFC] overflow-x-hidden">

        <div class="bg-white border-y border-gray-100">
            <div class="max-w-7xl mx-auto px-6 md:px-12 py-12 md:py-20 text-center">
                <span
                    class="inline-block px-4 py-1.5 mb-4 text-[10px] md:text-xs font-bold tracking-widest text-[#2E6C9F] uppercase bg-blue-50 rounded-full">
                    Mengenal Lebih Dekat
                </span>

                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6 tracking-tight leading-tight">
                    Tentang Sistem
                    <br class="md:hidden">
                    <span class="text-[#2E6C9F] whitespace-nowrap">Sikarir</span>
                </h1>

                <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed px-2">
                    Solusi cerdas berbasis sistem pakar untuk membantu siswa SMA mengidentifikasi potensi diri dan merancang
                    masa depan dengan data yang akurat.
                </p>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 md:px-12 py-10 md:py-16">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 mb-16 md:mb-24">

                <div class="md:col-span-7 bg-white p-8 md:p-12 rounded-[2rem] shadow-sm border border-gray-100">
                    <div
                        class="w-12 h-12 bg-[#2E6C9F] rounded-xl flex items-center justify-center mb-6 text-[#2E6C9F] mx-auto md:mx-0">
                        <img src="{{ asset('images/logo2.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                    </div>

                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 md:mb-6 text-center md:text-left">
                        Apa itu Sikarir?
                    </h2>

                    <p class="text-gray-600 leading-relaxed text-sm md:text-lg text-justify">
                        Sikarir adalah sistem pakar berbasis web yang mengadopsi pendekatan kecerdasan buatan untuk
                        menganalisis kepribadian siswa. Sistem ini bertujuan memberikan gambaran kepribadian serta
                        perencanaan karir yang relevan berdasarkan hasil analisis tersebut.
                    </p>
                </div>

                <div
                    class="md:col-span-5 bg-[#2E6C9F] p-8 md:p-12 rounded-[2rem] text-white shadow-xl shadow-blue-900/10 flex flex-col justify-center">

                    <h3 class="text-xl md:text-2xl font-bold mb-6 md:mb-8 text-white text-center md:text-left">
                        Tujuan Utama
                    </h3>

                    <div class="flex flex-col items-center md:items-start">
                        <ul class="space-y-4 md:space-y-5 text-left">
                            @php
                                $tujuan = [
                                    'Mengenali tipe kepribadian diri.',
                                    'Rekomendasi karir yang presisi.',
                                    'Dukungan keputusan objektif.',
                                    'Meminimalisir salah jurusan.',
                                ];
                            @endphp

                            @foreach ($tujuan as $item)
                                <li class="flex items-start gap-3 md:gap-4">
                                    <span class="bg-white/20 p-1.5 rounded-lg mt-0.5 flex-shrink-0">
                                        <i class="fas fa-check text-[10px]"></i>
                                    </span>
                                    <p class="font-medium text-sm md:text-base leading-snug">{{ $item }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIASEC --}}
        <div class="mb-16 md:mb-24">

            <div class="text-center mb-10 md:mb-16">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-4 tracking-tight">
                    Tentang RIASEC
                </h2>

                <p class="text-gray-500 max-w-2xl mx-auto text-sm md:text-lg px-4">
                    Kami menggunakan standar Teori Holland yang membagi kepribadian menjadi 6 spektrum utama untuk
                    akurasi hasil maksimal.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6 px-6 sm:px-9 lg:px-12">
                @php
                    $types = [
                        [
                            'Realistic',
                            'fa-tools',
                            'Menyukai pekerjaan yang bersifat praktis dan fisik, seperti membuat, merakit, serta memperbaiki sesuatu dengan menggunakan alat atau mesin, terutama di lingkungan kerja lapangan.',
                        ],
                        [
                            'Investigative',
                            'fa-microscope',
                            'Menyukai pekerjaan yang menuntut kemampuan analitis dan ilmiah, seperti meneliti, mengamati, bereksperimen, serta memecahkan masalah secara logis dan sistematis.',
                        ],
                        [
                            'Artistic',
                            'fa-palette',
                            'Menyukai pekerjaan yang bersifat kreatif dan ekspresif, seperti berkarya melalui seni, musik, tulisan, atau desain dalam lingkungan yang fleksibel.',
                        ],
                        [
                            'Social',
                            'fa-hands-helping',
                            'Menyukai pekerjaan yang melibatkan interaksi sosial, seperti mengajar, melatih, membantu, merawat, dan memberikan pelayanan kepada orang lain.',
                        ],
                        [
                            'Enterprising',
                            'fa-chart-line',
                            'Menyukai pekerjaan yang berkaitan dengan kepemimpinan, persuasi, dan kegiatan bisnis, serta melibatkan pengaruh dan pengambilan keputusan.',
                        ],
                        [
                            'Conventional',
                            'fa-file-invoice',
                            'Menyukai pekerjaan yang terstruktur dan terorganisir, terutama yang berkaitan dengan administrasi, pengolahan data, angka, dan ketelitian.',
                        ],
                    ];
                @endphp

                @foreach ($types as $type)
                    <div
                        class="group bg-white p-6 md:p-10 rounded-3xl border border-gray-100 hover:border-[#2E6C9F]/30 hover:shadow-xl hover:shadow-blue-500/5 transition-all duration-300 text-center md:text-left">

                        <div
                            class="w-12 h-12 md:w-14 md:h-14 bg-blue-50 text-[#2E6C9F] rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform mx-auto md:mx-0">
                            <i class="fas {{ $type[1] }} text-xl md:text-2xl"></i>
                        </div>

                        <h3 class="text-lg md:text-xl font-bold text-gray-800 mb-3">
                            {{ $type[0] }}
                        </h3>

                        <p class="text-gray-500 text-xs md:text-sm leading-relaxed">
                            {{ $type[2] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </section>

@endsection
