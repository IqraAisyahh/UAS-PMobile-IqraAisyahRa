<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;

class JadwalApiController extends Controller
{
    public function index()
    {
        // Ambil semua jadwal beserta mapel dan kelas terkait
        $jadwals = Jadwal::with(['mapel', 'kelas'])->get();

        return response()->json(['jadwals' => $jadwals], 200);
    }

    public function create()
    {
        $kelas = Kelas::all();
        $mapels = Mapel::all();
        return response()->json(['nama_kelas' => $kelas, 'mapels' => $mapels], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kelas' => 'required',
            'id_mapel' => 'required',
            'semester' => 'required',
            'jumlah_jam' => 'required|numeric|min:1|max:8', // Maximum 8 lesson hours
        ]);

        $id_kelas = $request->input('id_kelas');
        $jumlah_jam = $request->input('jumlah_jam');

        // Jika jumlah jam lebih dari 3, bagi menjadi dua bagian
        if ($jumlah_jam > 3) {
            // Bagian pertama: 3 jam pada hari-hari berbeda
            $this->storeJadwalToDatabase($request->all(), 3);

            // Bagian kedua: sisanya ditempatkan pada hari-hari berbeda yang tersisa
            $this->storeJadwalToDatabase($request->all(), $jumlah_jam - 3);
        } else {
            // Jika jumlah jam tidak lebih dari 3, simpan langsung ke database
            $this->storeJadwalToDatabase($request->all(), $jumlah_jam);
        }

        return response()->json(['message' => 'Jadwal berhasil ditambahkan.'], 201);
    }

    public function show($id_kelas)
    {
        $jadwals = Jadwal::with(['mapel', 'kelas'])->where('id_kelas', $id_kelas)->get();
        return response()->json(['jadwals' => $jadwals], 200);
    }

    public function edit($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        $jadwals = Jadwal::with(['mapel', 'kelas'])->where('id_kelas', $id_kelas)->get();
        return response()->json(['kelas' => $kelas, 'jadwals' => $jadwals], 200);
    }

    public function destroy($id_kelas)
    {
        Jadwal::where('id_kelas', $id_kelas)->delete();
        return response()->json(['message' => 'Semua jadwal untuk kelas ini berhasil dihapus.'], 200);
    }

    private function storeJadwalToDatabase($data, $jumlah_jam)
    {
        // Implementasikan logika untuk menyimpan data jadwal ke database sesuai kebutuhan
    }
}
