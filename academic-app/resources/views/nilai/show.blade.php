@extends('layouts.app', ['title' => 'Rapor Nilai'])

@section('content')

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h1 class="mb-5">Rapor Nilai</h1>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="heading-small text-muted mb-2">Nama Siswa     : {{ $siswa->nama_siswa }}</h4>
                                <h4 class="heading-small text-muted mb-2">Nomor Induk Siswa : {{ $siswa->nis }}</h4>
                            </div>
                            <div class="col-md-6">
                                @if($nilai->isNotEmpty())
                                    <h4 class="heading-small text-muted mb-2">Semester       : {{ $nilai->first()->semester }}</h4>
                                    <h4 class="heading-small text-muted mb-2">Tahun Ajaran   : {{ $nilai->first()->tahun_ajaran }}</h4>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>No.</th>
                                    <th>Mata Pelajaran</th>
                                    <th>Nilai</th>
                                    <th>Huruf</th>
                                    <th>Predikat</th>
                                    <th>Action</th> <!-- tambahkan kolom Action -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->mapel->nama_mapel }}</td>
                                        <td>{{ $item->total_nilai }}</td>
                                        <td>{{ \App\Http\Controllers\NilaiController::convertToWord($item->total_nilai) }}</td>
                                        <td>{{ $item->predikat }}</td>
                                        <td>
                                            <a href="{{ url('admin/nilai/' . $item->id_nilai . '/edit') }}" title="Edit Nilai">
                                                <button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                            </a>
                                            <form method="POST" action="{{ url('admin/nilai/' . $item->id_nilai) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Siswa" onclick="return confirm('Confirm delete?')"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="2" style="text-align: right;"><strong>Total:</strong></td>
                                    <td>{{ $totalNilai }}</td>
                                    <td colspan="2" style="text-align: right;"><strong>Rata-Rata:</strong></td>
                                    <td>{{ $rataRata }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
