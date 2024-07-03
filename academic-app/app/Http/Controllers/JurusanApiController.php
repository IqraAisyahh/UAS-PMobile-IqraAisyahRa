<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Jurusan;

class JurusanApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jurusan = Jurusan::all();
        return response()->json($jurusan, Response::HTTP_OK);
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
            'nama_jurusan' => 'required',
        ]);

        // Buat instance jurusan dengan data yang divalidasi
        $jurusan = Jurusan::create($validatedData);

        return response()->json($jurusan, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json(['message' => 'Jurusan not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($jurusan, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json(['message' => 'Jurusan not found'], Response::HTTP_NOT_FOUND);
        }

        // Validasi input yang diterima dari formulir
        $validatedData = $request->validate([
            'nama_jurusan' => 'required',
        ]);

        // Update jurusan dengan data yang divalidasi
        $jurusan->update($validatedData);

        return response()->json($jurusan, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jurusan = Jurusan::find($id);

        if (!$jurusan) {
            return response()->json(['message' => 'Jurusan not found'], Response::HTTP_NOT_FOUND);
        }

        $jurusan->delete();

        return response()->json(['message' => 'Jurusan deleted successfully'], Response::HTTP_OK);
    }
}
