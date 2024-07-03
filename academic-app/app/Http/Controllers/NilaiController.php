<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;

class NilaiController extends Controller
{
    public function index(Request $request)
    {
        // Inisialisasi query untuk model Siswa
        $siswas = Siswa::query();


        // Cek apakah ada parameter pencarian yang diberikan
        if ($request->filled(['nis', 'tahun_ajaran', 'semester'])) {
            // Ambil nilai dari request
            $nis = $request->input('nis');
            $tahun_ajaran = $request->input('tahun_ajaran');
            $semester = $request->input('semester');

            // Filter siswa berdasarkan NIS
            $siswas->where('nis', $nis);

            // Filter nilai siswa berdasarkan tahun ajaran dan semester
            $siswas->whereHas('nilai', function ($query) use ($tahun_ajaran, $semester) {
                $query->where('tahun_ajaran', $tahun_ajaran)
                    ->where('semester', $semester);
            });
        }

        // Ambil data siswa yang telah difilter
        $siswas = $siswas->get();

        // Ambil data guru dan mapel
        $gurus = Guru::all();
        $mapels = Mapel::all();

        // Return view dengan data siswa, guru, dan mapel
        return view('nilai.index', compact('siswas', 'gurus', 'mapels'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'nis' => 'required',
            'nip' => 'required',
            'id_mapel' => 'required',
            'nilai_uh' => 'numeric',
            'nilai_uts' => 'numeric',
            'nilai_uas' => 'numeric',
            'nilai_praktek' => 'numeric',
            'tahun_ajaran' => 'required', // Validasi untuk tahun ajaran
            'semester' => 'required|in:1,2', // Validasi untuk semester dengan nilai yang diterima hanya 1 atau 2
        ]);

        // Validasi tambahan untuk memastikan satu tahun ajaran hanya memiliki 2 semester (1 dan 2)
        $mapelCount = Nilai::where('nis', $validatedData['nis'])
            ->where('tahun_ajaran', $validatedData['tahun_ajaran'])
            ->whereIn('semester', [1, 2])
            ->count();

        if ($mapelCount >= 10) {
            return redirect()->route('admin.nilai.index')->with('error', 'Satu tahun ajaran hanya dapat memiliki 2 semester (1 dan 2).');
        }

        // Validasi tambahan untuk memastikan di setiap semester hanya ada satu id_mapel
        $existingMapelCount = Nilai::where('nis', $validatedData['nis'])
            ->where('tahun_ajaran', $validatedData['tahun_ajaran'])
            ->where('semester', $validatedData['semester'])
            ->where('id_mapel', $validatedData['id_mapel'])
            ->count();

        if ($existingMapelCount > 0) {
            return redirect()->route('admin.nilai.index')->with('error', 'Tidak bisa menambahkan data dengan id_mapel yang sama dalam satu semester.');
        }

        // Lakukan penyimpanan data jika validasi berhasil
        Nilai::create([
            'nis' => $validatedData['nis'],
            'nip' => $validatedData['nip'],
            'id_mapel' => $validatedData['id_mapel'],
            'nilai_uh' => $validatedData['nilai_uh'],
            'nilai_uts' => $validatedData['nilai_uts'],
            'nilai_uas' => $validatedData['nilai_uas'],
            'nilai_praktek' => $validatedData['nilai_praktek'],
            'tahun_ajaran' => $validatedData['tahun_ajaran'],
            'semester' => $validatedData['semester'],
        ]);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil ditambahkan!');
    }

    public function search(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);

        $nilai = Nilai::where('nis', $validatedData['nis'])
            ->where('tahun_ajaran', $validatedData['tahun_ajaran'])
            ->where('semester', $validatedData['semester'])
            ->get();

        if ($nilai->isEmpty()) {
            return redirect()->back()->with('error', 'Data nilai tidak ditemukan');
        }

