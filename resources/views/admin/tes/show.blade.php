@extends('layouts.admin')

@section('title', 'Detail Hasil Tes - ' . ($tes->siswa->nama_lengkap ?? 'Siswa'))
@section('page-title', 'Detail Hasil Tes')

@section('content')
    <div class="max-w-full space-y-8">
        <div class="print:hidden">
            <a href="{{ route('admin.tes.index', ['page' => request('page'), 'search' => request('search')]) }}"
                class="text-[#2E6C9F] text-sm font-semibold hover:underline flex items-center transition">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            <div class="lg:col-span-5 bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6 flex items-center">
                    <i class="fas fa-id-card mr-3 text-[#2E6C9F]"></i> Profil Siswa
                </h3>
                <div class="space-y-4">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</p>
                        <p class="text-lg font-black text-gray-800 uppercase tracking-tight">
                            {{ $tes->siswa->nama_lengkap ?? 'N/A' }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Kelas</p>
                            <p class="text-sm font-bold text-gray-700">{{ $tes->siswa->kelas ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Jenis Kelamin</p>
                            <p class="text-sm font-bold text-gray-700">{{ $tes->siswa->jenis_kelamin ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="pt-4 border-t border-gray-50 grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Tanggal Tes</p>
                            <p class="text-sm font-bold text-gray-700">{{ $tes->created_at->format('d F Y') }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Waktu Tes</p>
                            <p class="text-sm font-bold text-[#2E6C9F]">{{ $tes->created_at->format('H:i') }} WIB</p>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="lg:col-span-7 bg-[#2E6C9F] rounded-3xl shadow-xl p-8 text-white flex flex-col justify-center relative overflow-hidden">
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-200 opacity-80 mb-2">Hasil
                        Tertinggi</p>
                    <h2 class="text-4xl font-black uppercase tracking-tight mb-6">
                        {{ $tes->kepribadian->nama_kepribadian ?? 'N/A' }}</h2>

                    <div
                        class="inline-flex items-center bg-black/20 rounded-2xl p-4 border border-white/10 backdrop-blur-md">
                        <div class="mr-4">
                            <p class="text-[10px] font-bold uppercase text-blue-100 opacity-70">Skor</p>
                            <p class="text-3xl font-black">{{ number_format($tes->nilai_cf_total * 100, 2) }}%</p>
                        </div>
                        <i class="fas fa-shield-check text-2xl text-blue-300"></i>
                    </div>
                </div>
                <i class="fas fa-fingerprint absolute -bottom-8 -right-4 text-[12rem] text-white/5 rotate-12"></i>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-8 flex items-center">
                <i class="fas fa-chart-bar mr-3 text-[#2E6C9F]"></i> Analisis Spektrum
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-8">
                @foreach ($hasilKepribadian as $hasil)
                    <div class="group">
                        <div class="flex justify-between mb-2 items-center">
                            <span
                                class="text-[11px] font-black text-gray-600 uppercase tracking-wide group-hover:text-[#2E6C9F] transition-colors">
                                {{ $hasil->nama_kepribadian }}
                            </span>
                            <span class="text-sm font-black text-[#2E6C9F] bg-blue-50 px-2 py-0.5 rounded-md">
                                {{ number_format($hasil->cf_total * 100, 2) }}%
                            </span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-2.5 overflow-hidden">
                            <div class="bg-[#2E6C9F] h-full rounded-full transition-all duration-1000"
                                style="width: {{ $hasil->cf_total * 100 }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 bg-gray-50/30">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] flex items-center">
                    <i class="fas fa-clipboard-list mr-3 text-[#2E6C9F]"></i> Rincian Respon Siswa & Bobot Pakar
                </h3>
            </div>

            <div class="p-8">
                @php
                    $groupedDetails = $tes->detailTes->groupBy(function ($item) {
                        return $item->pertanyaan->basisAturan->first()->kepribadian->nama_kepribadian ?? 'Lainnya';
                    });
                @endphp

                <div class="space-y-12">
                    @foreach ($groupedDetails as $kepribadianName => $details)
                        <div>
                            <div class="flex items-center gap-4 mb-6">
                                <h4
                                    class="text-[11px] font-black text-[#2E6C9F] bg-blue-50 px-4 py-1.5 rounded-lg uppercase tracking-widest border border-blue-100 shadow-sm">
                                    {{ $kepribadianName }}
                                </h4>
                                <div class="flex-grow h-px bg-gray-100"></div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-12 gap-y-2">
                                @foreach ($details as $detail)
                                    @php
                                        $cfPakar = $detail->pertanyaan->basisAturan->first()->cf_pakar ?? 0;
                                    @endphp
                                    <div
                                        class="flex items-center justify-between py-3 border-b border-gray-50 group hover:bg-gray-50/50 px-2 transition-all">
                                        <div class="flex items-start gap-4">
                                            <span
                                                class="text-[10px] font-bold text-gray-400 mt-1 min-w-[30px]">{{ $detail->pertanyaan->kode_pertanyaan }}</span>
                                            <p
                                                class="text-sm text-gray-600 font-medium leading-relaxed italic group-hover:text-gray-900 transition-colors">
                                                "{{ $detail->pertanyaan->teks_pertanyaan }}"
                                            </p>
                                        </div>
                                        <div class="ml-4 flex gap-3 flex-shrink-0 items-center justify-end">
                                            <div class="w-14 text-center">
                                                <p class="text-[7px] font-black text-[#2E6C9F] uppercase mb-1">Siswa</p>
                                                <div
                                                    class="text-[10px] font-black text-[#2E6C9F] bg-blue-50 py-1 rounded border border-blue-100 h-7 flex items-center justify-center">
                                                    {{ number_format($detail->nilai_cf_user, 2) }}
                                                </div>
                                            </div>
                                            <div class="w-14 text-center">
                                                <p class="text-[7px] font-black text-gray-400 uppercase mb-1">Pakar</p>
                                                <div
                                                    class="text-[10px] font-bold text-gray-500 bg-gray-50 py-1 rounded border border-gray-100 h-7 flex items-center justify-center">
                                                    {{ number_format($cfPakar, 2) }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
