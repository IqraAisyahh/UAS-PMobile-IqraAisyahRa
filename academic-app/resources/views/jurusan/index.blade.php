@extends('layouts.app', ['title' => 'Jurusan'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ url('admin/jurusan/create') }}" class="btn btn-success">Add Data</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Daftar Jurusan</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID Jurusan</th>
                                    <th scope="col">Nama Jurusan</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jurusan as $data)
                                <tr>
                                    <td>{{ $data->id_jurusan }}</td>
                                    <td>{{ $data->nama_jurusan }}</td>
                                    <!-- Tambahkan baris untuk kolom lain -->
                                    <td>
                                        <a href="{{ url('admin/jurusan/' . $data->id_jurusan . '/edit') }}" title="Edit Siswa">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                        </a>
                                        <form method="POST" action="{{ url('admin/jurusan/' . $data->id_jurusan) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Siswa" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
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
