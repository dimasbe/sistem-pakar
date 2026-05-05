<?php
// app/Models/BasisAturan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasisAturan extends Model
{
    use HasFactory;

    protected $table = 'basis_aturan';
    protected $primaryKey = 'id_aturan';
    public $timestamps = true;

    protected $fillable = [
        'id_pertanyaan',
        'id_kepribadian',
        'cf_pakar',
    ];

    protected $casts = [
        'cf_pakar' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Pertanyaan (Belongs To)
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan', 'id_pertanyaan');
    }

    // Relasi ke Kepribadian (Belongs To)
    public function kepribadian()
    {
        return $this->belongsTo(Kepribadian::class, 'id_kepribadian', 'id_kepribadian');
    }
}
