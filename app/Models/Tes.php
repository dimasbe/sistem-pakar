<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tes extends Model
{
    use HasFactory;

    protected $table = 'tes';
    protected $primaryKey = 'id_tes';
    public $timestamps = true;

    // Tambahkan kolom baru agar bisa disimpan oleh Service
    protected $fillable = [
        'id_siswa',
        'tanggal_tes',
        'id_kepribadian',
        'nilai_cf_total',
        'id_karir',
    ];

    protected $casts = [
        'tanggal_tes' => 'datetime',
        'nilai_cf_total' => 'float', // Memastikan nilai desimal tetap presisi saat dipanggil
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // --- Relasi ---

    // Relasi ke Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    // Relasi ke Kepribadian (Hasil Dominan)
    public function kepribadian()
    {
        return $this->belongsTo(Kepribadian::class, 'id_kepribadian', 'id_kepribadian');
    }

    // Relasi ke Karir (Rekomendasi Utama)
    public function karir()
    {
        return $this->belongsTo(Karir::class, 'id_karir', 'id_karir');
    }

    // Relasi ke Detail Tes (Jawaban per soal)
    public function detailTes()
    {
        return $this->hasMany(DetailTes::class, 'id_tes', 'id_tes');
    }
}
