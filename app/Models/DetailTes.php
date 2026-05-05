<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTes extends Model
{
    use HasFactory;

    protected $table = 'detail_tes';
    protected $primaryKey = 'id_detail_tes';
    public $timestamps = true;

    protected $fillable = [
        'id_tes',
        'id_pertanyaan',
        'jawaban',
        'nilai_cf_user',
    ];

    protected $casts = [
        'jawaban' => 'float', // UBAH INI dari integer ke float
        'nilai_cf_user' => 'float', // UBAH INI agar konsisten
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Tes
    public function tes()
    {
        return $this->belongsTo(Tes::class, 'id_tes', 'id_tes');
    }

    // Relasi ke Pertanyaan
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }
}
