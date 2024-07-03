<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::with('mapel')->get();
        $kelas = Kelas::all();

        $groupedJadwals = $jadwals->groupBy('hari');

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamPelajaran = [
            "07:30:00 - 08:20:00",
            "08:20:00 - 09:10:00",
            "09:10:00 - 10:00:00",
            "10:00:00 - 10:20:00",
            "10:20:00 - 11:10:00",
            "11:10:00 - 12:00:00",
            "12:00:00 - 13:00:00",
            "13:00:00 - 13:50:00",
            "13:50:00 - 14:40:00",
            "14:40:00 - 15:30:00"
        ];

        return view('jadwal.index', compact('jadwals', 'kelas', 'groupedJadwals', 'hari', 'jamPelajaran'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $mapel = Mapel::all();

        return view('jadwal.create', compact('kelas', 'mapel'));
    }

    public function store(Request $request)
{

    $request->validate([
        'id_kelas' => 'required',
        'id_mapel' => 'required',
        'semester' => 'required',
        'jumlah_jam' => 'required|numeric|min:1|max:8',
    ]);

    $id_kelas = $request->input('id_kelas');

    if ($this->isJadwalPenuh($id_kelas)) {
        return redirect()->route('admin.jadwal.index')->with('error', 'Jadwal pada kelas ini sudah penuh');
    }

    $jumlah_jam = $request->input('jumlah_jam');

    if ($jumlah_jam > 3) {
        $this->storeJadwalToDatabase($request, 3);
        $this->storeJadwalToDatabase($request, $jumlah_jam - 3);
    } else {
        $this->storeJadwalToDatabase($request, $jumlah_jam);
    }

    return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
}

private function storeJadwalToDatabase($request, $jumlah_jam)
{
    $id_kelas = $request->id_kelas;
    $id_mapel = $request->id_mapel;
    $semester = $request->semester;

    $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    $jamPelajaran = [
        "07:30:00 - 08:20:00",
        "08:20:00 - 09:10:00",
        "09:10:00 - 10:00:00",
        "10:00:00 - 10:20:00",
        "10:20:00 - 11:10:00",
        "11:10:00 - 12:00:00",
        "12:00:00 - 13:00:00",
        "13:00:00 - 13:50:00",
        "13:50:00 - 14:40:00",
        "14:40:00 - 15:30:00"
    ];

    shuffle($hari);

    $scheduledHours = [];
    foreach ($jamPelajaran as $jam) {
        $scheduledHours[$jam] = 0;
    }

    foreach ($hari as $h) {
        if ($jumlah_jam <= 0) {
            break;
        }

        foreach ($jamPelajaran as $jam) {
            if ($scheduledHours[$jam] >= 3) {
                continue;
            }

            if ($jumlah_jam <= 0) {
                break 2;
            }

            $jadwalExist = Jadwal::where('id_kelas', $id_kelas)
                ->where('hari', $h)
                ->where('jam_masuk', explode(' - ', $jam)[0])
                ->first();

            if (!$jadwalExist) {
                $newJadwal = new Jadwal();
                $newJadwal->id_kelas = $id_kelas;
                $newJadwal->id_mapel = $id_mapel;
                $newJadwal->semester = $semester;
                $newJadwal->hari = $h;
                $newJadwal->jam_masuk = explode(' - ', $jam)[0];
                $newJadwal->jam_keluar = explode(' - ', $jam)[1];
                $newJadwal->save();

                $scheduledHours[$jam]++;
                $jumlah_jam--;

                if ($jumlah_jam <= 0) {
                    break 2;
                }
            }
        }
    }
}


    private function isJadwalPenuh($id_kelas)
    {
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamPelajaran = [
            "07:30:00 - 08:20:00",
            "08:20:00 - 09:10:00",
            "09:10:00 - 10:00:00",
            "10:00:00 - 10:20:00",
            "10:20:00 - 11:10:00",
            "11:10:00 - 12:00:00",
            "12:00:00 - 13:00:00",
            "13:00:00 - 13:50:00",
            "13:50:00 - 14:40:00",
            "14:40:00 - 15:30:00"
        ];

        foreach ($hari as $h) {
            foreach ($jamPelajaran as $jam) {
                $jadwalExist = Jadwal::where('id_kelas', $id_kelas)
                    ->where('hari', $h)
                    ->where('jam_masuk', explode(' - ', $jam)[0])
                    ->exists();

                if (!$jadwalExist) {
                    return false;
                }
            }
        }

        return true;
    }

    public function show($id_kelas)
    {
        $kelas = Kelas::find($id_kelas);

        if (!$kelas) {
            return redirect()->route('admin.jadwal.index')->with('error', 'Kelas tidak ditemukan.');
        }

        $jadwals = Jadwal::where('id_kelas', $id_kelas)->get();

        // Mengelompokkan jadwal berdasarkan hari
        $groupedJadwals = [];
        foreach ($jadwals as $jadwal) {
            if (!isset($groupedJadwals[$jadwal->hari])) {
                $groupedJadwals[$jadwal->hari] = [];
            }
            $groupedJadwals[$jadwal->hari][] = $jadwal;
        }

        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        $jamPelajaran = [
            "07:30:00 - 08:20:00",
            "08:20:00 - 09:10:00",
            "09:10:00 - 10:00:00",
            "10:00:00 - 10:20:00",
            "10:20:00 - 11:10:00",
            "11:10:00 - 12:00:00",
            "12:00:00 - 13:00:00",
            "13:00:00 - 13:50:00",
            "13:50:00 - 14:40:00",
            "14:40:00 - 15:30:00"
        ];

        return view('jadwal.show', compact('jadwals', 'kelas', 'groupedJadwals', 'hari', 'jamPelajaran'));
    }


    public function edit($id_kelas)
    {
        $kelas = Kelas::findOrFail($id_kelas);
        // Mengambil jadwal untuk kelas tertentu
        $jadwals = Jadwal::where('id_kelas', $id_kelas)->get();
        return view('jadwal.edit', compact('jadwals', 'kelas'));
    }

    public function update(Request $request, $id_kelas)
    {
        $request->validate([
            'id_mapel' => 'required',
            'semester' => 'required',
        ]);

        // Mengambil jadwal untuk kelas tertentu
        $jadwals = Jadwal::where('id_kelas', $id_kelas)->get();
        foreach ($jadwals as $jadwal) {
            $jadwal->id_mapel = $request->id_mapel;
            $jadwal->semester = $request->semester;
            $jadwal->save();
        }

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id_kelas)
    {

        Jadwal::where('id_kelas', $id_kelas)->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.jadwal.index')->with('success', 'Semua jadwal untuk kelas ini berhasil dihapus.');
    }

}
