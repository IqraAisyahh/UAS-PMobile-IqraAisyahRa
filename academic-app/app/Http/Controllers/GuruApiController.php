<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Guru;

class GuruApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guru = Guru::all();
        return response()->json($guru, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $nip
     * @return \Illuminate\Http\Response
     */
    public function show($nip)
    {
        $guru = Guru::where('nip', $nip)->first();

        if (!$guru) {
            return response()->json(['message' => 'Guru not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($guru, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input yang diterima dari formulir
        $validatedData = $request->validate([
            'nip' => 'required|unique:gurus,nip',
            'nama_guru' => 'required',
            'tempatlahir_guru' => 'required',
            'tanggallahir_guru' => 'required',
            'jk_guru' => 'required',
            'pendidikan' => 'required',
            'alamat_guru' => 'required',
            'agama_guru' => 'required',
            'notelp_guru' => 'required',
        ]);

        // Buat instance guru dengan data yang divalidasi
        $guru = Guru::create($validatedData);

        return response()->json($guru, Response::HTTP_CREATED);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $nip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nip)
    {
        $guru = Guru::where('nip', $nip)->first();

        if (!$guru) {
            return response()->json(['message' => 'Guru not found'], Response::HTTP_NOT_FOUND);
        }

        // Validasi input yang diterima dari formulir
        $validatedData = $request->validate([
            'nama_guru' => 'required',
            'tempatlahir_guru' => 'required',
            'tanggallahir_guru' => 'required',
            'jk_guru' => 'required',
            'pendidikan' => 'required',
            'alamat_guru' => 'required',
            'agama_guru' => 'required',
            'notelp_guru' => 'required',
        ]);

        // Update guru dengan data yang divalidasi
        $guru->update($validatedData);

        return response()->json($guru, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $nip
     * @return \Illuminate\Http\Response
     */
    public function destroy($nip)
    {
        $guru = Guru::where('nip', $nip)->first();

        if (!$guru) {
            return response()->json(['message' => 'Guru not found'], Response::HTTP_NOT_FOUND);
        }

        $guru->delete();

        return response()->json(['message' => 'Guru deleted successfully'], Response::HTTP_OK);
    }
}
