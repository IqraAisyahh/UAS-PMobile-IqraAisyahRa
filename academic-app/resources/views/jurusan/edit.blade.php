@extends('layouts.app', ['title' => 'Edit Jurusan'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Edit Jurusan</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.jurusan.update', $jurusan->id_jurusan) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nama_jurusan" class="nama_jurusan">Nama Jurusan</label>
                                <input class="form-control" type="text" name="nama_jurusan" value="{{ $jurusan->nama_jurusan }}" id="nama_jurusan">
                            </div>
                            <button type="submit" class="btn btn-primary">Update Jurusan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
