<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Str;

class SiswaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $siswa = Siswa::all();
        return response()->json($siswa);
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
            'nis' => 'required|unique:siswas,nis',
            'nama_siswa' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'kelas' => 'required'
        ]);

        $kelas = $request->input('kelas');
        $kelasModel = Kelas::where('id_kelas', $kelas)->first();

        if (!$kelasModel) {
            return response()->json(['error' => 'Kelas tidak valid'], Response::HTTP_BAD_REQUEST);
        }

        $validatedData['id_kelas'] = $kelasModel->id_kelas;
        $validatedData['nama_kelas'] = $this->generateRandomNamaKelas($kelasModel->nama_kelas);

        $siswa = Siswa::create($validatedData);

        return response()->json($siswa, Response::HTTP_CREATED);
    }

    // Method untuk menghasilkan string acak untuk nama_kelas
    private function generateRandomNamaKelas($kelas)
    {
        return $kelas . ' ' . Str::random(2); // Misalnya, "X MIPA 1"
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $nis
     * @return \Illuminate\Http\Response
     */
    public function show($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        return response()->json($siswa);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $nis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nis)
    {
        $validatedData = $request->validate([
            'nama_siswa' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'id_kelas' => 'nullable|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($nis);
        $siswa->fill($validatedData)->save();

        return response()->json($siswa, Response::HTTP_OK);
    }

    public function verify(Request $request)
    {
        $nis = $request->input('nis');
        $siswa = Siswa::where('nis', $nis)->first();

        if ($siswa) {
            return response()->json([
                'success' => true,
                'data' => $siswa
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'NIS not found'
            ], 404);
        }
    }

    public function updateNIS(Request $request)
    {
        $nis = $request->input('nis');
        $siswa = Siswa::where('nis', $nis)->first();

        if ($siswa) {
            return response()->json([
                'success' => false,
                'message' => 'NIS sudah ada, tidak dapat diubah.'
            ], 400);
        }

        // Update NIS jika belum ada
        $siswa = Siswa::find($request->input('id'));
        $siswa->nis = $nis;
        $siswa->save();

        return response()->json([
            'success' => true,
            'message' => 'NIS berhasil diupdate.'
        ]);
    }

    public function showByNis($nis)
    {
        $siswa = Siswa::where('nis', $nis)->first();

        if (!$siswa) {
            return response()->json(['error' => 'Siswa not found'], 404);
        }

        return response()->json(['data' => $siswa], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $nis
     * @return \Illuminate\Http\Response
     */
    public function destroy($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        $siswa->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
