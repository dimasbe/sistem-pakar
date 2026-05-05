@extends('layouts.admin')

@section('title', 'Detail Karir')
@section('page-title', 'Detail Karir')

@section('content')
    <div class="max-w-full">
        {{-- Tombol Kembali di Atas --}}
        <div class="mb-6">
            <a href="{{ route('admin.karir.index') }}" class="text-[#2E6C9F] text-sm font-semibold hover:underline">
                <i class="fas fa-arrow-left mr-1"></i> Kembali
            </a>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            {{-- Header Detail --}}
            <div class="bg-[#2E6C9F] px-8 py-8 text-white">
                <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-1">Nama Karir</p>
                <h1 class="text-3xl font-bold uppercase">{{ $karir->nama_karir }}</h1>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                    {{-- Sidebar Info --}}
                    <div class="lg:col-span-1 border-b lg:border-b-0 lg:border-r border-gray-100 pb-6 lg:pb-0 lg:pr-8">
                        <div class="mb-8">
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-4 tracking-wider">Tipe
                                Kepribadian</label>
                            <div class="flex flex-col items-start">
                                {{-- Icon Tipe Kepribadian Besar --}}
                                <div
                                    class="bg-[#2E6C9F] text-white w-20 h-20 rounded-2xl flex items-center justify-center text-3xl font-black shadow-md mb-3">
                                    {{ substr($karir->kepribadian->kode_kepribadian, 0, 1) }}
                                </div>
                                <div>
                                    {{-- Hanya Nama Kepribadian agar tidak double dengan icon --}}
                                    <p class="text-[#2E6C9F] font-bold text-lg leading-tight uppercase">
                                        {{ $karir->kepribadian->nama_kepribadian }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-gray-400 uppercase mb-1 tracking-wider">Terakhir
                                Diupdate</label>
                            <p class="text-sm text-gray-700 font-semibold">
                                <i class="far fa-calendar-alt mr-1 text-[#2E6C9F]"></i>
                                {{ $karir->updated_at->format('d M Y') }}
                            </p>
                            <p class="text-xs text-gray-400 ml-5">{{ $karir->updated_at->format('H:i') }} WIB</p>
                        </div>
                    </div>

                    {{-- Deskripsi Utama --}}
                    <div class="lg:col-span-3">
                        <label class="block text-xs font-bold text-gray-400 uppercase mb-4 tracking-wider">Deskripsi Lengkap
                            Pekerjaan</label>
                        <div
                            class="text-gray-700 leading-relaxed text-base whitespace-pre-line break-words bg-gray-50 p-8 rounded-2xl border border-gray-100 min-h-[300px]">
                            {{ trim($karir->deskripsi_karir) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
