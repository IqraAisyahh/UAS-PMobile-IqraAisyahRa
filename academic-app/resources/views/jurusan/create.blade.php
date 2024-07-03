@extends('layouts.app', ['title' => 'Tambah Jurusan'])

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Tambah Jurusan</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.jurusan.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nama_jurusan" class="nama_jurusan">Nama Jurusan</label>
                                <input class="form-control" type="text" name="nama_jurusan" id="nama_jurusan">
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Jurusan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
