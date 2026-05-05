<?php
// app/Models/Pertanyaan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;

    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    public $timestamps = true;

    protected $fillable = [
        'teks_pertanyaan',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Basis Aturan (One to Many)
    public function basisAturan()
    {
        return $this->hasMany(BasisAturan::class, 'id_pertanyaan', 'id_pertanyaan');
    }

    // Relasi ke Detail Tes (One to Many)
    public function detailTes()
    {
        return $this->hasMany(DetailTes::class, 'id_pertanyaan', 'id_pertanyaan');
    }
}
