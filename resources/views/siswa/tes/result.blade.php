@extends('layouts.siswa')

@section('title', 'Hasil Tes')
@section('page-title', 'Hasil Analisis')

@section('content')
    <div class="max-w-5xl mx-auto space-y-8 pb-12">

        @if (session('success'))
            <div
                class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in">
                <div class="bg-emerald-500 text-white p-1.5 rounded-full text-xs">
                    <i class="fas fa-check"></i>
                </div>
                <span class="text-emerald-800 font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div
                class="bg-amber-50 border-l-4 border-amber-500 p-4 rounded-xl flex items-center gap-3 shadow-sm animate-fade-in">
                <div class="bg-amber-500 text-white p-1.5 rounded-full text-xs">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <span class="text-amber-800 font-medium">{{ session('error') }}</span>
            </div>
        @endif

        {{-- CEK APAKAH TIDAK TERANALISIS --}}
        @if ($tes->nilai_cf_total <= 0 || !$tes->id_kepribadian)
            <div
                class="relative overflow-hidden bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-gray-100 p-8 md:p-12 text-center space-y-6">
                <div class="w-24 h-24 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-5xl"></i>
                </div>
                <h1 class="text-2xl md:text-3xl font-black text-gray-900">Hasil Tidak Teranalisis</h1>
                <p class="text-gray-500 max-w-2xl mx-auto text-base md:text-lg leading-relaxed">
                    Sistem tidak dapat menganalisis kepribadian Anda karena tidak ada kecenderungan yang terdeteksi.
                </p>
                <p class="text-gray-400 text-sm max-w-md mx-auto">
                    Silakan ulangi tes dengan menjawab <strong class="text-[#2E6C9F]">jujur dan bervariasi</strong>
                    sesuai dengan kondisi diri Anda yang sebenarnya.
                </p>
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-amber-50 text-amber-700 text-xs font-bold uppercase tracking-widest">
                    <i class="fas fa-info-circle"></i> Status: Tidak Teranalisis
                </div>
                <div class="pt-4">
                    <a href="{{ route('siswa.tes.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-[#2E6C9F] text-white rounded-xl font-bold text-sm hover:bg-[#1E5A8E] transition shadow-md">
                        <i class="fas fa-redo-alt"></i>
                        <span>Coba Ulangi Tes</span>
                    </a>
                </div>
            </div>
        @else
            {{-- TAMPILAN NORMAL (TERANALISIS) --}}
            {{-- Hitung top 3 di awal agar bisa dipakai di seluruh view --}}
            @php
                $top3Kepribadian = $hasilKepribadian->take(3);
                $kodeKombinasi = $top3Kepribadian->pluck('kode_kepribadian')->implode('');
            @endphp

            @if ($kepribadianDominan)
                <div
                    class="relative overflow-hidden bg-white rounded-[2.5rem] shadow-2xl shadow-gray-200/50 border border-gray-100">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-blue-50 rounded-full -mr-20 -mt-20 opacity-50"></div>
                    <div class="absolute bottom-0 left-0 w-40 h-40 bg-indigo-50 rounded-full -ml-10 -mb-10 opacity-50">
                    </div>

                    <div class="relative p-8 md:p-12">
                        <div class="flex flex-col md:flex-row items-center gap-10">

                            {{-- Avatar: tampilan kode kombinasi --}}
                            <div class="relative flex-shrink-0">
                                <div class="relative group">
                                    <div
                                        class="absolute inset-0 bg-gradient-to-br from-[#2E6C9F] to-[#1E5A8E] rounded-3xl blur-xl opacity-30 group-hover:opacity-50 transition-opacity duration-500">
                                    </div>

                                    <div
                                        class="relative w-40 h-40 md:w-52 md:h-52 bg-gradient-to-br from-[#2E6C9F] to-[#1E5A8E] rounded-3xl shadow-2xl flex items-center justify-center overflow-hidden">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-r from-transparent via-white/10 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000">
                                        </div>

                                        <div class="absolute top-2 right-2 w-12 h-12 opacity-10">
                                            <div class="absolute w-1 h-1 bg-white rounded-full top-0 right-0"></div>
                                            <div class="absolute w-1 h-1 bg-white rounded-full top-2 right-2"></div>
                                            <div class="absolute w-1 h-1 bg-white rounded-full top-4 right-1"></div>
                                        </div>

                                        <div class="absolute bottom-2 left-2 w-12 h-12 opacity-10">
                                            <div class="absolute w-1 h-1 bg-white rounded-full bottom-0 left-0"></div>
                                            <div class="absolute w-1 h-1 bg-white rounded-full bottom-2 left-2"></div>
                                            <div class="absolute w-1 h-1 bg-white rounded-full bottom-4 left-1"></div>
                                        </div>

                                        <div class="text-center">
                                            <span
                                                class="text-white text-5xl md:text-7xl font-black tracking-tighter drop-shadow-lg">
                                                {{ $kodeKombinasi }}
                                            </span>
                                            <div class="mt-2 flex justify-center gap-1">
                                                @foreach (str_split($kodeKombinasi) as $char)
                                                    <div class="w-1.5 h-1.5 bg-white/50 rounded-full"></div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-1 text-center md:text-left">
                                <div
                                    class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-blue-50 text-[#2E6C9F] text-xs font-black uppercase tracking-widest mb-4">
                                    <i class="fas fa-star text-[10px]"></i> Kepribadian Dominan
                                </div>

                                <p class="text-gray-400 text-sm font-medium mb-5">
                                    {!! $top3Kepribadian->pluck('nama_kepribadian')->implode(' &middot; ') !!}
                                </p>

                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                                    @foreach ($top3Kepribadian as $index => $kep)
                                        @php
                                            $bgStyles = [
                                                0 => 'border-blue-200 hover:border-blue-400',
                                                1 => 'border-indigo-200 hover:border-indigo-400',
                                                2 => 'border-sky-200 hover:border-sky-400',
                                            ];
                                            $style = $bgStyles[$index] ?? 'border-blue-200 hover:border-blue-400';
                                        @endphp

                                        <div
                                            class="group p-4 rounded-2xl border {{ $style }} bg-white hover:shadow-md transition-all duration-300">

                                            <div class="flex items-center gap-3 mb-2">
                                                <div
                                                    class="w-7 h-7 flex items-center justify-center rounded-lg bg-gradient-to-br from-[#2E6C9F] to-[#1E5A8E] text-white font-black text-xs shadow-md">
                                                    {{ $kep->kode_kepribadian }}
                                                </div>

                                                <p class="text-sm font-bold text-gray-800">
                                                    {{ $kep->nama_kepribadian }}
                                                </p>
                                            </div>

                                            <p class="text-gray-500 text-xs leading-relaxed font-medium">
                                                {{ $kep->deskripsi }}
                                            </p>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                                    <div
                                        class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-2 rounded-xl border border-blue-100 flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500">
                                        </div>
                                        <span class="text-xs font-bold text-gray-700 uppercase">Tipe Kombinasi:
                                            <span class="text-[#2E6C9F]">{{ $kodeKombinasi }}</span></span>
                                    </div>
                                    <div
                                        class="bg-emerald-50 px-4 py-2 rounded-xl border border-emerald-100 flex items-center gap-2">
                                        <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                                        <span class="text-xs font-bold text-gray-700 uppercase">Status:
                                            <span class="text-emerald-600">Teranalisis</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- Grid Container --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

                {{-- KOLOM KIRI (Spektrum + Simpan Hasil) --}}
                <div class="lg:col-span-1 space-y-8 order-1">
                    <div class="bg-white p-8 rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100">
                        <h3 class="text-lg font-black text-gray-800 mb-6 flex items-center gap-2">
                            <i class="fas fa-chart-pie text-[#2E6C9F]"></i> Spektrum Skor
                        </h3>
                        <div class="space-y-6">
                            @foreach ($top3Kepribadian as $index => $hasil)
                                @php
                                    $persen = max(0, min(100, $hasil->cf_total * 100));
                                    $barColors = [
                                        0 => 'from-blue-400 to-[#2E6C9F]',
                                        1 => 'from-indigo-300 to-indigo-500',
                                        2 => 'from-sky-300 to-sky-500',
                                    ];
                                    $barColor = $barColors[$index] ?? 'from-blue-400 to-[#2E6C9F]';
                                @endphp
                                <div class="group">
                                    <div class="flex justify-between items-center mb-2">
                                        <div class="flex items-center gap-2">
                                            <span
                                                class="flex-shrink-0 inline-flex items-center justify-center w-5 h-5 rounded-md bg-gradient-to-br from-[#2E6C9F] to-[#1E5A8E] text-white text-[9px] font-black shadow-sm">
                                                {{ $hasil->kode_kepribadian }}
                                            </span>
                                            <span
                                                class="text-[10px] font-black uppercase text-gray-400 group-hover:text-[#2E6C9F] transition-colors tracking-wider">
                                                {{ $hasil->nama_kepribadian }}
                                            </span>
                                        </div>
                                        <span
                                            class="text-sm font-black text-[#2E6C9F]">{{ number_format($persen, 2) }}%</span>
                                    </div>
                                    <div class="w-full bg-gray-100 h-2.5 rounded-full overflow-hidden p-0.5">
                                        <div class="h-full bg-gradient-to-r {{ $barColor }} rounded-full transition-all duration-1000"
                                            style="width: {{ $persen }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div
                        class="bg-gradient-to-br from-[#2E6C9F] to-[#1E5A8E] p-8 rounded-[2rem] shadow-lg text-white relative overflow-hidden group text-center">
                        <i
                            class="fas fa-print absolute -right-4 -bottom-4 text-7xl opacity-10 group-hover:scale-110 transition-transform"></i>
                        <h4 class="font-bold mb-2 relative z-10 text-base md:text-lg">Simpan Hasil</h4>
                        <p class="text-white/70 text-[11px] md:text-xs mb-6 relative z-10 mx-auto max-w-[220px]">
                            Unduh laporan hasil tes kepribadian Anda dalam format PDF.
                        </p>
                        <div class="relative z-10 flex justify-center">
                            <a href="{{ route('siswa.tes.print', $tes->id_tes ?? 0) }}" target="_blank"
                                class="w-fit px-8 py-3 bg-white text-[#2E6C9F] rounded-xl text-center text-[11px] md:text-xs font-black uppercase tracking-widest hover:bg-gray-50 transition shadow-md flex items-center gap-2 group/btn">
                                <i class="fas fa-file-pdf transition-transform group-hover/btn:scale-110"></i>
                                <span>Cetak Hasil</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- KOLOM KANAN - Rekomendasi Karir --}}
                <div class="lg:col-span-2 order-2">
                    <div class="bg-white p-6 md:p-10 rounded-[2.5rem] shadow-xl shadow-gray-200/50 border border-gray-100">
                        <div class="flex items-center justify-between mb-6 md:mb-8">
                            <div>
                                <h3 class="text-xl md:text-2xl font-black text-gray-900">Rekomendasi Karir</h3>
                                <p class="text-gray-400 text-xs md:text-sm font-medium">Berdasarkan 3 kepribadian dominan
                                    Anda</p>
                            </div>
                            <div class="bg-blue-50 p-2.5 md:p-3 rounded-2xl">
                                <i class="fas fa-briefcase text-lg md:text-xl text-[#2E6C9F]"></i>
                            </div>
                        </div>

                        @if ($rekomendasiKarir && $rekomendasiKarir->count() > 0)
                            <div class="space-y-6 md:space-y-8">
                                @foreach ($top3Kepribadian as $index => $kep)
                                    @php
                                        $karirTipe = $rekomendasiKarir->get($kep->id_kepribadian, collect())->take(8);
                                    @endphp
                                    @if ($karirTipe->count() > 0)
                                        <div>
                                            <div class="flex items-center gap-3 mb-4 pb-2 border-b border-gray-100">
                                                <div class="flex items-center gap-2">
                                                    <span
                                                        class="inline-flex items-center justify-center w-7 h-7 rounded-lg bg-gradient-to-br from-[#2E6C9F] to-[#1E5A8E] text-white text-xs font-black shadow-sm">
                                                        {{ $kep->kode_kepribadian }}
                                                    </span>
                                                    <span class="text-sm font-bold text-gray-800">
                                                        {{ $kep->nama_kepribadian }}
                                                    </span>
                                                </div>
                                                <div class="flex-1"></div>
                                                <span
                                                    class="text-[10px] font-bold text-[#2E6C9F] bg-blue-50 px-2 py-0.5 rounded-full">
                                                    {{ number_format($kep->cf_total * 100, 2) }}%
                                                </span>
                                            </div>

                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3 items-stretch">
                                                @foreach ($karirTipe as $karir)
                                                    <div
                                                        class="group bg-gray-50 rounded-xl p-4 hover:bg-white hover:shadow-md transition-all duration-200 border border-transparent hover:border-gray-100 flex flex-col h-full">
                                                        <div class="flex items-start gap-3">
                                                            <div
                                                                class="flex-shrink-0 w-8 h-8 rounded-lg bg-white shadow-sm flex items-center justify-center text-[#2E6C9F] group-hover:bg-gradient-to-br group-hover:from-[#2E6C9F] group-hover:to-[#1E5A8E] group-hover:text-white transition-all duration-200">
                                                                <i class="fas fa-briefcase text-xs"></i>
                                                            </div>

                                                            <div class="flex-1 min-w-0">
                                                                <h4
                                                                    class="font-bold text-gray-800 text-sm mb-1 group-hover:text-[#2E6C9F] transition-colors">
                                                                    {{ $karir->nama_karir }}
                                                                </h4>
                                                                <p class="text-gray-500 text-xs leading-relaxed">
                                                                    {{ $karir->deskripsi_karir }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        @if (!$loop->last)
                                            <div class="border-t border-gray-100 my-4"></div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <div class="py-10 text-center text-gray-400 italic">Belum ada rekomendasi.</div>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Footer Actions --}}
        @if ($tes->nilai_cf_total > 0 && $tes->id_kepribadian)
            <div class="flex flex-col items-center justify-center pt-4">
                <a href="{{ route('siswa.tes.create') }}"
                    class="w-fit sm:w-auto px-6 py-3.5 md:px-10 md:py-4 bg-gradient-to-r from-[#2E6C9F] to-[#1E5A8E] text-white rounded-2xl text-center font-black uppercase text-[10px] md:text-xs tracking-widest hover:shadow-xl transition-all shadow-lg flex items-center justify-center gap-3">
                    <i class="fas fa-redo-alt text-xs"></i>
                    <span>Ulangi Tes</span>
                </a>
            </div>
        @endif
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.5s ease-out forwards;
        }

        /* Line clamp untuk truncate text */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Mobile specific improvements */
        @media (max-width: 640px) {
            .rounded-\[2\.5rem\] {
                border-radius: 1.5rem;
            }

            .p-6 {
                padding: 1.25rem;
            }

            .gap-3 {
                gap: 0.75rem;
            }

            .p-4 {
                padding: 0.875rem;
            }

            .text-sm {
                font-size: 0.8125rem;
            }

            .text-xs {
                font-size: 0.6875rem;
            }
        }
    </style>
@endsection
