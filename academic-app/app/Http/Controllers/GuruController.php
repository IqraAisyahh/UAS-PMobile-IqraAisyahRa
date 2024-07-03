<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Guru;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $guru = Guru::all();
        return view('guru.index')->with('guru', $guru);
    }

    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('guru.show', compact('guru'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guru.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
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
    Guru::create($validatedData);

    return redirect()->route('admin.guru.index')->with('flash_message', 'Guru Added!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nip): View
    {
    $guru = Guru::where('nip', $nip)->first();

    return view('guru.edit')->with('guru', $guru);

    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nip): RedirectResponse
    {
    $guru = Guru::where('nip', $nip)->first();
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

    $guru->update($validatedData);

    return redirect()->route('admin.guru.index')->with('flash_message', 'Guru Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip): RedirectResponse
    {
        Guru::destroy($nip);
        return redirect()->route('admin.guru.index')->with('flash_message', 'Guru deleted!');
    }
}
