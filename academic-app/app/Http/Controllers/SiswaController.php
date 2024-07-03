<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Support\Str;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::all();
        return view('siswa.index')->with('siswa', $siswa);
    }

    public function create()
    {
        return view('siswa.create');
    }

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
            'kelas' => 'required|in:X,XI,XII'
        ]);

        // Mendapatkan kelas utama yang dipilih
        $kelas = $request->input('kelas');

        // Menemukan sub-kelas berdasarkan kelas utama yang dipilih secara acak
        $kelasModel = Kelas::where('kelas', $kelas)->inRandomOrder()->first();

        if (!$kelasModel) {
            return redirect()->back()->withErrors(['kelas' => 'Kelas tidak valid']);
        }

        // Menetapkan ID kelas dan nama kelas yang dipilih secara acak
        $validatedData['id_kelas'] = $kelasModel->id_kelas;
        $validatedData['nama_kelas'] = $kelasModel->nama_kelas;

        // Menyimpan data siswa ke dalam database
        Siswa::create($validatedData);

        return redirect()->route('admin.siswa.index')->with('flash_message', 'Siswa Added!');
    }

    public function show($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        return view('siswa.show', compact('siswa'));
    }

    public function edit($nis)
    {
        $siswa = Siswa::findOrFail($nis);
        $kelas = Kelas::pluck('nama_kelas', 'id_kelas');
        return view('siswa.edit', compact('siswa', 'kelas'));
    }

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
            'id_kelas' => 'nullable|exists:kelas,id_kelas',
        ]);

        $siswa = Siswa::findOrFail($nis);
        $siswa->fill($validatedData)->save();

        return redirect()->route('admin.siswa.index')->with('flash_message', 'Siswa Updated!');
    }

    public function destroy($nis)
    {
        Siswa::findOrFail($nis)->delete();
        return redirect()->route('admin.siswa.index')->with('flash_message', 'Siswa deleted!');
    }
}
