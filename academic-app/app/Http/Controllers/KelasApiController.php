<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Kelas;

class KelasApiController extends Controller
{
    public function index(): JsonResponse
    {
        $kelas = Kelas::all();
        return response()->json($kelas);
    }

    public function show($id): JsonResponse
    {
        $kelas = Kelas::find($id);
        $siswa = $kelas->siswas;
        return response()->json($kelas);
    }

    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'id_jurusan' => 'required',
            'kelas' => 'required',
            'nama_kelas' => 'required',
        ]);

        $kelas = Kelas::create($validatedData);

        return response()->json($kelas, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $kelas = Kelas::find($id);
        $kelas->update($request->all());

        return response()->json($kelas, 200);
    }

    public function destroy(string $id): JsonResponse
    {
        Kelas::destroy($id);

        return response()->json(null, 204);
    }

}
