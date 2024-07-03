<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Models\Guru;
use Illuminate\Http\RedirectResponse;

use App\Models\Mapel;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $mapel = mapel::all(); // Perbaiki pemanggilan model mapel
        return view('mapel.index')->with('mapel', $mapel);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $gurus = Guru::pluck('nama_guru', 'nip');
    return view('mapel.create', compact('gurus'));
    }

    public function store(Request $request): RedirectResponse // Ubah tipe balikan
    {
    // Validasi input yang diterima dari formulir
    $validatedData = $request->validate([
        'nip' => 'required', // Pastikan 'nip' tidak boleh kosong
        'nama_mapel' => 'required',
    ]);

    // Buat instance mapel dengan data yang divalidasi
    mapel::create($validatedData);

    return redirect()->route('admin.mapel.index')->with('flash_message', 'mapel Added!'); // Gunakan redirect dari Illuminate\Http\RedirectResponse
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $mapel = mapel::find($id); // Perbaiki pemanggilan model mapel
        return view('mapel.show')->with('mapel', $mapel);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
    $mapel = Mapel::find($id);
    $gurus = Guru::all(); // Menyertakan data guru

    return view('mapel.edit', compact('mapel', 'gurus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $mapel = mapel::find($id); // Perbaiki pemanggilan model mapel
        $input = $request->all();
        $mapel->update($input);
        return redirect()->route('admin.mapel.index')->with('flash_message', 'mapel Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        mapel::destroy($id); // Perbaiki pemanggilan model mapel
        return redirect()->route('admin.mapel.index')->with('flash_message', 'mapel deleted!');
    }
}
