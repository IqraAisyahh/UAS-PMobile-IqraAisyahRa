<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Jurusan;
use App\Models\Kelas;

class KelasController extends Controller
{
    public function index(): View
    {
        $kelas = Kelas::all();
        return view('kelas.index')->with('kelas', $kelas);
    }

    public function create()
    {
        $jurusans = Jurusan::pluck('nama_jurusan', 'id_jurusan');
        return view('kelas.create', compact('jurusans'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'id_jurusan' => 'required',
            'kelas' => 'required',
            'nama_kelas' => 'required',
        ]);

        Kelas::create($validatedData);

        return redirect()->route('admin.kelas.index')->with('flash_message', 'Kelas Added!');
    }

    public function show($id)
    {
        $kelas = Kelas::find($id);
        $siswa = $kelas->siswas; // Menggunakan relasi siswas() untuk mendapatkan koleksi siswa dari kelas tersebut
        return view('kelas.show', compact('kelas', 'siswa'));
    }

    public function edit(string $id): View
    {
        $kelas = Kelas::find($id);
        $jurusans = Jurusan::all();

        return view('kelas.edit', compact('kelas', 'jurusans'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $kelas = Kelas::find($id);
        $input = $request->all();
        $kelas->update($input);
        return redirect()->route('admin.kelas.index')->with('flash_message', 'Kelas Updated!');
    }

    public function destroy(string $id): RedirectResponse
    {
        try {
            Kelas::destroy($id);
            Alert::success('Success', 'Kelas berhasil dihapus.');
        } catch (\Illuminate\Database\QueryException $e) {
            $errorCode = $e->errorInfo[1];
            if ($errorCode == 1451) { // Kode kesalahan untuk Integrity constraint violation
                Alert::error('Error', 'Tidak dapat menghapus kelas ini karena terdapat jadwal yang terkait dengan kelas ini. Harap hapus jadwal terlebih dahulu sebelum mencoba menghapus kelas.');
            } else {
                Alert::error('Error', 'Terjadi kesalahan saat menghapus kelas.');
            }
        }

        return redirect()->route('admin.kelas.index');
    }

}
