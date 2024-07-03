@extends('layouts.app', ['title' => 'Edit Mapel'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Edit Mapel</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.mapel.update', $mapel->id_mapel) }}">
                            <div class="form-group">
                                <label for="nama_mapel" class="nama_mapel">Mata Pelajaran</label>
                                <input class="form-control" type="text" name="nama_mapel" id="nama_mapel" value="{{ $mapel->nama_mapel }}">
                            </div>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nip" class="nip">Guru</label>
                                <select class="form-control" name="nip" id="nip">
                                    @foreach($gurus as $guru)
                                        <option value="{{ $guru->nip }}" {{ $guru->nip == $mapel->nip ? 'selected' : '' }}>
                                            {{ $guru->nama_guru }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Mapel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
