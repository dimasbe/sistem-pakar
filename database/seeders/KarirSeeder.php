<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KarirSeeder extends Seeder
{
    public function run(): void
    {
        $karirs = [
            // 1. Realistic / Realistis (ID: 1)
            ['id_kepribadian' => 1, 'nama_karir' => 'Insinyur Sipil', 'deskripsi_karir' => 'Merancang, membangun, dan mengawasi proyek infrastruktur seperti jalan, jembatan, dan gedung menggunakan keahlian teknik dan pekerjaan lapangan.'],
            ['id_kepribadian' => 1, 'nama_karir' => 'Pekerja Konstruksi', 'deskripsi_karir' => 'Melaksanakan pekerjaan fisik dalam proyek pembangunan gedung, jalan, dan infrastruktur lainnya menggunakan berbagai alat dan mesin.'],
            ['id_kepribadian' => 1, 'nama_karir' => 'Teknisi Medik', 'deskripsi_karir' => 'Mengoperasikan dan merawat peralatan medis seperti mesin MRI, CT scan, dan alat laboratorium untuk mendukung diagnosis pasien.'],
            ['id_kepribadian' => 1, 'nama_karir' => 'Koki Profesional', 'deskripsi_karir' => 'Mengolah dan menyajikan hidangan dengan teknik memasak yang terampil, memimpin dapur, serta menjaga standar kualitas makanan.'],
            ['id_kepribadian' => 1, 'nama_karir' => 'Teknisi Robotik', 'deskripsi_karir' => 'Merakit, memprogram, mengoperasikan, dan memelihara sistem robot yang digunakan dalam industri manufaktur maupun otomasi.'],
            ['id_kepribadian' => 1, 'nama_karir' => 'Teknisi Listrik', 'deskripsi_karir' => 'Memasang, memperbaiki, dan memelihara instalasi sistem kelistrikan di rumah, gedung, maupun fasilitas industri.'],
            ['id_kepribadian' => 1, 'nama_karir' => 'Pilot', 'deskripsi_karir' => 'Menerbangkan dan mengendalikan pesawat udara untuk mengangkut penumpang atau kargo, serta memastikan keselamatan penerbangan.'],
            ['id_kepribadian' => 1, 'nama_karir' => 'Pekerja Agrikultur', 'deskripsi_karir' => 'Mengelola lahan pertanian, membudidayakan tanaman atau hewan ternak, serta menerapkan teknik modern untuk meningkatkan hasil panen.'],

            // 2. Investigative / Investigatif (ID: 2)
            ['id_kepribadian' => 2, 'nama_karir' => 'Ilmuwan Biologi', 'deskripsi_karir' => 'Meneliti organisme hidup mulai dari tingkat molekuler hingga ekosistem untuk memahami proses kehidupan dan mengembangkan ilmu pengetahuan.'],
            ['id_kepribadian' => 2, 'nama_karir' => 'Ilmuwan Kimia', 'deskripsi_karir' => 'Mempelajari sifat, struktur, dan reaksi zat kimia untuk menciptakan material baru, obat-obatan, atau solusi industri.'],
            ['id_kepribadian' => 2, 'nama_karir' => 'Ilmuwan Fisika', 'deskripsi_karir' => 'Menyelidiki hukum-hukum alam dan fenomena fisika melalui eksperimen dan pemodelan matematis untuk memajukan sains dan teknologi.'],
            ['id_kepribadian' => 2, 'nama_karir' => 'Data Scientist', 'deskripsi_karir' => 'Menganalisis kumpulan data besar menggunakan statistik dan machine learning untuk menghasilkan wawasan yang membantu pengambilan keputusan bisnis.'],
            ['id_kepribadian' => 2, 'nama_karir' => 'Dokter', 'deskripsi_karir' => 'Memeriksa, mendiagnosis, dan mengobati pasien dengan menerapkan pengetahuan medis yang mendalam serta keterampilan analisis klinis.'],
            ['id_kepribadian' => 2, 'nama_karir' => 'Ahli Medis', 'deskripsi_karir' => 'Mendalami bidang kedokteran spesialis tertentu untuk memberikan penanganan medis tingkat lanjut dan riset klinis yang inovatif.'],
            ['id_kepribadian' => 2, 'nama_karir' => 'Peneliti Lingkungan', 'deskripsi_karir' => 'Mengkaji dampak aktivitas manusia terhadap ekosistem dan lingkungan hidup untuk merumuskan solusi pelestarian dan kebijakan lingkungan.'],
            ['id_kepribadian' => 2, 'nama_karir' => 'Programmer', 'deskripsi_karir' => 'Menulis, menguji, dan memperbaiki kode program untuk membangun perangkat lunak, aplikasi, atau sistem yang memecahkan masalah tertentu.'],

            // 3. Artistic / Artistik (ID: 3)
            ['id_kepribadian' => 3, 'nama_karir' => 'Seniman', 'deskripsi_karir' => 'Mengekspresikan ide dan emosi melalui karya seni visual seperti lukisan, patung, atau instalasi seni yang dipamerkan kepada publik.'],
            ['id_kepribadian' => 3, 'nama_karir' => 'Musisi', 'deskripsi_karir' => 'Menciptakan dan membawakan karya musik secara profesional, baik sebagai penampil solo, bagian dari band, maupun komposer untuk berbagai media.'],
            ['id_kepribadian' => 3, 'nama_karir' => 'Desainer Busana', 'deskripsi_karir' => 'Merancang koleksi pakaian dengan memadukan estetika, tren mode, dan fungsi untuk diproduksi secara komersial atau dipamerkan di panggung fashion.'],
            ['id_kepribadian' => 3, 'nama_karir' => 'Aktor', 'deskripsi_karir' => 'Memerankan karakter dalam produksi film, sinetron, teater, atau iklan dengan mengandalkan kemampuan akting, ekspresi, dan penghayatan peran.'],
            ['id_kepribadian' => 3, 'nama_karir' => 'Desainer Interior', 'deskripsi_karir' => 'Merancang tata ruang dalam suatu bangunan agar terlihat estetis dan fungsional sesuai kebutuhan dan selera penghuni atau klien.'],
            ['id_kepribadian' => 3, 'nama_karir' => 'Pembuat Film', 'deskripsi_karir' => 'Mengonsep, memproduksi, dan menyutradarai karya sinematik dari tahap pra-produksi hingga pasca-produksi untuk layar lebar atau platform digital.'],
            ['id_kepribadian' => 3, 'nama_karir' => 'Fotografer', 'deskripsi_karir' => 'Mengabadikan momen dan menciptakan karya seni visual melalui lensa kamera, mencakup fotografi komersial, jurnalistik, maupun seni murni.'],
            ['id_kepribadian' => 3, 'nama_karir' => 'Desainer Grafis', 'deskripsi_karir' => 'Menciptakan konten visual seperti logo, poster, dan materi pemasaran menggunakan perangkat lunak desain untuk menyampaikan pesan secara efektif.'],

            // 4. Social / Sosial (ID: 4)
            ['id_kepribadian' => 4, 'nama_karir' => 'Guru', 'deskripsi_karir' => 'Mendidik dan membimbing siswa di sekolah, menyampaikan materi pelajaran, serta membentuk karakter dan kemampuan berpikir peserta didik.'],
            ['id_kepribadian' => 4, 'nama_karir' => 'Dosen', 'deskripsi_karir' => 'Mengajar mahasiswa di perguruan tinggi, melakukan penelitian ilmiah, dan berkontribusi pada pengembangan keilmuan di bidang yang ditekuni.'],
            ['id_kepribadian' => 4, 'nama_karir' => 'Psikolog', 'deskripsi_karir' => 'Mengkaji perilaku dan proses mental manusia untuk membantu individu mengatasi gangguan psikologis, stres, dan tantangan emosional dalam kehidupan.'],
            ['id_kepribadian' => 4, 'nama_karir' => 'Ahli Terapi', 'deskripsi_karir' => 'Memberikan layanan terapi fisik atau mental kepada pasien untuk membantu pemulihan, meningkatkan fungsi tubuh, dan kualitas hidup mereka.'],
            ['id_kepribadian' => 4, 'nama_karir' => 'Perawat', 'deskripsi_karir' => 'Memberikan asuhan keperawatan langsung kepada pasien, memantau kondisi kesehatan, dan berkolaborasi dengan tim medis dalam proses penyembuhan.'],
            ['id_kepribadian' => 4, 'nama_karir' => 'Konselor', 'deskripsi_karir' => 'Memberikan bimbingan dan dukungan emosional kepada individu atau kelompok yang menghadapi masalah pribadi, karir, maupun hubungan sosial.'],
            ['id_kepribadian' => 4, 'nama_karir' => 'Relawan Organisasi', 'deskripsi_karir' => 'Berkontribusi secara sukarela dalam kegiatan sosial, kemanusiaan, atau lingkungan melalui organisasi nirlaba untuk memberikan dampak positif bagi masyarakat.'],
            ['id_kepribadian' => 4, 'nama_karir' => 'Pelatih atau Mentor', 'deskripsi_karir' => 'Membimbing dan memotivasi individu dalam mengembangkan potensi diri, keterampilan, maupun performa di bidang olahraga, karir, atau kehidupan pribadi.'],

            // 5. Enterprising / Berani Berusaha (ID: 5)
            ['id_kepribadian' => 5, 'nama_karir' => 'Pengusaha', 'deskripsi_karir' => 'Mendirikan dan mengelola bisnis sendiri dengan memanfaatkan peluang pasar, mengelola risiko, serta memimpin tim untuk mencapai tujuan usaha.'],
            ['id_kepribadian' => 5, 'nama_karir' => 'Agen Properti', 'deskripsi_karir' => 'Membantu klien dalam proses jual beli atau sewa properti dengan negosiasi harga, pemasaran aset, dan pengelolaan transaksi secara profesional.'],
            ['id_kepribadian' => 5, 'nama_karir' => 'Digital Marketer', 'deskripsi_karir' => 'Merancang dan menjalankan kampanye pemasaran digital melalui media sosial, SEO, iklan berbayar, dan konten untuk meningkatkan jangkauan dan penjualan.'],
            ['id_kepribadian' => 5, 'nama_karir' => 'Manajer Proyek', 'deskripsi_karir' => 'Merencanakan, mengorganisir, dan memimpin pelaksanaan proyek dari awal hingga selesai sesuai target waktu, anggaran, dan standar kualitas yang ditetapkan.'],
            ['id_kepribadian' => 5, 'nama_karir' => 'Konsultan Bisnis', 'deskripsi_karir' => 'Menganalisis kondisi dan tantangan bisnis klien, lalu memberikan rekomendasi strategis untuk meningkatkan efisiensi, profitabilitas, dan pertumbuhan perusahaan.'],
            ['id_kepribadian' => 5, 'nama_karir' => 'Sales', 'deskripsi_karir' => 'Menjual produk atau layanan kepada pelanggan melalui pendekatan persuasif, membangun relasi, dan memenuhi target penjualan yang telah ditetapkan.'],
            ['id_kepribadian' => 5, 'nama_karir' => 'Pengacara', 'deskripsi_karir' => 'Memberikan konsultasi hukum, mewakili klien di pengadilan, dan menegosiasikan penyelesaian sengketa berdasarkan pemahaman mendalam terhadap sistem hukum.'],
            ['id_kepribadian' => 5, 'nama_karir' => 'Politikus', 'deskripsi_karir' => 'Berpartisipasi aktif dalam dunia politik untuk memengaruhi kebijakan publik, mewakili konstituennya, dan berkontribusi pada pembangunan negara.'],

            // 6. Conventional / Konvensional (ID: 6)
            ['id_kepribadian' => 6, 'nama_karir' => 'Akuntan', 'deskripsi_karir' => 'Menyusun, memeriksa, dan melaporkan laporan keuangan organisasi dengan memastikan akurasi data serta kepatuhan terhadap standar akuntansi yang berlaku.'],
            ['id_kepribadian' => 6, 'nama_karir' => 'Sekretaris', 'deskripsi_karir' => 'Mendukung kelancaran operasional kantor dengan mengelola jadwal, korespondensi, dokumen, dan administrasi pimpinan secara terstruktur dan teliti.'],
            ['id_kepribadian' => 6, 'nama_karir' => 'Administrator', 'deskripsi_karir' => 'Menjalankan fungsi administrasi organisasi meliputi pengelolaan data, koordinasi antar divisi, dan memastikan prosedur operasional berjalan dengan tertib.'],
            ['id_kepribadian' => 6, 'nama_karir' => 'Analis Data', 'deskripsi_karir' => 'Mengumpulkan, mengolah, dan menginterpretasikan data untuk menghasilkan laporan dan wawasan yang mendukung pengambilan keputusan berbasis fakta.'],
            ['id_kepribadian' => 6, 'nama_karir' => 'Petugas Pajak', 'deskripsi_karir' => 'Memproses pelaporan, perhitungan, dan pemungutan pajak sesuai peraturan yang berlaku untuk memastikan kepatuhan wajib pajak individu maupun perusahaan.'],
            ['id_kepribadian' => 6, 'nama_karir' => 'Spesialis Logistik', 'deskripsi_karir' => 'Mengelola rantai pasok, distribusi barang, dan koordinasi pengiriman secara efisien untuk memastikan ketersediaan produk tepat waktu dan tepat sasaran.'],
            ['id_kepribadian' => 6, 'nama_karir' => 'Staf Perbankan', 'deskripsi_karir' => 'Melayani nasabah dalam transaksi keuangan, mengelola rekening, serta memastikan operasional perbankan berjalan sesuai prosedur dan regulasi yang ditetapkan.'],
            ['id_kepribadian' => 6, 'nama_karir' => 'Admin IT', 'deskripsi_karir' => 'Mengelola, memelihara, dan memastikan keamanan infrastruktur teknologi informasi organisasi seperti server, jaringan, dan sistem database secara teratur.'],
        ];

        foreach ($karirs as $karir) {
            DB::table('karir')->insert([
                'id_kepribadian'  => $karir['id_kepribadian'],
                'nama_karir'      => $karir['nama_karir'],
                'deskripsi_karir' => $karir['deskripsi_karir'],
                'created_at'      => now(),
                'updated_at'      => now(),
            ]);
        }
    }
}
