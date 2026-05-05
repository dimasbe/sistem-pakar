@extends('layouts.admin')

@section('title', 'Detail Basis Aturan')
@section('page-title', 'Detail Aturan')

@section('content')
    <div class="max-w-full">
        <div class="mb-6">
            <a href="{{ route('admin.aturan.index') }}"
                class="text-[#2E6C9F] text-sm font-semibold hover:underline flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="bg-[#2E6C9F] px-8 py-8 text-white">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-1 opacity-80">Detail Basis
                            Aturan</p>
                        <h1 class="text-2xl font-bold uppercase tracking-tight">Sistem Pakar</h1>
                    </div>
                    <div class="text-right">
                        <p class="text-blue-100 text-[10px] font-bold uppercase tracking-[0.2em] mb-1 opacity-70">ID Aturan
                        </p>
                        <p class="text-2xl font-black">{{ $basisAturan->id_aturan }}</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <div class="lg:col-span-8 space-y-8">
                        <div>
                            <label
                                class="block text-xs font-black text-gray-400 uppercase tracking-wider mb-4">Pertanyaan</label>
                            <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100">
                                <span
                                    class="inline-block bg-[#2E6C9F] text-white text-[10px] font-bold px-3 py-1 rounded-full mb-3 uppercase">
                                    {{ $basisAturan->pertanyaan->kode_pertanyaan }}
                                </span>
                                <p class="text-gray-700 text-lg leading-relaxed font-medium">
                                    {{ $basisAturan->pertanyaan->teks_pertanyaan }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase tracking-wider mb-4">Tipe
                                Kepribadian</label>
                            <div class="flex flex-col items-start">
                                <div
                                    class="bg-[#2E6C9F] text-white w-20 h-20 rounded-2xl flex items-center justify-center text-3xl font-black shadow-md mb-3">
                                    {{ substr($basisAturan->kepribadian->kode_kepribadian ?? '?', 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-[#2E6C9F] font-bold text-lg leading-tight uppercase">
                                        {{ $basisAturan->kepribadian->nama_kepribadian }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-4">
                        <div
                            class="bg-gray-50 rounded-3xl p-8 border border-gray-100 flex flex-col items-center justify-center text-center h-full min-h-[250px]">
                            <label class="text-xs font-black text-gray-400 uppercase tracking-wider mb-6">Nilai CF
                                Pakar</label>
                            <div class="text-7xl font-black text-[#2E6C9F] tracking-tighter">
                                {{ number_format($basisAturan->cf_pakar, 2) }}
                            </div>
                            <div class="mt-4 w-12 h-1 bg-[#2E6C9F] rounded-full opacity-20"></div>
                        </div>
                    </div>
                </div>

                <div class="mt-12 pt-10 border-t border-gray-100">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-6">
                        Rekomendasi Karir
                    </label>

                    @if ($basisAturan->kepribadian->karir->isNotEmpty())
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                            @foreach ($basisAturan->kepribadian->karir as $item)
                                <div class="flex items-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm">
                                    <div class="w-8 h-8 rounded bg-blue-50 flex items-center justify-center mr-3">
                                        <i class="fas fa-briefcase text-[#2E6C9F] text-xs"></i>
                                    </div>
                                    <span class="text-sm font-bold text-gray-700 uppercase">{{ $item->nama_karir }}</span>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div
                            class="bg-gray-50 border border-dashed border-gray-200 text-gray-400 p-8 rounded-2xl text-center">
                            <p class="text-sm font-medium italic">Belum ada rekomendasi karir untuk tipe ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
