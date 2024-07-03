@extends('layouts.app', ['title' => 'Mapel'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ url('admin/mapel/create') }}" class="btn btn-success">Add Data</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Daftar Mapel</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID mapel</th>
                                    <th scope="col">Mata Pelajaran</th>
                                    <th scope="col">Nama Guru</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($mapel as $data)
                                <tr>
                                    <td>{{ $data->id_mapel }}</td>
                                    <td>{{ $data->nama_mapel}}</td>
                                    <td>
                                        @if($data->guru)
                                            {{ $data->guru->nama_guru }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ url('admin/mapel/' . $data->id_mapel . '/edit') }}" title="Edit Mapel">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                        </a>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
