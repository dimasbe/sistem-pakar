@extends('layouts.siswa')

@section('title', 'Mulai Tes')
@section('page-title', 'Tes Kepribadian')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-8">

        {{-- Main Container --}}
        <div class="bg-white rounded-[2rem] shadow-2xl shadow-gray-200/50 overflow-hidden border border-gray-100">

            {{-- Header Section dengan Design Lebih Modern --}}
            <div class="relative bg-[#2E6C9F] p-8 md:p-12 text-center overflow-hidden">
                {{-- Dekorasi Abstrak --}}
                <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -mr-16 -mt-16"></div>
                <div class="absolute bottom-0 left-0 w-24 h-24 bg-black/10 rounded-full -ml-12 -mb-12"></div>

                <div class="relative z-10">
                    <div
                        class="inline-flex items-center justify-center w-20 h-20 bg-white/20 backdrop-blur-md rounded-2xl mb-6 shadow-xl border border-white/30">
                        <i class="fas fa-rocket text-3xl text-white"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white mb-3 tracking-tight">
                        Siap Mengenal Dirimu?
                    </h1>
                    <p class="text-blue-100 text-lg max-w-md mx-auto leading-relaxed opacity-90">
                        Temukan potensi tersembunyi dan rekomendasi karir yang paling presisi untuk masa depanmu.
                    </p>
                </div>
            </div>

            <div class="p-8 md:p-12">
                {{-- Quote/Highlight Section --}}
                <div class="flex items-start gap-4 p-5 bg-amber-50 rounded-2xl border border-amber-100 mb-10">
                    <div class="bg-amber-100 p-2 rounded-lg flex-shrink-0">
                        <i class="fas fa-lightbulb text-amber-600 text-xl"></i>
                    </div>
                    <div>
                        <h4 class="text-amber-900 font-bold text-sm uppercase tracking-wider mb-1">Tips Akurasi</h4>
                        <p class="text-amber-800/80 text-sm leading-relaxed">
                            Kunci hasil yang akurat adalah <strong>Kejujuran</strong>. Jawablah berdasarkan kondisi dirimu
                            saat ini, bukan kondisi ideal yang kamu bayangkan.
                        </p>
                    </div>
                </div>

                {{-- Stepper Instruction --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                    <div class="text-center group">
                        <div
                            class="w-12 h-12 bg-gray-50 text-[#2E6C9F] rounded-full flex items-center justify-center mx-auto mb-4 font-black text-xl border-2 border-gray-100 group-hover:bg-[#2E6C9F] group-hover:text-white transition-all duration-300">
                            1</div>
                        <h5 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Skala 1-5</h5>
                        <p class="text-xs text-gray-500 leading-relaxed px-2">Pilih tingkat kecocokan dari Tidak Sesuai
                            hingga Sangat Sesuai.</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-12 h-12 bg-gray-50 text-[#2E6C9F] rounded-full flex items-center justify-center mx-auto mb-4 font-black text-xl border-2 border-gray-100 group-hover:bg-[#2E6C9F] group-hover:text-white transition-all duration-300">
                            2</div>
                        <h5 class="font-bold text-gray-800 mb-2 text-sm md:text-base">{{ $totalPertanyaan }} Soal</h5>
                        <p class="text-xs text-gray-500 leading-relaxed px-2">Pastikan semua poin pernyataan terisi tanpa
                            ada
                            yang terlewat.</p>
                    </div>

                    <div class="text-center group">
                        <div
                            class="w-12 h-12 bg-gray-50 text-[#2E6C9F] rounded-full flex items-center justify-center mx-auto mb-4 font-black text-xl border-2 border-gray-100 group-hover:bg-[#2E6C9F] group-hover:text-white transition-all duration-300">
                            3</div>
                        <h5 class="font-bold text-gray-800 mb-2 text-sm md:text-base">Lihat Hasil</h5>
                        <p class="text-xs text-gray-500 leading-relaxed px-2">Klik tombol selesai dan sistem akan
                            menganalisis
                            kepribadianmu.</p>
                    </div>
                </div>

                {{-- Button Group --}}
                <div class="flex flex-col items-center px-4 w-full">
                    <a href="{{ route('siswa.tes.create') }}"
                        class="w-full md:w-auto inline-flex items-center justify-center gap-2 bg-[#2E6C9F] text-white px-8 md:px-10 py-4 rounded-full font-bold shadow-lg hover:bg-[#1e4e75] transition-all transform hover:translate-y-[-2px] active:scale-[0.98]">
                        <i class="fas fa-play-circle text-xl"></i>
                        <span class="text-base md:text-lg whitespace-nowrap">Mulai Tes Sekarang</span>
                    </a>
                </div>
            </div>

            {{-- Footer Info --}}
            <div class="bg-gray-50 p-6 text-center border-t border-gray-100">
                <div
                    class="flex flex-col md:flex-row items-center justify-center gap-4 md:gap-6 text-gray-400 text-xs font-medium">
                    <span class="flex items-center gap-2">
                        <i class="far fa-clock"></i> Estimasi 10 Menit
                    </span>
                    <span class="flex items-center gap-2">
                        <i class="far fa-check-circle"></i> Hasil Instan
                    </span>
                </div>
            </div>
        </div>
    </div>

    {{-- Tambahan CSS untuk mobile --}}
    <style>
        /* Mobile specific improvements */
        @media (max-width: 640px) {
            .max-w-3xl {
                padding-left: 1rem;
                padding-right: 1rem;
            }

            .rounded-[2rem] {
                border-radius: 1.5rem;
            }

            .p-8 {
                padding: 1.5rem;
            }

            .p-5 {
                padding: 1rem;
            }

            .gap-4 {
                gap: 0.75rem;
            }

            .text-3xl {
                font-size: 1.75rem;
            }

            .text-lg {
                font-size: 1rem;
            }

            .w-20.h-20 {
                width: 4rem;
                height: 4rem;
            }

            .w-20.h-20 i {
                font-size: 1.5rem;
            }

            .w-12.h-12 {
                width: 2.75rem;
                height: 2.75rem;
                font-size: 1.125rem;
            }

            .gap-6 {
                gap: 1.25rem;
            }

            .px-2 {
                padding-left: 0.5rem;
                padding-right: 0.5rem;
            }

            .text-xs {
                font-size: 0.7rem;
            }

            .py-4 {
                padding-top: 0.875rem;
                padding-bottom: 0.875rem;
            }

            .px-8 {
                padding-left: 1.25rem;
                padding-right: 1.25rem;
            }
        }

        @media (max-width: 480px) {
            .p-8 {
                padding: 1.25rem;
            }

            .grid-cols-1 {
                gap: 1.5rem;
            }

            .text-3xl {
                font-size: 1.5rem;
            }

            .w-20.h-20 {
                width: 3.5rem;
                height: 3.5rem;
            }

            .mb-6 {
                margin-bottom: 1rem;
            }

            .mb-10 {
                margin-bottom: 1.5rem;
            }

            .mb-12 {
                margin-bottom: 1.5rem;
            }

            .whitespace-nowrap {
                white-space: normal;
                text-align: center;
            }

            .gap-2 {
                gap: 0.5rem;
            }

            .text-base {
                font-size: 0.875rem;
            }

            .text-xl {
                font-size: 1.125rem;
            }
        }
    </style>
@endsection
