@extends('layouts.siswa')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">

        <div class="text-white pb-2 px-2 md:px-0 flex items-baseline gap-2">
            @php
                date_default_timezone_set('Asia/Jakarta');
                $hour = date('H');
                if ($hour >= 5 && $hour <= 10) {
                    $greeting = 'Selamat Pagi';
                } elseif ($hour >= 11 && $hour <= 14) {
                    $greeting = 'Selamat Siang';
                } elseif ($hour >= 15 && $hour <= 18) {
                    $greeting = 'Selamat Sore';
                } else {
                    $greeting = 'Selamat Malam';
                }

                $namaLengkap = Auth::guard('siswa')->user()->nama_lengkap;
                $namaDepan = strtok(trim($namaLengkap), ' ');

                $highestResult = App\Models\Tes::where('id_siswa', Auth::guard('siswa')->id())
                    ->with('kepribadian')
                    ->orderBy('nilai_cf_total', 'desc')
                    ->first();

                $nilaiCFHighest = $highestResult ? $highestResult->nilai_cf_total : 0;
                $persentaseEksakHighest = max(0, min(100, $nilaiCFHighest * 100));
                $persentaseTeksHighest = number_format($persentaseEksakHighest, 2);
                $strokeDash = round($persentaseEksakHighest);

                $isLastResultZero = $lastResult && $lastResult->nilai_cf_total <= 0;
            @endphp

            <p class="text-md opacity-80 font-medium">{{ $greeting }},</p>
            <h1 class="text-lg font-bold">{{ $namaDepan }}</h1>
        </div>

        <div
            class="bg-white rounded-[35px] shadow-xl shadow-gray-200/50 p-6 md:p-10 flex flex-col lg:flex-row items-center justify-between min-h-fit lg:min-h-[480px] gap-10">

            <div class="w-full lg:w-1/3 space-y-6 order-2 lg:order-1">
                <div
                    class="bg-[#2E6C9F] rounded-2xl p-8 text-white shadow-lg transition-transform hover:scale-105 border border-white/10 text-center">
                    <p class="text-[10px] uppercase tracking-[0.2em] opacity-70 mb-2 font-bold">Total Tes Dilakukan</p>
                    <h3 class="text-7xl font-bold">{{ $totalTes }}</h3>
                </div>

                <div
                    class="bg-[#2E6C9F] rounded-2xl p-8 text-white shadow-lg transition-transform hover:scale-105 border border-white/10 text-center">
                    <p class="text-[10px] uppercase tracking-[0.2em] opacity-70 mb-2 font-bold">Hasil Tertinggi</p>
                    <h3 class="text-3xl font-black italic tracking-tighter uppercase leading-tight">
                        @if ($highestResult && $highestResult->nilai_cf_total > 0 && $highestResult->kepribadian)
                            {{ $highestResult->kepribadian->nama_kepribadian }}
                        @else
                            -
                        @endif
                    </h3>
                </div>
            </div>

            <div class="w-full lg:w-1/2 flex flex-col items-center justify-center relative order-1 lg:order-2">
                <div class="relative w-64 h-64 md:w-80 md:h-80">
                    <svg viewBox="0 0 36 36" class="w-full h-full transform -rotate-90">
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                            fill="none" stroke="#f1f5f9" stroke-width="2.5" />
                        <path d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"
                            fill="none" stroke="#2E6C9F" stroke-width="2.5" stroke-linecap="round"
                            stroke-dasharray="{{ $strokeDash }}, 100" class="transition-all duration-1000 ease-out" />
                    </svg>

                    <div class="absolute inset-0 flex flex-col items-center justify-center pt-6 text-center">
                        <span class="text-5xl md:text-6xl font-black text-[#2E6C9F] tracking-tighter">
                            {{ $nilaiCFHighest > 0 ? $persentaseTeksHighest . '%' : '-' }}
                        </span>
                        <span class="text-[10px] uppercase tracking-[0.3em] text-gray-400 font-bold">Skor</span>
                    </div>
                </div>

                <div class="mt-8">
                    <a href="{{ route('siswa.tes.intro') }}"
                        class="inline-flex items-center gap-2 bg-[#2E6C9F] text-white px-8 py-3 rounded-full font-bold shadow-lg hover:bg-[#1e4e75] transition-all transform hover:translate-y-[-2px]">
                        <i class="fas fa-play-circle text-xl"></i>
                        <span>{{ $lastResult ? 'Mulai Tes Ulang' : 'Mulai Tes Sekarang' }}</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-[30px] shadow-lg p-6 md:p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-bold text-gray-800">Tes Terakhir</h2>
                <a href="{{ route('siswa.tes.riwayat') }}"
                    class="text-[#2E6C9F] text-sm font-bold hover:underline flex items-center gap-1">
                    Lihat Semua <i class="fas fa-chevron-right text-[10px]"></i>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-400 text-[10px] uppercase tracking-[0.2em] border-b border-gray-100">
                            <th class="pb-4 font-bold">Waktu Tes</th>
                            <th class="pb-4 font-bold">Hasil Tertinggi</th>
                            <th class="pb-4 font-bold text-right">Skor</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @if ($lastResult)
                            @php
                                $persentaseLast = max(0, min(100, $lastResult->nilai_cf_total * 100));
                            @endphp
                            <tr class="group">
                                <td class="py-5 text-[10px] md:text-sm text-gray-600 font-medium leading-tight">
                                    <span
                                        class="block md:inline">{{ $lastResult->created_at->translatedFormat('d F Y') }}</span>
                                    <span class="text-gray-400 text-[9px] md:text-xs md:ml-1">
                                        <span class="hidden md:inline">•</span>
                                        {{ $lastResult->created_at->format('H:i') }}
                                        WIB
                                    </span>
                                </td>
                                <td class="py-5">
                                    <span
                                        class="text-[10px] md:text-sm font-bold text-gray-800 uppercase tracking-tight line-clamp-1">
                                        @if ($isLastResultZero)
                                            -
                                        @else
                                            {{ $lastResult->kepribadian->nama_kepribadian ?? 'Tidak Teridentifikasi' }}
                                        @endif
                                    </span>
                                </td>
                                <td class="py-5 text-right">
                                    <div class="flex items-center justify-end gap-2 md:gap-3">
                                        @if (!$isLastResultZero)
                                            <div
                                                class="w-20 bg-gray-100 h-1.5 rounded-full overflow-hidden hidden lg:block">
                                                <div class="bg-[#2E6C9F] h-full" style="width: {{ $persentaseLast }}%">
                                                </div>
                                            </div>
                                            <span
                                                class="text-[10px] md:text-sm font-black text-[#2E6C9F] whitespace-nowrap">
                                                {{ number_format($persentaseLast, 2) }}%
                                            </span>
                                        @else
                                            <span class="text-[10px] md:text-sm font-black text-gray-400">-</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td colspan="3" class="py-10 text-center text-gray-400 italic text-sm">
                                    Belum ada riwayat tes.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
