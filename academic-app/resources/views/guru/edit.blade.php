@extends('layouts.app', ['title' => 'Edit  guru'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Edit Guru</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/guru/' . $guru->nip) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="{{ $guru->nip }}" required readonly>
                            </div>

                            <div class="form-group">
                                <label for="nama_guru">Nama Guru</label>
                                <input type="text" class="form-control" id="nama_guru" name="nama_guru" value="{{ $guru->nama_guru }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tempatlahir_guru">Tempat Lahir</label>
                                <input type="text" class="form-control" id="tempatlahir_guru" name="tempatlahir_guru" value="{{ $guru->tempatlahir_guru }}" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggallahir_guru">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="tanggallahir_guru" name="tanggallahir_guru" value="{{ $guru->tanggallahir_guru }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jk_guru">Jenis Kelamin</label>
                                <select class="form-control" id="jk_guru" name="jk_guru" required>
                                    <option value="L" {{ $guru->jk_guru === 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $guru->jk_guru === 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="pendidikan">Pendidikan</label>
                                <input type="text" class="form-control" id="pendidikan" name="pendidikan" value="{{ $guru->pendidikan }}" required>
                            </div>

                            <div class="form-group">
                                <label for="alamat_guru">Alamat</label>
                                <textarea class="form-control" id="alamat_guru" name="alamat_guru" required>{{ $guru->alamat_guru }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="agama_guru">Agama</label>
                                <input type="text" class="form-control" id="agama_guru" name="agama_guru" value="{{ $guru->agama_guru }}" required>
                            </div>

                            <div class="form-group">
                                <label for="no_telp">No Telp</label>
                                <input type="text" class="form-control" id="notelp_guru" name="notelp_guru" value="{{ $guru->notelp_guru }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
