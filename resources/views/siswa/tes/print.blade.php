<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tes RIASEC - {{ $tes->siswa->nama_lengkap }}</title>
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- PERBAIKAN 1: Ganti @import dengan preconnect + link agar font tidak blocking di mobile --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }

        .a4-container {
            background: white;
            width: 210mm;
            height: 297mm;
            margin: 20px auto;
            padding: 12mm 14mm 10mm 14mm;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
            print-color-adjust: exact;
            -webkit-print-color-adjust: exact;
            overflow: hidden;
        }

        @media screen and (max-width: 768px) {
            body {
                background-color: white;
            }

            .a4-container {
                margin: 0 auto;
                zoom: 0.45;
                box-shadow: none;
            }
        }

        @media screen and (max-width: 400px) {
            .a4-container {
                zoom: 0.38;
            }
        }

        @media print {
            body {
                background: white;
                padding: 0;
                margin: 0;
            }

            .no-print {
                display: none !important;
            }

            .a4-container {
                width: 210mm;
                height: 297mm;
                margin: 0;
                padding: 12mm 14mm 10mm 14mm;
                box-shadow: none;
                zoom: 1 !important;
            }

            @page {
                size: A4;
                margin: 0;
            }
        }

        .label {
            font-size: 7.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: #94a3b8;
            margin-bottom: 3px;
        }

        .bar-track {
            height: 5px;
            background: #e2e8f0;
            border-radius: 99px;
            overflow: hidden;
        }

        .bar-fill {
            height: 100%;
            background-color: #2E6C9F;
            border-radius: 99px;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        {{-- PERBAIKAN 2: Loading overlay saat proses print --}} #print-loading {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(255, 255, 255, 0.85);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 12px;
        }

        #print-loading.show {
            display: flex;
        }

        #print-loading .spinner {
            width: 36px;
            height: 36px;
            border: 3px solid #e2e8f0;
            border-top-color: #2E6C9F;
            border-radius: 50%;
            animation: spin 0.7s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body class="antialiased">

    {{-- PERBAIKAN 3: Loading overlay element --}}
    <div id="print-loading">
        <div class="spinner"></div>
        <div style="font-size:13px; font-weight:700; color:#475569; font-family:'Plus Jakarta Sans',sans-serif;">
            Menyiapkan dokumen...</div>
    </div>

    <div
        class="no-print fixed bottom-0 left-0 w-full bg-white border-t border-gray-200 px-4 py-3 flex flex-col gap-2 shadow-md
           sm:sticky sm:top-0 sm:flex-row sm:justify-between sm:items-center sm:border-b sm:border-t-0 sm:shadow-sm">

        <button onclick="window.close()"
            class="order-2 sm:order-1 w-full sm:w-auto flex justify-center items-center gap-2 text-sm font-bold text-gray-600 border border-gray-300 px-4 py-2 rounded-lg hover:text-[#2E6C9F] hover:border-[#2E6C9F] transition">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </button>

        <button onclick="handlePrint()"
            class="order-1 sm:order-2 w-full sm:w-auto bg-[#2E6C9F] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#1E5A8E] transition flex justify-center items-center gap-2">
            <i class="fas fa-print text-xs"></i> Cetak (PDF)
        </button>

    </div>

    @php
        $top3 = $hasilKepribadian->take(3);
        $kodeKombinasi = $top3->pluck('kode_kepribadian')->implode('');
    @endphp

    <div class="a4-container">

        {{-- HEADER --}}
        <div
            style="display:flex; justify-content:space-between; align-items:center; border-bottom:2px solid #f1f5f9; padding-bottom:8px; margin-bottom:12px;">
            <div style="display:flex; align-items:center; gap:10px;">
                <div
                    style="width:30px; height:30px; background-color:#2E6C9F; border-radius:7px; display:flex; align-items:center; justify-content:center; padding:5px;">
                    <img src="{{ asset('images/logo2.png') }}" alt="Logo"
                        style="width:100%; height:100%; object-fit:contain; filter:brightness(0) invert(1);">
                </div>
                <div>
                    <div style="font-size:15px; font-weight:900; color:#2E6C9F; letter-spacing:-0.5px; line-height:1;">
                        Sikarir</div>
                    <div
                        style="font-size:7px; font-weight:700; color:#94a3b8; letter-spacing:0.2em; text-transform:uppercase;">
                        LAPORAN TES RIASEC</div>
                </div>
            </div>
            <div style="text-align:right;">
                <div
                    style="font-size:7px; font-weight:700; color:#94a3b8; text-transform:uppercase; letter-spacing:0.1em;">
                    Tanggal Tes</div>
                <div style="font-size:10px; font-weight:700; color:#1e293b;">
                    {{ $tes->created_at->translatedFormat('d F Y') }}</div>
            </div>
        </div>

        {{-- IDENTITAS SISWA --}}
        <div
            style="display:flex; justify-content:space-between; gap:16px; margin-bottom:12px; padding:10px 14px; background:#f8fafc; border-radius:10px; border:1px solid #f1f5f9;">

            {{-- KIRI (VERTIKAL) --}}
            <div style="display:flex; flex-direction:column; gap:8px; flex:1;">
                <div>
                    <div class="label">Nama Siswa</div>
                    <div style="font-size:13px; font-weight:800; color:#1e293b; text-transform:uppercase;">
                        {{ $tes->siswa->nama_lengkap }}
                    </div>
                </div>

                <div>
                    <div class="label">Kelas</div>
                    <div style="font-size:12px; font-weight:700; color:#1e293b;">
                        {{ $tes->siswa->kelas ?? '-' }}
                    </div>
                </div>

                <div>
                    <div class="label">Jenis Kelamin</div>
                    <div style="font-size:12px; font-weight:700; color:#1e293b;">
                        {{ $tes->siswa->jenis_kelamin ?? '-' }}
                    </div>
                </div>
            </div>

            {{-- KANAN (TIPE KEPRIBADIAN) --}}
            <div
                style="flex:1; display:flex; flex-direction:column; justify-content:center; align-items:center; text-align:center;">
                <div class="label">Tipe Kepribadian</div>
                <div style="font-size:36px; font-weight:900; color:#2E6C9F; line-height:1;">
                    {{ $kodeKombinasi }}
                </div>
                <div style="font-size:10px; color:#64748b; font-weight:600; margin-top:2px;">
                    {{ $top3->pluck('nama_kepribadian')->implode(' · ') }}
                </div>
            </div>
        </div>

        {{-- HEADER KEDUA KOLOM --}}
        <div style="display:grid; grid-template-columns:1.6fr 1fr; gap:12px; margin-bottom:6px;">

            <div class="label">
                <i class="fas fa-user" style="color:#2E6C9F; font-size:8px;"></i> Profil Kepribadian
            </div>

            <div class="label">
                <i class="fas fa-chart-bar" style="color:#2E6C9F; font-size:8px;"></i> Spektrum Skor
            </div>

        </div>

        {{-- ISI GRID --}}
        <div style="display:grid; grid-template-columns:1.6fr 1fr; gap:12px; margin-bottom:12px;">

            {{-- KIRI --}}
            <div style="display:flex; flex-direction:column; gap:7px;">
                @foreach ($top3 as $kep)
                    <div
                        style="display:flex; gap:8px; align-items:flex-start; padding:8px 10px; background:#f8fafc; border-radius:8px; border:1px solid #f1f5f9;">
                        <div
                            style="width:22px; height:22px; background-color:#2E6C9F; border-radius:6px; display:flex; align-items:center; justify-content:center; color:white; font-size:10px; font-weight:900; flex-shrink:0;">
                            {{ $kep->kode_kepribadian }}
                        </div>
                        <div>
                            <div style="font-size:9.5px; font-weight:800; color:#1e293b; margin-bottom:2px;">
                                {{ $kep->nama_kepribadian }}
                            </div>
                            <div style="font-size:8.5px; color:#64748b; line-height:1.5;" class="line-clamp-3">
                                {{ $kep->deskripsi }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- KANAN --}}
            <div
                style="padding:10px 14px; background:#f8fafc; border-radius:10px; border:1px solid #f1f5f9; display:flex; flex-direction:column; justify-content:center; gap:14px;">

                @foreach ($top3 as $hasil)
                    @php $persen = max(0, min(100, $hasil->cf_total * 100)); @endphp
                    <div>
                        <div
                            style="display:flex; justify-content:space-between; align-items:center; margin-bottom:4px;">
                            <div style="display:flex; align-items:center; gap:5px;">
                                <span
                                    style="width:16px; height:16px; background-color:#2E6C9F; border-radius:4px; display:flex; align-items:center; justify-content:center; color:white; font-size:7.5px; font-weight:900;">
                                    {{ $hasil->kode_kepribadian }}
                                </span>
                                <span style="font-size:9px; font-weight:700; color:#475569;">
                                    {{ $hasil->nama_kepribadian }}
                                </span>
                            </div>
                            <span style="font-size:10px; font-weight:800; color:#1e293b;">
                                {{ number_format($persen, 2) }}%
                            </span>
                        </div>
                        <div class="bar-track">
                            <div class="bar-fill" style="width:{{ $persen }}%;"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- REKOMENDASI KARIR --}}
        <div style="flex:1; overflow:hidden;">
            <div class="label" style="margin-bottom:8px;"><i class="fas fa-briefcase"
                    style="color:#2E6C9F; font-size:8px;"></i> Rekomendasi Karir</div>

            @if ($rekomendasiKarir && $rekomendasiKarir->count() > 0)
                <div style="display:flex; flex-direction:column; gap:20px;">
                    @foreach ($top3 as $kep)
                        @php $karirTipe = $rekomendasiKarir->get($kep->id_kepribadian, collect())->take(8); @endphp
                        @if ($karirTipe->count() > 0)
                            <div>
                                <div style="display:flex; align-items:center; gap:6px; margin-bottom:10px;">
                                    <span
                                        style="width:18px; height:18px; background-color:#2E6C9F; border-radius:5px; display:flex; align-items:center; justify-content:center; color:white; font-size:8px; font-weight:900; flex-shrink:0;">{{ $kep->kode_kepribadian }}</span>
                                    <span
                                        style="font-size:9px; font-weight:800; color:#1e293b;">{{ $kep->nama_kepribadian }}</span>
                                    <span style="font-size:8px; color:#94a3b8;">—
                                        {{ number_format($kep->cf_total * 100, 2) }}% kesesuaian</span>
                                </div>
                                <div style="display:grid; grid-template-columns:repeat(4, 1fr); gap:10px;">
                                    @foreach ($karirTipe as $karir)
                                        <div
                                            style="padding:14px 12px; background:#f8fafc; border:1px solid #f1f5f9; border-radius:8px; min-height:46px; display:flex; align-items:center;">
                                            <div
                                                style="font-size:9px; font-weight:700; color:#1e293b; text-align:left; line-height:1.4;">
                                                {{ $karir->nama_karir }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @if (!$loop->last)
                                <div style="border-top:1px solid #f1f5f9;"></div>
                            @endif
                        @endif
                    @endforeach
                </div>
            @else
                <div style="font-size:10px; color:#94a3b8; font-style:italic;">Belum ada rekomendasi karir.</div>
            @endif
        </div>
    </div>

    {{-- PERBAIKAN 4: Script handlePrint dengan delay + tunggu semua asset siap --}}
    <script>
        function handlePrint() {
            const loading = document.getElementById('print-loading');
            loading.classList.add('show');

            // Tunggu semua gambar selesai load
            const images = document.querySelectorAll('img');
            const imagePromises = Array.from(images).map(img => {
                if (img.complete && img.naturalWidth > 0) return Promise.resolve();
                return new Promise(resolve => {
                    img.onload = resolve;
                    img.onerror = resolve; // tetap lanjut meski gambar gagal load
                });
            });

            // Tunggu semua font selesai load
            const fontPromise = document.fonts ? document.fonts.ready : Promise.resolve();

            Promise.all([...imagePromises, fontPromise]).then(() => {
                // Tambah delay 800ms untuk memastikan semua render siap di mobile
                setTimeout(() => {
                    loading.classList.remove('show');
                    window.print();
                }, 800);
            });
        }

        // Sembunyikan loading overlay jika print dialog ditutup
        window.onafterprint = function() {
            document.getElementById('print-loading').classList.remove('show');
        };
    </script>

</body>

</html>
