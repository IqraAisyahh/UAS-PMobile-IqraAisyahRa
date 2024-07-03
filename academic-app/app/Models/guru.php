<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $primaryKey = 'nip';

    protected $fillable = [
        'nip',
        'nama_guru',
        'tempatlahir_guru',
        'tanggallahir_guru',
        'jk_guru',
        'pendidikan',
        'alamat_guru',
        'agama_guru',
        'notelp_guru',

    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

}