        return view('nilai.index', compact('nilai'));
    }

    public function show(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);

        $nilai = Nilai::where('nis', $validatedData['nis'])
            ->where('tahun_ajaran', $validatedData['tahun_ajaran'])
            ->where('semester', $validatedData['semester'])
            ->get();

        if ($nilai->isEmpty()) {
            return redirect()->back()->with('error', 'Data nilai tidak ditemukan');
        }

        // Mendapatkan data siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $validatedData['nis'])->first();

        $tahunAjaran = $validatedData['tahun_ajaran'];
        $semester = $validatedData['semester'];
        $totalNilai = 0;
        $jumlahMapel = 0;

        foreach ($nilai as $item) {
            $item->total_nilai = ($item->nilai_uh * 0.15) + ($item->nilai_uts * 0.25) + ($item->nilai_uas * 0.40) + ($item->nilai_praktek * 0.20);
            $item->total_nilai = round($item->total_nilai);

            if ($item->total_nilai >= 80) {
                $item->predikat = 'A';
            } elseif ($item->total_nilai >= 70) {
                $item->predikat = 'B';
            } elseif ($item->total_nilai >= 60) {
                $item->predikat = 'C';
            } elseif ($item->total_nilai >= 50) {
                $item->predikat = 'D';
            } else {
                $item->predikat = 'E';
            }

            $totalNilai += $item->total_nilai;
            $jumlahMapel++;
        }

        $rataRata = $jumlahMapel > 0 ? $totalNilai / $jumlahMapel : 0;
        $totalNilaiHuruf = $this->convertToWord($totalNilai);

        return view('nilai.show', compact('siswa', 'nilai', 'totalNilai', 'totalNilaiHuruf', 'tahunAjaran', 'semester', 'rataRata'));
    }


    private function convertToLetterGrade($score)
    {
        // Define the letter grades and their score ranges
        $grades = [
            'A' => ['min' => 85, 'max' => 100],
            'B' => ['min' => 70, 'max' => 84],
            'C' => ['min' => 60, 'max' => 69],
            'D' => ['min' => 50, 'max' => 59],
            'E' => ['min' => 0, 'max' => 49],
        ];

        // Find the appropriate letter grade based on the score
        foreach ($grades as $grade => $range) {
            if ($score >= $range['min'] && $score <= $range['max']) {
                return $grade;
            }
        }

        // If the score doesn't fall into any range, return 'E'
        return 'E';
    }

    public static function convertToWord($number)
    {
        // Array untuk mengonversi angka menjadi huruf
        $words = [
            0 => 'Nol',
            1 => 'Satu',
            2 => 'Dua',
            3 => 'Tiga',
            4 => 'Empat',
            5 => 'Lima',
            6 => 'Enam',
            7 => 'Tujuh',
            8 => 'Delapan',
            9 => 'Sembilan',
            10 => 'Sepuluh',
            11 => 'Sebelas',
            12 => 'Dua Belas',
            13 => 'Tiga Belas',
            14 => 'Empat Belas',
            15 => 'Lima Belas',
            16 => 'Enam Belas',
            17 => 'Tujuh Belas',
            18 => 'Delapan Belas',
            19 => 'Sembilan Belas',
            20 => 'dua Puluh',
            30 => 'Tiga Puluh',
            40 => 'Empat Puluh',
            50 => 'Lima Puluh',
            60 => 'Enam Puluh',
            70 => 'Tujuh Puluh',
            80 => 'Delapan Puluh',
            90 => 'Sembilan Puluh',
        ];

        // Mengecek apakah angka kurang dari atau sama dengan 20
        if ($number < 20) {
            return $words[$number] ?? ''; // Gunakan null coalescing operator untuk menangani nilai yang tidak ada
        } elseif ($number < 100) {
            $tens = $words[10 * floor($number / 10)] ?? ''; // Gunakan null coalescing operator untuk menangani nilai yang tidak ada
            $ones = $number % 10;
            return $ones > 0 ? $tens . ' ' . $words[$ones] ?? '' : $tens; // Gunakan null coalescing operator untuk menangani nilai yang tidak ada
        } elseif ($number == 100) {
            return 'seratus';
        } else {
            return 'Angka diluar rentang 1-100';
        }
            return $this->convertToLetterGrade($number);
    }

    public function edit(string $id): View
    {
        $nilai = Nilai::findOrFail($id);
        $siswas = Siswa::all();
        $mapels = Mapel::all();

        return view('nilai.edit', compact('nilai', 'siswas', 'mapels'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $validatedData = $request->validate([
            'nilai_uh' => 'required',
            'nilai_uts' => 'required',
            'nilai_uas' => 'required',
            'nilai_praktek' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update([
            'nilai_uh' => $validatedData['nilai_uh'],
            'nilai_uts' => $validatedData['nilai_uts'],
            'nilai_uas' => $validatedData['nilai_uas'],
            'nilai_praktek' => $validatedData['nilai_praktek'],
            'tahun_ajaran' => $validatedData['tahun_ajaran'], // Perbarui tahun ajaran
            'semester' => $validatedData['semester'], // Perbarui semester
        ]);

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil diperbarui!');
    }

    public function destroy(string $id): RedirectResponse
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect()->route('admin.nilai.index')->with('success', 'Nilai berhasil dihapus!');
    }

}
