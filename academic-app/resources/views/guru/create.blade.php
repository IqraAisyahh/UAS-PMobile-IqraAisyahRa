@extends('layouts.app', ['title' => 'Tambah guru'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Tambah guru</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/guru') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" required>
                            </div>

                            <div class="form-group">
                                <label for="nama_guru">Nama guru</label>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" required>
                            </div>

                            <div class="form-group">
                                <label for="tempatlahir_guru">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatlahir_guru" name="tempatlahir_guru" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggallahir_guru">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggallahir_guru" name="tanggallahir_guru" required>
                            </div>

                            <div class="form-group">
                                <label for="jk_guru">Jenis Kelamin</label>
                                <select class="form-control" id="jk_guru" name="jk_guru" required>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan" name="pendidikan" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat_guru">Alamat</label>
                                <textarea class="form-control" id="alamat_guru" name="alamat_guru" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="agama_guru">Agama</label>
                                <input type="text" class="form-control" id="agama_guru" name="agama_guru" required>
                            </div>

                            <div class="form-group">
                                <label for="notelp_guru">No Telp</label>
                                <input type="text" class="form-control" id="notelp_guru" name="notelp_guru" required>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.guru.store') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Tambah guru</button>
                                </form>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
