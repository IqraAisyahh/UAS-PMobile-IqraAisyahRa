<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_mapel';

    protected $fillable = [
        'nama_mapel',
        'nip',
    ];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'nip', 'nip');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id_mapel', 'id_mapel');
    }

}
