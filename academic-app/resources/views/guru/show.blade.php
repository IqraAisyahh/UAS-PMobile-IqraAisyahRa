@extends('layouts.app', ['title' => 'Detail Guru'])

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Detail Guru</h3>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>NIP:</strong> {{ $guru->nip }}</p>
                                <p><strong>Nama Guru:</strong> {{ $guru->nama_guru }}</p>
                                <p><strong>Tempat Lahir:</strong> {{ $guru->tempatlahir_guru }}</p>
                                <p><strong>Tanggal Lahir:</strong> {{ $guru->tanggallahir_guru }}</p>
                                <p><strong>Jenis Kelamin:</strong> {{ $guru->jk_guru === 'L' ? 'Laki-laki' : 'Perempuan' }}</p>
                                <p><strong>Pendidikan:</strong> {{ $guru->pendidikan }}</p>
                                <p><strong>Alamat:</strong> {{ $guru->alamat_guru }}</p>
                                <p><strong>Agama:</strong> {{ $guru->agama_guru }}</p>
                                <p><strong>No Telp:</strong> {{ $guru->notelp_guru }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
