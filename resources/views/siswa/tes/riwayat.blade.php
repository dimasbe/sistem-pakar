@extends('layouts.siswa')

@section('title', 'Riwayat Tes')
@section('page-title', 'Riwayat Tes')

@section('content')
    <div class="bg-white rounded-[2rem] shadow-xl shadow-gray-200/50 border border-gray-100 p-4 md:p-8">
        {{-- Header Section --}}
        <div class="flex items-center gap-4 mb-8 md:mb-10">
            <div class="bg-blue-50 p-3 md:p-4 rounded-2xl shadow-sm">
                <i class="fas fa-history text-lg md:text-xl text-[#2E6C9F]"></i>
            </div>
            <div>
                <p class="text-sm md:text-md text-gray-400 font-medium tracking-wider">Daftar hasil penilaian kepribadian
                    Anda</p>
            </div>
        </div>

        @if ($tes && $tes->count() > 0)
            <div class="overflow-x-auto pb-4 scrollbar-hide table-wrapper">
                <div class="overflow-x-auto" style="-webkit-overflow-scrolling: touch;">
                    <table class="w-full min-w-[700px] md:min-w-full">
                        <thead>
                            <tr class="border-b-2 border-gray-50">
                                <th
                                    class="px-4 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                    No
                                </th>
                                <th
                                    class="px-4 py-4 text-left text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                    Waktu Tes</th>
                                <th
                                    class="px-4 py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                    Hasil Tertinggi</th>
                                <th
                                    class="px-4 py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                    Skor</th>
                                <th
                                    class="px-4 py-4 text-center text-[11px] font-bold text-gray-400 uppercase tracking-[0.2em] whitespace-nowrap">
                                    Aksi</th>
                                </>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @foreach ($tes as $index => $item)
                                @php
                                    $hasValidScore =
                                        $item->nilai_cf_total > 0 && $item->id_kepribadian && $item->kepribadian;
                                @endphp
                                <tr class="group hover:bg-gray-50/80 transition-all duration-300">
                                    <td
                                        class="px-4 py-6 whitespace-nowrap text-sm font-bold text-gray-300 group-hover:text-[#2E6C9F]">
                                        {{ ($tes->currentPage() - 1) * $tes->perPage() + $index + 1 }}
                                        </>

                                    <td class="px-4 py-6 whitespace-nowrap">
                                        <div class="text-sm font-black text-gray-700">
                                            {{ $item->created_at->format('d F Y') }}
                                        </div>
                                        <div class="text-[10px] text-gray-400 font-bold uppercase">
                                            {{ $item->created_at->format('H:i') }} WIB</div>
                                        </>

                                        {{-- Kolom Hasil --}}
                                    <td class="px-4 py-6 whitespace-nowrap text-center">
                                        @if ($hasValidScore)
                                            <span
                                                class="inline-flex items-center px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-tight bg-blue-50 text-[#2E6C9F] border border-blue-100">
                                                {{ $item->kepribadian->nama_kepribadian }}
                                            </span>
                                        @else
                                            <span class="text-sm font-black text-gray-400 tracking-tight">-</span>
                                        @endif
                                        </>

                                        {{-- Kolom Skor --}}
                                    <td class="px-4 py-6 whitespace-nowrap text-center">
                                        @if ($hasValidScore)
                                            @php
                                                $persentaseEksak = max(0, min(100, $item->nilai_cf_total * 100));
                                            @endphp
                                            <div class="flex flex-col items-center gap-1.5">
                                                <span class="text-sm font-black text-[#2E6C9F] tracking-tight">
                                                    {{ number_format($persentaseEksak, 2) }}%
                                                </span>
                                                <div class="w-12 h-1 bg-gray-100 rounded-full overflow-hidden">
                                                    <div class="h-full bg-[#2E6C9F] transition-all duration-1000"
                                                        style="width: {{ round($persentaseEksak) }}%"></div>
                                                </div>
                                            </div>
                                        @else
                                            <span class="text-sm font-black text-gray-400 tracking-tight">-</span>
                                        @endif
                                        </>

                                        {{-- Kolom Aksi --}}
                                    <td class="px-4 py-6 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2 action-buttons">
                                            {{-- Tombol Detail: Selalu Muncul --}}
                                            <a href="{{ route('siswa.tes.result', $item->id_tes) }}"
                                                class="inline-flex items-center gap-2 bg-gray-100 hover:bg-gray-200 text-gray-600 px-3 py-2 md:px-4 md:py-2.5 rounded-xl transition text-[10px] md:text-[11px] font-black uppercase">
                                                <i class="fas fa-eye text-xs md:text-sm"></i>
                                                <span class="hidden md:inline">Detail</span>
                                                <span class="inline md:hidden">Detail</span>
                                            </a>

                                            {{-- Tombol Cetak: Aktif jika skor > 0, Mute jika skor 0 --}}
                                            @if ($hasValidScore)
                                                <a href="{{ route('siswa.tes.print', $item->id_tes) }}" target="_blank"
                                                    class="inline-flex items-center gap-2 bg-[#2E6C9F] hover:bg-[#1E5A8E] text-white px-3 py-2 md:px-4 md:py-2.5 rounded-xl transition text-[10px] md:text-[11px] font-black uppercase shadow-lg shadow-blue-100">
                                                    <i class="fas fa-print text-xs md:text-sm"></i>
                                                    <span class="hidden md:inline">Cetak</span>
                                                    <span class="inline md:hidden">Cetak</span>
                                                </a>
                                            @else
                                                <button disabled
                                                    class="inline-flex items-center gap-2 bg-gray-50 text-gray-300 cursor-not-allowed px-3 py-2 md:px-4 md:py-2.5 rounded-xl border border-gray-100 text-[10px] md:text-[11px] font-black uppercase">
                                                    <i class="fas fa-print text-xs md:text-sm"></i>
                                                    <span class="hidden md:inline">Cetak</span>
                                                    <span class="inline md:hidden">Print</span>
                                                </button>
                                            @endif
                                        </div>
                                        </>
                                        </>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="mt-10 pagination-wrapper">
                {{ $tes->links() }}
            </div>
        @else
            <div class="text-center py-24 bg-gray-50/50 rounded-[2rem] border-2 border-dashed border-gray-100">
                <div
                    class="w-20 h-20 bg-white rounded-full flex items-center justify-center mx-auto mb-6 shadow-sm text-gray-200">
                    <i class="fas fa-folder-open text-3xl"></i>
                </div>
                <h3 class="text-xl font-black text-gray-800 mb-1">Belum Ada Riwayat</h3>
                <p class="text-sm text-gray-400 font-medium">Selesaikan tes pertama Anda untuk melihat hasil analisis di
                    sini.</p>
            </div>
        @endif
    </div>

    {{-- Tambahan CSS untuk mobile --}}
    <style>
        /* Mobile specific improvements */
        @media (max-width: 768px) {
            .p-4 {
                padding: 1rem;
            }

            .rounded-\[2rem\] {
                border-radius: 1.5rem;
            }

            .gap-4 {
                gap: 0.75rem;
            }

            .mb-8 {
                margin-bottom: 1rem;
            }

            .p-3 {
                padding: 0.75rem;
            }

            .text-sm {
                font-size: 0.75rem;
            }
        }

        @media (max-width: 640px) {

            /* Sliding horizontal untuk tabel */
            .table-wrapper {
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch !important;
                scrollbar-width: thin !important;
                margin: 0 -0.5rem !important;
                padding: 0 0.5rem !important;
            }

            .table-wrapper::-webkit-scrollbar {
                height: 4px !important;
            }

            .table-wrapper::-webkit-scrollbar-track {
                background: #f1f1f1 !important;
                border-radius: 10px !important;
            }

            .table-wrapper::-webkit-scrollbar-thumb {
                background: #2E6C9F !important;
                border-radius: 10px !important;
            }

            /* Perbaikan tombol aksi */
            .action-buttons {
                gap: 0.5rem !important;
            }

            .action-buttons a,
            .action-buttons button {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
                padding-top: 0.5rem !important;
                padding-bottom: 0.5rem !important;
            }

            /* Perbaikan padding sel */
            .px-4 {
                padding-left: 0.75rem !important;
                padding-right: 0.75rem !important;
            }

            .py-6 {
                padding-top: 1rem !important;
                padding-bottom: 1rem !important;
            }

            /* Perbaikan font */
            .text-sm {
                font-size: 0.75rem !important;
            }

            .text-\[10px\] {
                font-size: 0.65rem !important;
            }

            /* Perbaikan badge hasil */
            .px-4.py-1\.5 {
                padding-left: 0.5rem !important;
                padding-right: 0.5rem !important;
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }

            /* Perbaikan progress bar */
            .w-12 {
                width: 2rem !important;
            }
        }

        @media (max-width: 480px) {
            .table-wrapper {
                margin: 0 -1rem !important;
                padding: 0 1rem !important;
            }

            .action-buttons a,
            .action-buttons button {
                padding-left: 0.625rem !important;
                padding-right: 0.625rem !important;
            }

            .text-xs {
                font-size: 0.7rem !important;
            }
        }

        /* Styling pagination responsive */
        @media (max-width: 640px) {
            .pagination-wrapper nav {
                display: flex !important;
                justify-content: center !important;
            }

            .pagination-wrapper nav div:first-child {
                display: none !important;
            }
        }
    </style>
@endsection
