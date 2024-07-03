@extends('layouts.app', ['title' => 'Guru'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ url('admin/guru/create') }}" class="btn btn-success">Add Data</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Daftar Guru</h3>

                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">NIP</th>
                                    <th scope="col">Nama guru</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Agama</th>
                                    <th scope="col">No Telp</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($guru as $data)
                                <tr>
                                    <td>{{ $data->nip }}</td>
                                    <td>{{ $data->nama_guru }}</td>
                                    <td>
                                        @if($data->jk_guru === 'L')
                                            Laki-laki
                                        @elseif($data->jk_guru === 'P')
                                            Perempuan
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $data->alamat_guru }}</td>
                                    <td>{{ $data->agama_guru}}</td>
                                    <td>{{ $data->notelp_guru }}</td>
                                    <td>
                                        <a href="{{ url('admin/guru/' . $data->nip) }}" title="Show Guru">
                                            <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Show</button>
                                        </a>
                                        <a href="{{ url('admin/guru/' . $data->nip . '/edit') }}" title="Edit guru">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-pen cil-square-o" aria-hidden="true"></i> Edit</button>
                                        </a>

                                        <form method="POST" action="{{ url('admin/guru/' . $data->nip) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete guru" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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
