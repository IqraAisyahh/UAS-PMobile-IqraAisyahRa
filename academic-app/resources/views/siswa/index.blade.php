@extends('layouts.app', ['title' => 'Siswa'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ url('admin/siswa/create') }}" class="btn btn-success">Add Data</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Daftar Siswa</h3>

                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">NIS</th>
                                    <th scope="col">Nama Siswa</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">No Telp</th>
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($siswa as $data)
                                <tr>
                                    <td>{{ $data->nis }}</td>
                                    <td>{{ $data->nama_siswa }}</td>
                                    <td>
                                        @if($data->jenis_kelamin === 'L')
                                            Laki-laki
                                        @elseif($data->jenis_kelamin === 'P')
                                            Perempuan
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->no_telp }}</td>
                                    <td>{{ $data->kelas->kelas }} {{ $data->kelas->nama_kelas }}</td>
                                    <td>
                                        <a href="{{ url('admin/siswa/' . $data->nis) }}" title="Show Siswa">
                                            <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Show</button>
                                        </a>
                                        <a href="{{ url('admin/siswa/' . $data->nis . '/edit') }}" title="Edit Siswa">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                        </a>
                                        <form method="POST" action="{{ url('admin/siswa/' . $data->nis) }}" accept-charset="UTF-8" style="display:inline">
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
