<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Mapel;

class MapelApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mapel = Mapel::with('guru')->get(); // Assuming 'guru' is the relationship method name

        return response()->json($mapel, Response::HTTP_OK);
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
            'nip' => 'required',
            'nama_mapel' => 'required',
        ]);

        // Buat instance mapel dengan data yang divalidasi
        $mapel = Mapel::create($validatedData);

        return response()->json($mapel, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return response()->json(['message' => 'Mapel not found'], Response::HTTP_NOT_FOUND);
        }

        return response()->json($mapel, Response::HTTP_OK);
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
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return response()->json(['message' => 'Mapel not found'], Response::HTTP_NOT_FOUND);
        }

        // Validasi input yang diterima dari formulir
        $validatedData = $request->validate([
            'nip' => 'required',
            'nama_mapel' => 'required',
        ]);

        // Update mapel dengan data yang divalidasi
        $mapel->update($validatedData);

        return response()->json($mapel, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapel = Mapel::find($id);

        if (!$mapel) {
            return response()->json(['message' => 'Mapel not found'], Response::HTTP_NOT_FOUND);
        }

        $mapel->delete();

        return response()->json(['message' => 'Mapel deleted successfully'], Response::HTTP_OK);
    }
}
