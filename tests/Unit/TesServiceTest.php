<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\TesService;
use App\Models\Tes;
use App\Models\DetailTes;
use App\Models\Karir;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TesServiceTest extends TestCase
{
    use RefreshDatabase;

    protected TesService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new TesService();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    }

    protected function tearDown(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        parent::tearDown();
    }

    // ================================================================
    // BAGIAN 1: WHITE BOX - simpanTes()
    // ================================================================

    /**
     * BASIS PATH 1 - simpanTes()
     * Jalur: N1 → N2 → N3(Ya/seragam) → N4 → N10
     * Kondisi: Semua jawaban bernilai sama (jawaban seragam)
     * Ekspektasi: Tes disimpan, id_kepribadian = null, nilai_cf_total = 0
     */
    public function test_simpanTes_path1_jawaban_seragam_semua_sama()
    {
        // Arrange
        $id_siswa = 1;
        $jawaban = [
            1 => '0.50',
            2 => '0.50',
            3 => '0.50',
        ];

        Log::shouldReceive('info')->once()->with(\Mockery::pattern('/ditolak karena jawaban seragam/'));

        DB::beginTransaction();

        // Act
        $tes = $this->service->simpanTes($id_siswa, $jawaban);

        // Assert
        $this->assertInstanceOf(Tes::class, $tes);
        $this->assertNull($tes->id_kepribadian, 'id_kepribadian harus null untuk jawaban seragam');
        $this->assertEquals(0, $tes->nilai_cf_total, 'nilai_cf_total harus 0 untuk jawaban seragam');
        $this->assertNull($tes->id_karir, 'id_karir harus null untuk jawaban seragam');

        DB::rollBack();
    }

    /**
     * BASIS PATH 2 - simpanTes()
     * Jalur: N1 → N2 → N3(Tidak/bervariasi) → N5 → N6(Ya/ada dominan) → N7 → N9 → N10
     * Kondisi: Jawaban bervariasi, kepribadian dominan ditemukan, karir tersedia
     * Ekspektasi: Tes disimpan dengan id_kepribadian, nilai_cf_total > 0, id_karir terisi
     */
    public function test_simpanTes_path2_jawaban_bervariasi_dominan_ada_karir_ada()
    {
        // Arrange - siapkan data kepribadian, basis_aturan, pertanyaan, karir di DB
        $kepribadian = \App\Models\Kepribadian::factory()->create(['kode_kepribadian' => 'R']);
        $pertanyaan  = \App\Models\Pertanyaan::factory()->create();
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kepribadian->id_kepribadian,
            'id_pertanyaan'  => $pertanyaan->id_pertanyaan,
            'cf_pakar'       => 0.8,
        ]);
        Karir::factory()->create(['id_kepribadian' => $kepribadian->id_kepribadian]);

        $jawaban = [
            $pertanyaan->id_pertanyaan => '0.75',
            // tambah variasi agar tidak seragam
        ];
        // pastikan tidak seragam dengan dummy pertanyaan lain
        $pertanyaan2 = \App\Models\Pertanyaan::factory()->create();
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kepribadian->id_kepribadian,
            'id_pertanyaan'  => $pertanyaan2->id_pertanyaan,
            'cf_pakar'       => 0.6,
        ]);
        $jawaban[$pertanyaan2->id_pertanyaan] = '0.50';

        // Act
        $tes = $this->service->simpanTes(1, $jawaban);

        // Assert
        $this->assertNotNull($tes->id_kepribadian, 'id_kepribadian harus terisi');
        $this->assertGreaterThan(0, $tes->nilai_cf_total, 'CF total harus > 0');
        $this->assertNotNull($tes->id_karir, 'id_karir harus terisi');
    }

    /**
     * BASIS PATH 3 - simpanTes()
     * Jalur: N1 → N2 → N3(Tidak) → N5 → N6(Tidak/dominan null) → N8 → N9 → N10
     * Kondisi: Jawaban bervariasi tapi tidak ada data basis_aturan sama sekali
     * Ekspektasi: id_kepribadian = null, nilai_cf_total = 0
     */
    public function test_simpanTes_path3_jawaban_bervariasi_tidak_ada_data_aturan()
    {
        // Arrange - tidak ada basis_aturan di DB
        $jawaban = [
            99 => '0.75',
            98 => '0.25',
        ];

        // Act
        $tes = $this->service->simpanTes(1, $jawaban);

        // Assert
        $this->assertNull($tes->id_kepribadian, 'id_kepribadian harus null jika tidak ada data');
        $this->assertEquals(0, $tes->nilai_cf_total);
        $this->assertNull($tes->id_karir);
    }

    /**
     * BASIS PATH 4 - simpanTes()
     * Jalur: N1 → N2 → N3(Tidak) → N5 → N6(Ya/dominan ada) → N7(karir null) → N9 → N10
     * Kondisi: Jawaban bervariasi, dominan ada, tapi tidak ada karir untuk kepribadian tersebut
     * Ekspektasi: id_kepribadian terisi, id_karir = null
     */
    public function test_simpanTes_path4_dominan_ada_karir_tidak_ada()
    {
        // Arrange - kepribadian ada, basis_aturan ada, TAPI tidak ada karir
        $kepribadian = \App\Models\Kepribadian::factory()->create(['kode_kepribadian' => 'I']);
        $pertanyaan  = \App\Models\Pertanyaan::factory()->create();
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kepribadian->id_kepribadian,
            'id_pertanyaan'  => $pertanyaan->id_pertanyaan,
            'cf_pakar'       => 0.9,
        ]);
        // Sengaja TIDAK membuat Karir untuk kepribadian ini

        $pertanyaan2 = \App\Models\Pertanyaan::factory()->create();
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kepribadian->id_kepribadian,
            'id_pertanyaan'  => $pertanyaan2->id_pertanyaan,
            'cf_pakar'       => 0.7,
        ]);

        $jawaban = [
            $pertanyaan->id_pertanyaan  => '1.00',
            $pertanyaan2->id_pertanyaan => '0.25',
        ];

        // Act
        $tes = $this->service->simpanTes(1, $jawaban);

        // Assert
        $this->assertNotNull($tes->id_kepribadian, 'id_kepribadian harus terisi');
        $this->assertNull($tes->id_karir, 'id_karir harus null karena karir tidak ada');
    }

    // ================================================================
    // BAGIAN 2: WHITE BOX - hitungHasilKepribadian()
    // ================================================================

    /**
     * BASIS PATH 1 - hitungHasilKepribadian()
     * Jalur: N1 → N2(query kosong) → N3(tidak ada iterasi) → N9 → N10
     * Kondisi: id_tes tidak memiliki detail atau tidak ada basis_aturan
     * Ekspektasi: Collection kosong
     */
    public function test_hitungHasil_path1_tidak_ada_data_aturan()
    {
        // Arrange - buat tes tanpa detail yang cocok dengan basis_aturan
        $tes = Tes::factory()->create();

        // Act
        $hasil = $this->service->hitungHasilKepribadian($tes->id_tes);

        // Assert
        $this->assertTrue($hasil->isEmpty(), 'Hasil harus kosong jika tidak ada data aturan');
    }

    /**
     * BASIS PATH 2 - hitungHasilKepribadian()
     * Jalur: N1→N2→N3→N4→N5(index=0/pertama)→N6→N8→N9→N10
     * Kondisi: 1 kepribadian, 1 gejala saja (index pertama = 0)
     * Ekspektasi: cf_total = cf_pakar * cf_user (rumus index pertama)
     */
    public function test_hitungHasil_path2_satu_kepribadian_satu_gejala_index_pertama()
    {
        // Arrange
        $kepribadian = \App\Models\Kepribadian::factory()->create(['kode_kepribadian' => 'R']);
        $pertanyaan  = \App\Models\Pertanyaan::factory()->create();
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kepribadian->id_kepribadian,
            'id_pertanyaan'  => $pertanyaan->id_pertanyaan,
            'cf_pakar'       => 0.8,
        ]);
        $tes    = Tes::factory()->create();
        DetailTes::factory()->create([
            'id_tes'         => $tes->id_tes,
            'id_pertanyaan'  => $pertanyaan->id_pertanyaan,
            'nilai_cf_user'  => 0.75,
        ]);

        // Act
        $hasil = $this->service->hitungHasilKepribadian($tes->id_tes);

        // Assert
        $this->assertFalse($hasil->isEmpty());
        $cfExpected = 0.8 * 0.75; // index pertama: cf_total = cf_pakar * cf_user
        $this->assertEqualsWithDelta(
            $cfExpected,
            $hasil->first()->cf_total,
            0.0001,
            'CF index pertama harus = cf_pakar * cf_user'
        );
    }

    /**
     * BASIS PATH 3 - hitungHasilKepribadian()
     * Jalur: N1→N2→N3→N4→N5(index>0/bukan pertama)→N7→N8→N9→N10
     * Kondisi: 1 kepribadian, 2 gejala (iterasi kedua = kombinasi CF)
     * Ekspektasi: cf_total menggunakan rumus kombinasi CF
     */
    public function test_hitungHasil_path3_satu_kepribadian_dua_gejala_kombinasi_cf()
    {
        // Arrange
        $kepribadian = \App\Models\Kepribadian::factory()->create(['kode_kepribadian' => 'I']);
        $p1 = \App\Models\Pertanyaan::factory()->create();
        $p2 = \App\Models\Pertanyaan::factory()->create();

        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kepribadian->id_kepribadian,
            'id_pertanyaan'  => $p1->id_pertanyaan,
            'cf_pakar'       => 0.8,
        ]);
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kepribadian->id_kepribadian,
            'id_pertanyaan'  => $p2->id_pertanyaan,
            'cf_pakar'       => 0.6,
        ]);

        $tes = Tes::factory()->create();
        DetailTes::factory()->create([
            'id_tes' => $tes->id_tes,
            'id_pertanyaan' => $p1->id_pertanyaan,
            'nilai_cf_user' => 0.75,
        ]);
        DetailTes::factory()->create([
            'id_tes' => $tes->id_tes,
            'id_pertanyaan' => $p2->id_pertanyaan,
            'nilai_cf_user' => 0.50,
        ]);

        // Hitung manual rumus CF kombinasi
        $cf1 = 0.8 * 0.75;                          // index 0: 0.6
        $cf2 = 0.6 * 0.50;                          // gejala ke-2: 0.3
        $cfExpected = $cf1 + ($cf2 * (1 - $cf1));   // kombinasi: 0.6 + (0.3 * 0.4) = 0.72

        // Act
        $hasil = $this->service->hitungHasilKepribadian($tes->id_tes);

        // Assert
        $this->assertEqualsWithDelta(
            $cfExpected,
            $hasil->first()->cf_total,
            0.0001,
            'CF kombinasi harus = cf_lama + cf_baru*(1-cf_lama)'
        );
    }

    /**
     * BASIS PATH 4 - hitungHasilKepribadian()
     * Jalur: Multi kepribadian → loop → sort RIASEC → return
     * Kondisi: 3 kepribadian berbeda, harus diurutkan berdasar cf_total desc, lalu RIASEC
     * Ekspektasi: Urutan output sesuai cf_total tertinggi
     */
    public function test_hitungHasil_path4_multi_kepribadian_urut_cf_desc()
    {
        // Arrange
        $kR = \App\Models\Kepribadian::factory()->create(['kode_kepribadian' => 'R']);
        $kI = \App\Models\Kepribadian::factory()->create(['kode_kepribadian' => 'I']);
        $kA = \App\Models\Kepribadian::factory()->create(['kode_kepribadian' => 'A']);

        $pR = \App\Models\Pertanyaan::factory()->create();
        $pI = \App\Models\Pertanyaan::factory()->create();
        $pA = \App\Models\Pertanyaan::factory()->create();

        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kR->id_kepribadian,
            'id_pertanyaan' => $pR->id_pertanyaan,
            'cf_pakar' => 0.9,
        ]);
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kI->id_kepribadian,
            'id_pertanyaan' => $pI->id_pertanyaan,
            'cf_pakar' => 0.5,
        ]);
        \App\Models\BasisAturan::factory()->create([
            'id_kepribadian' => $kA->id_kepribadian,
            'id_pertanyaan' => $pA->id_pertanyaan,
            'cf_pakar' => 0.7,
        ]);

        $tes = Tes::factory()->create();
        DetailTes::factory()->create(['id_tes' => $tes->id_tes, 'id_pertanyaan' => $pR->id_pertanyaan, 'nilai_cf_user' => 1.0]);
        DetailTes::factory()->create(['id_tes' => $tes->id_tes, 'id_pertanyaan' => $pI->id_pertanyaan, 'nilai_cf_user' => 0.5]);
        DetailTes::factory()->create(['id_tes' => $tes->id_tes, 'id_pertanyaan' => $pA->id_pertanyaan, 'nilai_cf_user' => 0.75]);

        // Act
        $hasil = $this->service->hitungHasilKepribadian($tes->id_tes);

        // Assert - urutan harus: R(0.9) > A(0.525) > I(0.25)
        $this->assertEquals(3, $hasil->count(), 'Harus ada 3 kepribadian');
        $this->assertEquals('R', $hasil->first()->kode_kepribadian, 'Kepribadian R harus dominan (CF tertinggi)');
        $this->assertGreaterThan(
            $hasil->last()->cf_total,
            $hasil->first()->cf_total,
            'cf_total harus terurut descending'
        );
    }

    // ================================================================
    // BAGIAN 3: WHITE BOX - hitungCFUser()
    // ================================================================

    /**
     * BASIS Path tunggal - hitungCFUser()
     * V(G) = 1 (tidak ada percabangan)
     * Fungsi hanya cast ke float, uji berbagai tipe input
     */

    public function test_hitungCFUser_string_float_dikembalikan_sebagai_float()
    {
        $this->assertSame(0.75, $this->service->hitungCFUser('0.75'));
        $this->assertSame(0.0,  $this->service->hitungCFUser('0.00'));
        $this->assertSame(1.0,  $this->service->hitungCFUser('1.00'));
        $this->assertSame(0.5,  $this->service->hitungCFUser(0.5));
    }

    public function test_hitungCFUser_tipe_return_selalu_float()
    {
        $result = $this->service->hitungCFUser('0.25');
        $this->assertIsFloat($result, 'Return type harus float');
    }

    // ================================================================
    // BAGIAN 4: PENGUJIAN RUMUS CF (Verifikasi matematis)
    // ================================================================

    /**
     * Verifikasi rumus CF kombinasi secara matematis murni
     * CF_gabungan = CF_lama + CF_baru * (1 - CF_lama)
     */
    public function test_rumus_cf_kombinasi_dua_gejala()
    {
        // Arrange
        $cf_pakar1  = 0.8;
        $cf_user1   = 0.75;
        $cf_pakar2  = 0.6;
        $cf_user2   = 0.50;

        $cf_gejala1 = $cf_pakar1 * $cf_user1; // 0.6
        $cf_gejala2 = $cf_pakar2 * $cf_user2; // 0.3

        // Rumus kombinasi
        $cf_expected = $cf_gejala1 + ($cf_gejala2 * (1 - $cf_gejala1)); // 0.72

        $this->assertEqualsWithDelta(0.72, $cf_expected, 0.0001);
    }

    /**
     * Verifikasi rumus CF kombinasi tiga gejala
     */
    public function test_rumus_cf_kombinasi_tiga_gejala()
    {
        $cf1 = 0.8 * 0.75;                             // 0.6
        $cf2 = 0.6 * 0.50;                             // 0.3
        $cf3 = 0.7 * 1.00;                             // 0.7

        $cfGabungan12 = $cf1 + ($cf2 * (1 - $cf1));    // 0.72
        $cfGabungan123 = $cfGabungan12 + ($cf3 * (1 - $cfGabungan12)); // 0.72 + (0.7 * 0.28) = 0.916

        $this->assertEqualsWithDelta(0.916, $cfGabungan123, 0.0001);
    }

    /**
     * Verifikasi mapping reverseMapping di simpanTes
     * Pastikan nilai CF user dipetakan ke jawaban (1-5) dengan benar
     */
    public function test_reverse_mapping_nilai_cf_ke_jawaban()
    {
        $reverseMapping = [
            '0.00' => 1,
            '0.25' => 2,
            '0.50' => 3,
            '0.75' => 4,
            '1.00' => 5,
        ];

        foreach ($reverseMapping as $cfValue => $expectedJawaban) {
            $key    = number_format((float) $cfValue, 2);
            $result = $reverseMapping[$key] ?? 3;
            $this->assertEquals(
                $expectedJawaban,
                $result,
                "CF $cfValue harus dipetakan ke jawaban $expectedJawaban"
            );
        }
    }

    /**
     * Edge case: nilai CF di luar mapping → fallback ke 3 (Cukup Sesuai)
     */
    public function test_reverse_mapping_nilai_tidak_dikenal_fallback_ke_3()
    {
        $reverseMapping = [
            '0.00' => 1,
            '0.25' => 2,
            '0.50' => 3,
            '0.75' => 4,
            '1.00' => 5,
        ];

        $nilaiTidakDikenal = '0.99';
        $key    = number_format((float) $nilaiTidakDikenal, 2);
        $result = $reverseMapping[$key] ?? 3;

        $this->assertEquals(3, $result, 'Nilai tidak dikenal harus fallback ke 3');
    }

    // ================================================================
    // BAGIAN 5: PENGUJIAN DETAIL TES (penyimpanan jawaban)
    // ================================================================

    /**
     * Pastikan semua jawaban tersimpan ke tabel detail_tes
     */
    public function test_simpanTes_semua_jawaban_tersimpan_di_detail_tes()
    {
        // Arrange
        $id_siswa = 1;
        $jawaban  = [
            10 => '0.75',
            11 => '0.25',
            12 => '0.50',
        ];

        // Act
        $tes = $this->service->simpanTes($id_siswa, $jawaban);

        // Assert
        $this->assertDatabaseCount('detail_tes', 3);
        $this->assertDatabaseHas('detail_tes', [
            'id_tes'        => $tes->id_tes,
            'id_pertanyaan' => 10,
            'jawaban'       => 4,   // 0.75 → index 4
            'nilai_cf_user' => 0.75,
        ]);
    }
}
