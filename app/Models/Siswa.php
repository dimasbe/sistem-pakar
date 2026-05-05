<?php


namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Siswa extends Authenticatable
{
    use HasFactory;

    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    public $timestamps = true;

    protected $fillable = [
        'email',
        'nama_lengkap',
        'kelas',
        'jenis_kelamin',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi ke Tes (One to Many)
    public function tes()
    {
        return $this->hasMany(Tes::class, 'id_siswa', 'id_siswa');
    }
}
