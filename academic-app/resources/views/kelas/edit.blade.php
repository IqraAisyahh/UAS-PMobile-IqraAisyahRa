@extends('layouts.app', ['title' => 'Edit Kelas'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Edit Kelas</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.kelas.update', $kelas->id_kelas) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="id_jurusan" class="id_jurusan">ID Jurusan</label>
                                <select class="form-control" name="id_jurusan" id="id_jurusan">
                                    @foreach($jurusans as $jurusan)
                                        <option value="{{ $jurusan->id_jurusan }}" {{ $jurusan->id_jurusan == $kelas->id_jurusan ? 'selected' : '' }}>
                                            {{ $jurusan->nama_jurusan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="kelas">Kelas</label>
                                <select class="form-control" id="kelas" name="kelas" required>
                                    <option value="" selected disabled>Pilih Kelas</option>
                                    <option value="X">X</option>
                                    <option value="XI">XI</option>
                                    <option value="XII">XII</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nama_kelas" class="nama_kelas">Nama Kelas</label>
                                <input class="form-control" type="text" name="nama_kelas" id="nama_kelas" value="{{ $kelas->nama_kelas }}">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Kelas</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
