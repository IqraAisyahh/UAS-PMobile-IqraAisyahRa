@extends('layouts.app', ['title' => 'Kelas'])

@section('content')
<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
<div class="row mt-5">
    <div class="container-fluid mt--7">
        <div class="card bg-default shadow">
            <div class="card-header bg-transparent border-0">
                <h1 class="text-white mb-0">Daftar Siswa Kelas</h1>
                <h3 class="text-white mb-0">{{ $kelas->kelas }} {{ $kelas->nama_kelas }}</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIS</th>
                            <th scope="col">Nama Siswa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $siswaSorted = $siswa->sortBy('nama_siswa');
                        @endphp
                        @foreach($siswaSorted as $key => $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td> <!-- Nomor urut berdasarkan urutan abjad -->
                            <td>{{ $s->nis }}</td> <!-- NIS Siswa -->
                            <td>{{ $s->nama_siswa }}</td> <!-- Nama Siswa -->
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
