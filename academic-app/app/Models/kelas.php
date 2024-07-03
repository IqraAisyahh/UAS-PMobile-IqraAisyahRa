<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kelas extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'id_jurusan',
        'kelas',
        'nama_kelas',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'id_jurusan');
    }

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class, 'id_kelas');
    }

    public function siswas()
    {
    return $this->hasMany(Siswa::class, 'id_kelas', 'id_kelas');
    }

}
