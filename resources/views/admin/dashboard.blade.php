@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Beranda')

@section('content')

    <style>
        @media (max-width: 640px) {
            .grid.md\:grid-cols-3 {
                gap: 0.5rem !important;
            }

            .grid.md\:grid-cols-3>div {
                padding: 1rem 0.5rem !important;
            }

            .grid.md\:grid-cols-3 h3 {
                font-size: 1.8rem !important;
            }

            .grid.md\:grid-cols-3 p {
                font-size: 10px !important;
            }

            .grid.lg\:grid-cols-2 {
                grid-template-columns: 1fr !important;
            }

            .bg-white.rounded-lg.p-6 {
                padding: 1rem !important;
            }

            .grid.md\:grid-cols-2 {
                grid-template-columns: 1fr !important;
                gap: 0.75rem !important;
            }
        }
    </style>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-5 mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 text-center">
            <p class="text-[#2E6C9F] font-semibold text-sm mb-1">Total Siswa</p>
            <h3 class="text-5xl font-bold text-[#2E6C9F]">{{ $totalSiswa }}</h3>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 text-center">
            <p class="text-[#2E6C9F] font-semibold text-sm mb-1">Total Pertanyaan</p>
            <h3 class="text-5xl font-bold text-[#2E6C9F]">{{ $totalPertanyaan }}</h3>
        </div>

        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 text-center">
            <p class="text-[#2E6C9F] font-semibold text-sm mb-1">Total Kepribadian</p>
            <h3 class="text-5xl font-bold text-[#2E6C9F]">{{ $totalKepribadian }}</h3>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-[#2E6C9F] font-bold text-base uppercase tracking-wider">Statistik Hasil Tertinggi</h2>
        </div>

        @if (isset($kepribadianStats) && $kepribadianStats->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-6">
                @foreach ($kepribadianStats as $stat)
                    @php
                        $skalaMaksimal = 70;
                        $percentage = ($stat->total / $skalaMaksimal) * 100;
                        if ($percentage > 100) {
                            $percentage = 100;
                        }
                    @endphp

                    <div class="relative">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-bold text-gray-700">{{ $stat->nama_kepribadian }}</span>
                            <span class="text-sm font-black text-[#2E6C9F]">{{ $stat->total }} <span
                                    class="text-[10px] font-normal text-gray-400">Siswa</span></span>
                        </div>

                        <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden shadow-inner">
                            <div class="bg-[#2E6C9F] h-full rounded-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(46,108,159,0.3)]"
                                style="width: {{ $percentage }}%">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                <i class="fas fa-chart-pie text-4xl mb-3 opacity-20"></i>
                <p class="text-sm">Data sebaran belum tersedia.</p>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
        <div
            class="bg-white rounded-lg p-5 border border-gray-100 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
            <div class="bg-blue-50 p-4 rounded-xl">
                <i class="fas fa-briefcase text-[#2E6C9F] text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-tighter">Total Karir</p>
                <p class="text-2xl font-black text-gray-800">{{ $totalKarir }}</p>
            </div>
        </div>

        <div
            class="bg-white rounded-lg p-5 border border-gray-100 flex items-center gap-4 shadow-sm hover:shadow-md transition-shadow">
            <div class="bg-green-50 p-4 rounded-xl">
                <i class="fas fa-check-double text-green-600 text-xl"></i>
            </div>
            <div>
                <p class="text-gray-500 text-xs font-medium uppercase tracking-tighter">Aktivitas Tes Selesai</p>
                <p class="text-2xl font-black text-gray-800">{{ $totalTes }}</p>
            </div>
        </div>
    </div>

@endsection
