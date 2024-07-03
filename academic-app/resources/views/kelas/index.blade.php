@extends('layouts.app', ['title' => 'Kelas'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ url('admin/kelas/create') }}" class="btn btn-success">Add Data</a>
            </div>
        </div>
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Daftar Kelas</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">ID Kelas</th>
                                    <th scope="col">Jurusan</th> <!-- Mengubah label kolom -->
                                    <th scope="col">Kelas</th>
                                    <th scope="col">Nama Kelas</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kelas as $data)
                                <tr>
                                    <td>{{ $data->id_kelas }}</td>
                                    <td>
                                        @if($data->jurusan)
                                            {{ $data->jurusan->nama_jurusan }}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $data->kelas }}</td>
                                    <td>{{ $data->nama_kelas }}</td>
                                    <td>
                                        <a href="{{ url('admin/kelas/' . $data->id_kelas) }}" title="Show Siswa">
                                            <button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> Show</button>
                                        </a>
                                        <a href="{{ url('admin/kelas/' . $data->id_kelas . '/edit') }}" title="Edit Siswa">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                        </a>
                                        <form id="delete-form-{{ $data->id_kelas }}" method="POST" action="{{ url('admin/kelas/' . $data->id_kelas) }}" accept-charset="UTF-8" style="display:inline">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="button" class="btn btn-danger btn-sm" title="Delete Siswa" onclick="confirmDelete('{{ $data->id_kelas }}')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if ($message = Session::get('success'))

    <script>
        Swal.fire('{{ $message }}');
    </script>

  @endif
@endsection
