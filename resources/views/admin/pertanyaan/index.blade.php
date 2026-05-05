@extends('layouts.admin')

@section('title', 'Manajemen Pertanyaan')
@section('page-title', 'Pertanyaan')

@section('content')
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

        /* Responsive Mobile Styles - Sliding Horizontal (TANPA menyembunyikan kolom) */
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

            .search-wrapper {
                flex-direction: column !important;
                align-items: stretch !important;
            }

            .search-wrapper form {
                max-width: 100% !important;
                width: 100% !important;
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
                min-width: 550px !important;
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
                min-width: 500px !important;
            }
        }
    </style>

    {{-- Alert Notifikasi --}}
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

    <div class="flex justify-between items-center mb-4 header-action-row">
        <h2 class="text-[#2E6C9F] font-bold text-xl uppercase tracking-wider">Manajemen Pertanyaan</h2>
        <a href="{{ route('admin.pertanyaan.create') }}"
            class="bg-[#2E6C9F] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#3D78A8] transition shadow-md flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah Pertanyaan
        </a>
    </div>

    {{-- Search Bar --}}
    <div class="mb-4 search-wrapper flex items-center gap-2">
        <form method="GET" action="{{ route('admin.pertanyaan.index') }}" id="searchForm" class="w-full max-w-sm">
            <div class="relative">
                <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 pointer-events-none">
                    <i class="fas fa-search text-xs"></i>
                </span>
                <input type="text" name="search" id="searchInput" placeholder="Cari teks pertanyaan..."
                    value="{{ request('search') }}"
                    class="w-full pl-9 pr-9 py-2 text-sm border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#2E6C9F] focus:border-transparent transition" />
                @if (request('search'))
                    <a href="{{ route('admin.pertanyaan.index') }}"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-red-500 transition">
                        <i class="fas fa-times text-xs"></i>
                    </a>
                @endif
            </div>
        </form>
        @if (request('search'))
            <span class="text-xs text-gray-400 whitespace-nowrap">
                {{ $pertanyaan->total() }} pertanyaan ditemukan
            </span>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="table-wrapper">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="text-[#2E6C9F] text-sm font-bold border-b border-gray-100">
                            <th class="px-4 py-4 text-center w-20">No</th>
                            <th class="px-4 py-4 text-left">Teks Pertanyaan</th>
                            <th class="px-4 py-4 text-center w-40">Aksi</th>
                            </>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse ($pertanyaan as $index => $item)
                            <tr class="text-sm text-gray-700 hover:bg-gray-50 transition">
                                <td class="px-4 py-5 text-center font-bold text-[#2E6C9F]">
                                    {{ $pertanyaan->firstItem() + $index }}
                                    </>
                                <td class="px-4 py-5 leading-relaxed">
                                    {{ $item->teks_pertanyaan }}
                                    </>
                                <td class="px-4 py-5 text-center">
                                    <div class="flex justify-center gap-2 action-buttons">
                                        <a href="{{ route('admin.pertanyaan.edit', $item->id_pertanyaan) }}"
                                            class="bg-[#3D78A8] text-white px-4 py-1.5 rounded-md text-xs font-bold hover:bg-blue-600 transition shadow-sm">
                                            Edit
                                        </a>
                                        <form id="delete-form-{{ $item->id_pertanyaan }}"
                                            action="{{ route('admin.pertanyaan.destroy', $item->id_pertanyaan) }}"
                                            method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button"
                                                onclick="confirmDelete('{{ $item->id_pertanyaan }}', '{{ addslashes(Str::limit($item->teks_pertanyaan, 50)) }}')"
                                                class="bg-green-600 text-white px-4 py-1.5 rounded-md text-xs font-bold hover:bg-green-700 transition shadow-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                    </>
                                    </>
                                @empty
                            <tr>
                                <td colspan="3" class="px-4 py-10 text-center text-gray-400 font-medium">
                                    @if (request('search'))
                                        <i class="fas fa-search text-4xl mb-4 block opacity-30"></i>
                                        <p class="font-medium text-lg">Pertanyaan tidak ditemukan.</p>
                                    @else
                                        Belum ada data pertanyaan.
                                    @endif
                                    </>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6 pagination-wrapper">
            {{ $pertanyaan->appends(request()->query())->onEachSide(1)->links() }}
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let debounceTimer;

        searchInput.addEventListener('input', function() {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                searchForm.submit();
            }, 400);
        });

        function confirmDelete(id, text) {
            Swal.fire({
                title: 'Konfirmasi Hapus',
                html: `Apakah Anda yakin ingin menghapus pertanyaan: <br><b class="text-[#2E6C9F]">"${text}"</b>? <br><small class="text-red-500 font-medium">Data yang dihapus tidak dapat dipulihkan.</small>`,
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
                    confirmButton: 'rounded-lg px-6 py-2.5 text-sm font-bold',
                    cancelButton: 'rounded-lg px-6 py-2.5 text-sm font-bold text-gray-700'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        }
                    });
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }
    </script>
@endsection
