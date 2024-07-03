<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Kelas;

class NilaiApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nilai = Nilai::all();
        return response()->json($nilai, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nis' => 'required',
            'nip' => 'required',
            'id_mapel' => 'required',
            'nilai_uh' => 'numeric',
            'nilai_uts' => 'numeric',
            'nilai_uas' => 'numeric',
            'nilai_praktek' => 'numeric',
            'tahun_ajaran' => 'required',
            'semester' => 'required|in:1,2',
        ]);

        // Lakukan penyimpanan data jika validasi berhasil
        $nilai = Nilai::create($validatedData);

        return response()->json($nilai, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */

    public function searchApi(Request $request): JsonResponse
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
            return response()->json(['error' => 'Data nilai tidak ditemukan'], 404);
        }

        return response()->json($nilai, 200);
    }

    public function show(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nis' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required|in:1,2',
        ]);

        // Cari data nilai berdasarkan NIS, tahun ajaran, dan semester
        $nilai = Nilai::where('nis', $validatedData['nis'])
            ->where('tahun_ajaran', $validatedData['tahun_ajaran'])
            ->where('semester', $validatedData['semester'])
            ->get();

        // Jika data nilai tidak ditemukan, kembalikan respons dengan pesan error
        if ($nilai->isEmpty()) {
            return response()->json(['error' => 'Data nilai tidak ditemukan'], 404);
        }

        // Mendapatkan data siswa berdasarkan NIS
        $siswa = Siswa::where('nis', $validatedData['nis'])->first();

        // Menghitung total nilai dan rata-rata nilai
        $totalNilai = 0;
        $jumlahMapel = 0;

        foreach ($nilai as $item) {
            $totalNilai += $item->total_nilai;
            $jumlahMapel++;
        }

        $rataRata = $jumlahMapel > 0 ? $totalNilai / $jumlahMapel : 0;

        // Membuat respons JSON dengan data siswa dan nilai
        return response()->json([
            'siswa' => $siswa,
            'nilai' => $nilai,
            'total_nilai' => $totalNilai,
            'rata_rata' => $rataRata,
        ], 200);
    }

    public function getReport()
    {
        $user = Auth::user();
        $nis = $user->nis;

        $nilai = \DB::table('nilais')->where('nis', $nis)->get();

        return response()->json($report);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nilai_uh' => 'required',
            'nilai_uts' => 'required',
            'nilai_uas' => 'required',
            'nilai_praktek' => 'required',
            'tahun_ajaran' => 'required',
            'semester' => 'required|in:1,2',
        ]);

        $nilai = Nilai::findOrFail($id);
        $nilai->update($validatedData);

        return response()->json($nilai, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return response()->json(['message' => 'Nilai deleted successfully'], Response::HTTP_OK);
    }
}
