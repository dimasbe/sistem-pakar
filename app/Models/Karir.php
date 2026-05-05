<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karir extends Model
{
    use HasFactory;

    protected $table = 'karir';
    protected $primaryKey = 'id_karir';
    public $timestamps = true;

    protected $fillable = [
        'id_kepribadian',
        'nama_karir',
        'deskripsi_karir',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Kepribadian (Belongs To)
    public function kepribadian()
    {
        return $this->belongsTo(Kepribadian::class, 'id_kepribadian', 'id_kepribadian');
    }
}
