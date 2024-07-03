@extends('layouts.app')

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6">
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('admin.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Tambah Jadwal</h3>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.jadwal.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_kelas" class="id_kelas">Kelas</label>
                            <select class="form-control" id="id_kelas" name="id_kelas" required>
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $dataKelas)
                                    <option value="{{ $dataKelas->id_kelas }}">{{ $dataKelas->kelas }} {{ $dataKelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_mapel" class="id_mapel">Mata Pelajaran</label>
                            <select class="form-control" id="id_mapel" name="id_mapel" required>
                                <option value="">Pilih Mata Pelajaran</option>
                                @foreach($mapel as $dataMapel)
                                    <option value="{{ $dataMapel->id_mapel }}">{{ $dataMapel->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="semester" >Semester</label>
                            <select class="form-control" id="semester" name="semester" required>
                                <option value="">Pilih Semester</option>
                                <option value="1">Semester 1</option>
                                <option value="2">Semester 2</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="jumlah_jam">Jumlah Jam</label>
                            <input type="number" class="form-control" id="jumlah_jam" name="jumlah_jam" min="1" max="8" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
