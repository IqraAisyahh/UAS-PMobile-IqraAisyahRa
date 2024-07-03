<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $table = 'nilai';
    protected $primaryKey = 'id_nilai';

    protected $fillable = [

        'nis', 'nip', 'id_mapel', 'tahun_ajaran', 'semester','nilai_uh', 'nilai_uts', 'nilai_uas', 'nilai_praktek', 'total_nilai', 'predikat',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nis', 'nis');
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'nip', 'nip');
    }


}

