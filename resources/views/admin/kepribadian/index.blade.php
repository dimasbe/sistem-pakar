@extends('layouts.admin')

@section('title', 'Manajemen Kepribadian')
@section('page-title', 'Kepribadian')

@section('content')
    {{-- Style Pagination Kustom --}}
    <style>
        .pagination-wrapper nav div:first-child p {
            font-size: 0.75rem !important;
            color: #9CA3AF !important;
        }

        .pagination-wrapper nav span span,
        .pagination-wrapper nav a {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 2rem !important;
            height: 2rem !important;
            border-radius: 9999px !important;
            background-color: #ffffff !important;
            border: 1.5px solid #E5E7EB !important;
            color: #6B7280 !important;
            font-size: 0.8rem !important;
            font-weight: 600 !important;
            margin: 0 2px !important;
            transition: all 0.2s !important;
            text-decoration: none !important;
        }

        .pagination-wrapper nav span[aria-current="page"] span {
            background-color: #2E6C9F !important;
            border-color: #2E6C9F !important;
            color: white !important;
            box-shadow: 0 0 0 3px rgba(46, 108, 159, 0.18) !important;
        }

        .pagination-wrapper nav a:hover {
            background-color: #2E6C9F !important;
            border-color: #2E6C9F !important;
            color: white !important;
        }

        .pagination-wrapper nav span>span {
            background-color: #F9FAFB !important;
            color: #D1D5DB !important;
            border-color: #E5E7EB !important;
            cursor: not-allowed !important;
        }

        /* Responsive Mobile Styles - Sliding Horizontal */
        @media (max-width: 768px) {
            .header-action-row {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 0.75rem !important;
                margin-bottom: 1rem !important;
            }

            .header-action-row a {
                width: 100% !important;
                justify-content: center !important;
            }

            .bg-white.rounded-xl.shadow-sm.border.border-gray-100.p-8 {
                padding: 1rem !important;
            }

            /* Membuat tabel bisa di-slide horizontally */
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

            table {
                min-width: 650px !important;
            }

            /* Tombol aksi lebih compact di mobile */
            .action-buttons {
                gap: 0.5rem !important;
            }

            .action-buttons a,
            .action-buttons button {
                padding: 0.375rem 0.625rem !important;
                font-size: 10px !important;
            }

            /* Kolom deskripsi */
            .deskripsi-cell {
                min-width: 200px !important;
            }
        }

        @media (max-width: 640px) {
            .table-wrapper {
                margin: 0 -1rem !important;
                padding: 0 1rem !important;
            }
        }

        @media (max-width: 480px) {
            .table-wrapper {
                margin: 0 -1.25rem !important;
                padding: 0 1.25rem !important;
            }

            table {
                min-width: 600px !important;
            }
        }
    </style>

    {{-- Alert Notifikasi - Diselaraskan dengan Manajemen Siswa --}}
    <div class="max-w-full mx-auto">
        @if (session('success'))
            <div
                class="mb-5 flex items-center justify-between bg-green-50 border-l-4 border-green-500 text-green-800 p-4 rounded shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-bold text-sm">{{ session('success') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove();" class="text-green-500 hover:text-green-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @php session()->forget('success'); @endphp
        @endif

        @if (session('error'))
            <div
                class="mb-5 flex items-center justify-between bg-red-50 border-l-4 border-red-500 text-red-800 p-4 rounded shadow-sm">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-bold text-sm">{{ session('error') }}</span>
                </div>
                <button type="button" onclick="this.parentElement.remove();" class="text-red-500 hover:text-red-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            @php session()->forget('error'); @endphp
        @endif
    </div>

    <div class="flex justify-between items-center mb-6 header-action-row">
        <h2 class="text-[#2E6C9F] font-bold text-xl uppercase tracking-wider">Manajemen Kepribadian</h2>
        <a href="{{ route('admin.kepribadian.create') }}"
            class="bg-[#2E6C9F] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#3D78A8] transition shadow-md flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Kepribadian
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="table-wrapper">
            <div class="overflow-x-auto">
                <table class="min-w-full table-fixed">
                    <thead>
                        <tr class="text-[#2E6C9F] text-sm font-bold border-b border-gray-100">
                            <th class="px-4 py-4 text-center w-24 whitespace-nowrap">Kode</th>
                            <th class="px-4 py-4 text-center w-64 whitespace-nowrap">Tipe Kepribadian</th>
                            <th class="px-4 py-4 text-left whitespace-nowrap">Deskripsi Singkat</th>
                            <th class="px-4 py-4 text-center w-44 whitespace-nowrap">Aksi</th>
                            </>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($kepribadian as $item)
                            <tr class="text-sm text-[#2E6C9F] hover:bg-gray-50 transition">
                                <td class="px-4 py-5 font-bold text-center whitespace-nowrap">
                                    <span class="bg-blue-50 px-3 py-1 rounded text-[#2E6C9F] border border-blue-100">
                                        {{ $item->kode_kepribadian }}
                                    </span>
                                    </>
                                <td class="px-4 py-5 font-bold uppercase text-center whitespace-nowrap">
                                    {{ $item->nama_kepribadian }}
                                    </>
                                <td class="px-4 py-5 text-gray-600 deskripsi-cell">
                                    <p class="line-clamp-2 leading-relaxed">
                                        {{ $item->deskripsi }}
                                    </p>
                                    </>
                                <td class="px-4 py-5 text-center whitespace-nowrap">
                                    <div class="flex justify-center gap-2 action-buttons">
                                        <a href="{{ route('admin.kepribadian.edit', $item->id_kepribadian) }}"
                                            class="bg-[#3D78A8] text-white px-4 py-1.5 rounded-md text-xs font-bold hover:bg-blue-600 transition shadow-sm">
                                            Edit
                                        </a>

                                        <form id="delete-form-{{ $item->id_kepribadian }}"
                                            action="{{ route('admin.kepribadian.destroy', $item->id_kepribadian) }}"
                                            method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="confirmDelete('{{ $item->id_kepribadian }}', '{{ $item->nama_kepribadian }}')"
                                                class="bg-green-600 text-white px-4 py-1.5 rounded-md text-xs font-bold hover:bg-green-700 transition shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                    </>
                                    </>
                                @empty
                            <tr>
                                <td colspan="4" class="px-4 py-10 text-center text-gray-400 font-medium">
                                    Belum ada data kepribadian.
                                    </>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 pagination-wrapper">
            {{ $kepribadian->links() }}
        </div>
    </div>

    {{-- Script SweetAlert2 & Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `Apakah Anda yakin ingin menghapus tipe <br><b class="text-[#2E6C9F]">${name}</b>? <br><small class="text-red-500 block font-medium">Data yang dihapus tidak dapat dipulihkan.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#16a34a',
                cancelButtonColor: '#f3f4f6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batalkan',
                reverseButtons: true,
                showClass: {
                    popup: 'animate__animated animate__fadeInDown animate__faster'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp animate__faster'
                },
                customClass: {
                    container: 'font-sans',
                    popup: 'rounded-2xl border-none shadow-2xl',
                    title: 'text-xl font-bold text-gray-800',
                    htmlContainer: 'text-sm text-gray-600',
                    confirmButton: 'rounded-lg px-6 py-2.5 text-sm font-bold mx-1',
                    cancelButton: 'rounded-lg px-6 py-2.5 text-sm font-bold text-gray-700 mx-1'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endsection
