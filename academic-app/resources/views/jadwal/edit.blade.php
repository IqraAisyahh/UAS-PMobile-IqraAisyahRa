@extends('layouts.app', ['title' => 'Edit Jadwal'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Edit Jadwal</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/jadwal/' . $jadwal->id_jadwal) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="id_kelas">Kelas</label>
                                <select class="form-control" id="id_kelas" name="id_kelas" required>
                                    @foreach($kelas as $kelas)
                                        <option value="{{ $kelas->id_kelas }}" {{ $jadwal->kelas->id_kelas == $kelas->id_kelas ? 'selected' : '' }}>{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_mapel">Mapel</label>
                                <select class="form-control" id="id_mapel" name="id_mapel" required>
                                    @foreach($mapel as $mapel)
                                        <option value="{{ $mapel->id_mapel }}" {{ $jadwal->mapel->id_mapel == $mapel->id_mapel ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="hari">Hari</label>
                                <input type="text" class="form-control" id="hari" name="hari" value="{{ $jadwal->hari }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jam_masuk">Jam Masuk</label>
                                <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" value="{{ $jadwal->jam_masuk }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jam_keluar">Jam Keluar</label>
                                <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" value="{{ $jadwal->jam_keluar }}" required>
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="text" class="form-control" id="semester" name="semester" value="{{ $jadwal->semester }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
