<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepribadian extends Model
{
    use HasFactory;

    protected $table = 'kepribadian';
    protected $primaryKey = 'id_kepribadian';
    public $timestamps = true;

    protected $fillable = [
        'kode_kepribadian',
        'nama_kepribadian',
        'deskripsi',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Karir (One to Many)
    public function karir()
    {
        return $this->hasMany(Karir::class, 'id_kepribadian', 'id_kepribadian');
    }

    // Relasi ke Basis Aturan (One to Many)
    public function basisAturan()
    {
        return $this->hasMany(BasisAturan::class, 'id_kepribadian', 'id_kepribadian');
    }
}
