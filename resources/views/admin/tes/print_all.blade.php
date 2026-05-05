<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Hasil Tes Siswa - SMAN 1 Genteng</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #e5e5e5;
            font-size: 10pt;
        }

        .container {
            background-color: #fff;
            width: 210mm;
            min-height: 297mm;
            margin: 15px auto;
            padding: 20mm;
            box-sizing: border-box;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 25px;
        }

        .header-text {
            text-align: center;
        }

        .header h3 {
            margin: 0;
            font-size: 11pt;
            font-weight: normal;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header h2 {
            margin: 2px 0;
            font-size: 15pt;
            font-weight: bold;
        }

        .header p {
            margin: 0;
            font-size: 8.5pt;
            color: #444;
        }

        .report-title {
            text-align: center;
            font-size: 11pt;
            font-weight: bold;
            text-transform: uppercase;
            text-decoration: underline;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th {
            background-color: #f8fafc !important;
            color: #000;
            font-size: 8.5pt;
            font-weight: bold;
            padding: 10px 6px;
            border: 1px solid #999;
            text-transform: uppercase;
        }

        table td {
            border: 1px solid #ccc;
            padding: 8px 6px;
            font-size: 8.5pt;
            vertical-align: middle;
        }

        table tbody tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid;
        }

        .text-center {
            text-align: center;
        }

        .uppercase {
            text-transform: uppercase;
        }

        .font-bold {
            font-weight: bold;
        }

        .footer-sign {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
            page-break-inside: avoid;
        }

        .sign-box {
            width: 220px;
            text-align: center;
            font-size: 9.5pt;
        }

        .btn {
            position: fixed;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 9pt;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .btn-close {
            top: 25px;
            left: 25px;
            background: white;
            color: #374151;
            border: 1px solid #ddd;
        }

        .btn-close:hover {
            background: #f9fafb;
            border-color: #bbb;
            transform: translateY(-1px);
        }

        .btn-print {
            top: 25px;
            right: 25px;
            background: #2E6C9F;
            color: white;
            border: none;
        }

        .btn-print:hover {
            background: #23527a;
            transform: translateY(-1px);
        }

        @media print {
            body {
                background: none;
                margin: 0 !important;
            }

            .container {
                margin: 0;
                width: 100%;
                padding: 0;
                box-shadow: none;
            }

            .btn {
                display: none;
            }

            table th {
                background-color: #f8fafc !important;
                -webkit-print-color-adjust: exact;
                print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <button onclick="window.close()" class="btn btn-close">
        <i class="fas fa-arrow-left"></i> KEMBALI
    </button>

    <button onclick="window.print()" class="btn btn-print">
        <i class="fas fa-print"></i> CETAK LAPORAN
    </button>

    <div class="container">
        <div class="header">
            <div class="header-text">
                <h3>PEMERINTAH PROVINSI JAWA TIMUR • DINAS PENDIDIKAN</h3>
                <h2>SMA NEGERI 1 GENTENG</h2>
                <p>Jl. KH. Wahid Hasyim No. 20, Genteng, Kab. Banyuwangi, Jawa Timur 68465</p>
                <p>Website: sman1genteng.sch.id | Email: info@sman1genteng.sch.id</p>
            </div>
        </div>

        <div class="report-title">
            Rekapitulasi Hasil Tes Kepribadian Siswa
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 4%;">No</th>
                    <th style="width: 12%;">Tanggal</th>
                    <th>Nama Lengkap</th>
                    <th style="width: 5%;">L/P</th>
                    <th style="width: 10%;">Kelas</th>
                    <th style="width: 10%;">Kode</th>
                    <th style="width: 20%;">Hasil Tertinggi</th>
                    <th style="width: 10%;">Skor</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tesList as $index => $item)
                    @php $hasil = $hasilKombinasi[$item->id_tes] ?? null; @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="uppercase font-bold">{{ $item->siswa->nama_lengkap ?? 'N/A' }}</td>
                        <td class="text-center">{{ strtoupper(substr($item->siswa->jenis_kelamin ?? '-', 0, 1)) }}</td>
                        <td class="text-center">{{ $item->siswa->kelas ?? '-' }}</td>
                        <td class="text-center font-bold" style="letter-spacing: 2px; font-size: 9.5pt;">
                            {{ $hasil['kode'] ?? '-' }}
                        </td>
                        <td class="text-center font-bold">
                            {{ $hasil['nama_dominan'] ?? 'N/A' }}
                        </td>
                        <td class="text-center">
                            @if ($hasil && $hasil['cf'] > 0)
                                {{ number_format($hasil['cf'] * 100, 2) }}%
                            @else
                                <span style="color:#999;">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 30px;">Data tidak ditemukan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="footer-sign">
            <div class="sign-box">
                <p>Genteng, {{ \Carbon\Carbon::now('Asia/Jakarta')->locale('id')->translatedFormat('d F Y') }}</p>
                <p>Petugas Administrasi,</p>
                <div style="height: 65px;"></div>
                <p><strong>{{ Auth::user()->name ?? 'Administrator' }}</strong></p>
                <p style="border-top: 1.5px solid #000; margin-top: 2px; padding-top: 2px;">NIP.
                    .............................</p>
            </div>
        </div>
    </div>
</body>

</html>
