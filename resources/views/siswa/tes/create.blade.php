@extends('layouts.tes')

@section('title', 'Tes Kepribadian')

@section('content')
    <div class="max-w-6xl mx-auto px-4 pb-10" id="mainContainer">
        <div id="skeleton" class="flex flex-col lg:flex-row gap-6 animate-pulse">
            <div class="flex-1 space-y-4">
                <div class="bg-gray-200 rounded-2xl h-[480px]"></div>
                <div class="flex justify-between">
                    <div class="bg-gray-200 rounded-full h-10 w-32"></div>
                    <div class="bg-gray-200 rounded-full h-10 w-32"></div>
                </div>
            </div>
            <div class="w-full lg:w-72 bg-gray-200 rounded-2xl h-[480px]"></div>
        </div>

        <button id="mobileNavToggle"
            class="fixed top-25 right-4 bg-[#2E6C9F] text-white px-4 py-2 rounded-xl shadow-2xl z-[50] flex items-center gap-2 font-bold text-sm border-2 border-white lg:hidden transition-all duration-300">
            <i class="fas fa-th-large"></i>
        </button>

        <form action="{{ route('siswa.tes.store') }}" method="POST" id="testForm" class="hidden">
            @csrf
            <div class="flex flex-col lg:flex-row gap-6 relative">
                <div class="flex-1 flex flex-col gap-4">
                    <div
                        class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 min-h-[380px] lg:h-[480px] flex flex-col justify-center transition-all duration-500">
                        @foreach ($pertanyaan as $index => $p)
                            <div class="question-step {{ $index == 0 ? '' : 'hidden' }}" data-index="{{ $index }}">
                                <h2 class="text-xl font-bold text-gray-800 mb-6 leading-relaxed">
                                    {{ $index + 1 }}. {{ $p->teks_pertanyaan }}
                                </h2>

                                <div class="space-y-2 max-w-2xl mx-auto">
                                    @foreach ([
                                    '0.0' => 'Tidak Sesuai',
                                    '0.25' => 'Kurang Sesuai',
                                    '0.5' => 'Cukup Sesuai',
                                    '0.75' => 'Sesuai',
                                    '1.0' => 'Sangat Sesuai',
                                ] as $val => $text)
                                        <label
                                            class="option-label flex items-center gap-4 p-4 border-2 border-gray-100 rounded-xl cursor-pointer hover:border-[#2E6C9F] hover:bg-blue-50 transition-all group relative">
                                            <input type="radio" name="jawaban[{{ $p->id_pertanyaan }}]"
                                                value="{{ $val }}" class="radio-option hidden">
                                            <div
                                                class="custom-radio w-6 h-6 border-2 border-gray-300 rounded-full flex items-center justify-center transition-all shrink-0 bg-white">
                                                <div
                                                    class="dot w-3 h-3 bg-[#2E6C9F] rounded-full opacity-0 transform scale-0 transition-all duration-200">
                                                </div>
                                            </div>

                                            <span
                                                class="text-sm font-medium text-gray-600 group-hover:text-[#2E6C9F] flex-1">
                                                {{ $text }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="flex justify-between items-center mt-2">
                        <button type="button" id="prevBtn"
                            class="bg-red-50 text-red-600 border border-red-200 px-6 py-2.5 rounded-xl font-bold text-sm transition-all hover:bg-red-600 hover:text-white disabled:opacity-30 disabled:pointer-events-none">
                            Kembali
                        </button>
                        <button type="button" id="nextBtn"
                            class="bg-[#2E6C9F] text-white px-8 py-2.5 rounded-xl font-bold text-sm transition-all hover:shadow-lg hover:brightness-110">
                            Selanjutnya
                        </button>
                        <button type="submit" id="submitBtn"
                            class="bg-emerald-500 text-white px-8 py-2.5 rounded-xl font-bold text-sm hidden transition-all hover:shadow-lg hover:bg-emerald-600">
                            Selesaikan Tes
                        </button>
                    </div>
                </div>

                <div id="sidebarOverlay" class="fixed inset-0 bg-black/60 z-[60] hidden lg:hidden backdrop-blur-sm"></div>

                <div id="navSidebar"
                    class="fixed inset-y-0 right-0 w-72 bg-[#2E6C9F] shadow-2xl z-[70] transform translate-x-full transition-transform duration-300 lg:relative lg:translate-x-0 lg:z-0 lg:shadow-none lg:rounded-2xl lg:h-[480px]">
                    <div class="p-5 pt-20 lg:pt-5 flex flex-col h-full">
                        <div class="flex items-center justify-between mb-6 lg:justify-center">
                            <h3 class="text-white text-[10px] font-black uppercase tracking-[0.2em] opacity-70">Navigasi
                                Soal</h3>
                            <button type="button" id="closeSidebar" class="text-white lg:hidden p-2">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <div id="navScrollContainer"
                            class="grid grid-cols-4 gap-2 overflow-y-auto pr-1 custom-scrollbar scroll-smooth">
                            @foreach ($pertanyaan as $index => $p)
                                <button type="button"
                                    class="number-box w-full aspect-square rounded-lg flex items-center justify-center text-xs font-bold transition-all duration-200 border border-white/10 hover:bg-white/10"
                                    data-index="{{ $index }}">
                                    {{ $index + 1 }}
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <style>
        /* State radio bawaan */
        .radio-option:checked+.custom-radio {
            border-color: #2E6C9F !important;
            background-color: #fff !important;
        }

        .radio-option:checked+.custom-radio .dot {
            opacity: 1 !important;
            transform: scale(1) !important;
        }

        /* Class bantuan untuk highlight label (untuk menghindari bug mobile) */
        .option-selected {
            border-color: #2E6C9F !important;
            background-color: #f0f9ff !important;
            box-shadow: 0 4px 10px rgba(46, 108, 159, 0.1);
        }

        .option-selected span {
            color: #2E6C9F !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
        }

        .question-step {
            animation: slideIn 0.3s ease-out forwards;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateX(10px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Sembunyikan tombol navigasi saat sidebar terbuka agar tidak bertumpuk */
        .btn-hidden {
            opacity: 0;
            pointer-events: none;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@push('scripts')
    <script>
        const ModernAlert = Swal.mixin({
            toast: true,
            position: 'top-end',
            width: '390px',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            background: '#ffffff',
            color: '#1f2937'
        });

        const STORAGE_KEY = 'jawaban_tes_kepribadian';
        const STEP_KEY = 'last_step';
        const SCROLL_KEY = 'nav_scroll_pos';

        const steps = document.querySelectorAll('.question-step');
        const numberBoxes = document.querySelectorAll('.number-box');
        const nextBtn = document.getElementById('nextBtn');
        const prevBtn = document.getElementById('prevBtn');
        const submitBtn = document.getElementById('submitBtn');
        const testForm = document.getElementById('testForm');
        const navScrollContainer = document.getElementById('navScrollContainer');
        const mobileNavToggle = document.getElementById('mobileNavToggle');
        const navSidebar = document.getElementById('navSidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');
        const closeSidebar = document.getElementById('closeSidebar');

        let currentStep = parseInt(localStorage.getItem(STEP_KEY)) || 0;

        function toggleSidebar() {
            const isOpen = !navSidebar.classList.contains('translate-x-full');
            navSidebar.classList.toggle('translate-x-full');
            sidebarOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');

            // Sembunyikan tombol toggle agar tidak tumpang tindih dengan sidebar
            if (!isOpen) {
                mobileNavToggle.classList.add('btn-hidden');
            } else {
                mobileNavToggle.classList.remove('btn-hidden');
            }
        }

        if (mobileNavToggle) mobileNavToggle.addEventListener('click', toggleSidebar);
        sidebarOverlay.addEventListener('click', toggleSidebar);
        closeSidebar.addEventListener('click', toggleSidebar);

        function updateDisplay() {
            localStorage.setItem(STEP_KEY, currentStep);
            steps.forEach((step, idx) => step.classList.toggle('hidden', idx !== currentStep));

            numberBoxes.forEach((box, idx) => {
                box.className =
                    'number-box w-full aspect-square rounded-lg flex items-center justify-center text-xs font-bold transition-all duration-200 border';

                const inputs = steps[idx].querySelectorAll('input');
                const questionId = inputs[0].name.match(/\d+/)[0];
                const isAnswered = document.querySelector(`input[name="jawaban[${questionId}]"]:checked`);

                if (idx === currentStep) {
                    box.classList.add('bg-white', 'text-[#2E6C9F]', 'ring-2', 'ring-yellow-400',
                        'border-transparent', 'scale-110', 'z-10');
                } else if (isAnswered) {
                    box.classList.add('bg-emerald-500', 'text-white', 'border-transparent');
                } else {
                    box.classList.add('bg-white/10', 'text-white/60', 'border-white/10');
                }
            });

            prevBtn.disabled = currentStep === 0;
            if (currentStep === steps.length - 1) {
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            } else {
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
            }
        }

        // Fungsi khusus untuk mengatur class aktif pada label jawaban
        function refreshOptionHighlights() {
            document.querySelectorAll('.option-label').forEach(label => {
                const radio = label.querySelector('input');
                if (radio && radio.checked) {
                    label.classList.add('option-selected');
                } else {
                    label.classList.remove('option-selected');
                }
            });
        }

        window.addEventListener('DOMContentLoaded', () => {
            const initData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
            Object.keys(initData).forEach(qId => {
                const radio = document.querySelector(
                    `input[name="jawaban[${qId}]"][value="${initData[qId]}"]`);
                if (radio) radio.checked = true;
            });

            setTimeout(() => {
                document.getElementById('skeleton').classList.add('hidden');
                testForm.classList.remove('hidden');
                testForm.classList.add('fade-in');
                updateDisplay();
                refreshOptionHighlights();
            }, 700);
        });

        // Event listener untuk pilihan jawaban
        document.querySelectorAll('.radio-option').forEach(input => {
            input.addEventListener('change', (e) => {
                const savedData = JSON.parse(localStorage.getItem(STORAGE_KEY)) || {};
                const questionId = e.target.name.match(/\d+/)[0];
                savedData[questionId] = e.target.value;
                localStorage.setItem(STORAGE_KEY, JSON.stringify(savedData));

                refreshOptionHighlights(); // Update warna background label
                updateDisplay(); // Update navigasi angka
            });
        });

        nextBtn.addEventListener('click', () => {
            if (currentStep < steps.length - 1) {
                currentStep++;
                updateDisplay();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });

        prevBtn.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                updateDisplay();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            }
        });

        numberBoxes.forEach((box) => {
            box.addEventListener('click', () => {
                currentStep = parseInt(box.dataset.index);
                updateDisplay();
                if (window.innerWidth < 1024) toggleSidebar();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });

        testForm.addEventListener('submit', (e) => {
            const answeredCount = Object.keys(JSON.parse(localStorage.getItem(STORAGE_KEY)) || {}).length;
            if (answeredCount < steps.length) {
                e.preventDefault();
                ModernAlert.fire({
                    icon: 'error',
                    title: 'Gagal Menyelesaikan Tes',
                    text: `${steps.length - answeredCount} soal belum dijawab.`
                });
                return;
            }
            localStorage.clear();
        });
    </script>
@endpush
