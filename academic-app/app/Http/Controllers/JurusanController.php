<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use App\Models\Jurusan;
use Illuminate\View\View;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jurusan = Jurusan::all();
        return view ('jurusan.index')->with('jurusan', $jurusan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validasi input yang diterima dari formulir
        $validatedData = $request->validate([
            'nama_jurusan' => 'required',
        ]);

        // Buat instance siswa dengan data yang divalidasi
        Jurusan::create($validatedData);

        return redirect()->route('admin.jurusan.index')->with('flash_message', 'Jurusan Added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $jurusan = Jurusan::find($id);
        return view('jurusan.show')->with('jurusan', $jurusan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $jurusan = Jurusan::find($id);
        return view('jurusan.edit')->with('jurusan', $jurusan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $jurusan = Jurusan::find($id);
        $input = $request->all();
        $jurusan->update($input);
        return redirect()->route('admin.jurusan.index')->with('flash_message', 'jurusan Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Jurusan::destroy($id);
        return redirect()->route('admin.jurusan.index')->with('flash_message', 'jurusan deleted!');
    }
}
