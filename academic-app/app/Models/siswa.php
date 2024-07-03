<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';

    protected $primaryKey = 'nis'; // Menetapkan 'nis' sebagai primary key

    protected $fillable = [
        'nis',
        'nama_siswa',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'agama',
        'alamat',
        'no_telp',
        'id_kelas',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'nis', 'nis');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'nis', 'nis');
    }




}
