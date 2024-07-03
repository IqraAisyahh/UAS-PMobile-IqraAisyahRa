@extends('layouts.app', ['title' => 'Siswa'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row mb-3">
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Detail Siswa</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <strong>NIS:</strong> {{ $siswa->nis }} <br>
                                <strong>Nama Siswa:</strong> {{ $siswa->nama_siswa }} <br>
                                <strong>Tempat Lahir:</strong> {{ $siswa->tempat_lahir }} <br>
                                <strong>Tanggal Lahir:</strong> {{ $siswa->tanggal_lahir }} <br>
                                <strong>Jenis Kelamin:</strong>
                                @if($siswa->jenis_kelamin === 'L')
                                    Laki-laki
                                @elseif($siswa->jenis_kelamin === 'P')
                                    Perempuan
                                @else
                                    N/A
                                @endif
                                <br>
                                <strong>Agama:</strong> {{ $siswa->agama }} <br>
                                <strong>Alamat:</strong> {{ $siswa->alamat }} <br>
                                <strong>No Telp:</strong> {{ $siswa->no_telp }} <br>
                                <strong>Kelas:</strong> {{ $siswa->kelas->kelas }} {{ $siswa->kelas->nama_kelas }} <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
