<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_kelas', 'id_mapel', 'hari', 'jam_masuk', 'jam_keluar', 'semester',
    ];

    /**
     * Get the kelas that owns the jadwal.
     */
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    /**
     * Get the mapel that owns the jadwal.
     */
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel', 'id_mapel');
    }
}
