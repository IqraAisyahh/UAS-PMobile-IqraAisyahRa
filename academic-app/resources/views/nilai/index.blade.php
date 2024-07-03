@extends('layouts.app', ['title' => 'Penilaian Rapor'])

@section('content')
@php
    $nis = old('nis', '');
    $tahun_ajaran = old('tahun_ajaran', '');
    $semester = old('semester', '');
@endphp

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="card-header border-0">
            <div class="row mb-3">
                <div class="col">
                    <form action="{{ route('admin.nilai.search') }}" method="GET">
                        @csrf
                        <!-- Tambahkan input hidden untuk menyertakan parameter yang diperlukan -->
                        <input type="hidden" name="nis" value="{{ $nis }}">
                        <input type="hidden" name="tahun_ajaran" value="{{ $tahun_ajaran }}">
                        <input type="hidden" name="semester" value="{{ $semester }}">

                        <!-- Sisanya tetap seperti sebelumnya -->
                        <div class="form-row">
                            <div class="col-md-3 mb-3">
                                <label for="nis">NIS</label>
                                <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS" value="{{ $nis }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="tahun_ajaran">Tahun Ajaran</label>
                                <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh: 2023/2024" value="{{ $tahun_ajaran }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="semester">Semester</label>
                                <select class="form-control" id="semester" name="semester">
                                    <option value="">Pilih Semester</option>
                                    <option value="1" {{ $semester == '1' ? 'selected' : '' }}>Semester 1</option>
                                    <option value="2" {{ $semester == '2' ? 'selected' : '' }}>Semester 2</option>
                                </select>
                            </div>
                            <div class="col-md-3 mb-3">

                                <button type="submit" class="btn btn-primary mt-4 mr-2">Cari</button>
                                <!-- Tambahkan tombol Lihat Nilai -->
                                @if ($nis && $tahun_ajaran && $semester)
                                <a href="{{ route('admin.nilai.show', ['nis' => $nis, 'tahun_ajaran' => $tahun_ajaran, 'semester' => $semester]) }}">Lihat Nilai</a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="card-header border-0">
                <h3 class="mb-0">Daftar Siswa</h3>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                        <tr>
                            <th>NIS</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($siswas as $siswa)
                            <tr>
                                <td>{{ $siswa->nis }}</td>
                                <td>{{ $siswa->nama_siswa }}</td>
                                <td>{{ $siswa->kelas->nama_kelas }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#inputNilaiModal{{ $siswa->nis }}"> <i class="ni ni-single-copy-04" aria-hidden="true"></i> Input Nilai</button>


                                    <!-- Modal -->
                                    <div class="modal fade" id="inputNilaiModal{{ $siswa->nis }}" tabindex="-1" role="dialog" aria-labelledby="inputNilaiModalLabel{{ $siswa->nis }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="inputNilaiModalLabel{{ $siswa->nis }}">Input Nilai untuk {{ $siswa->nama_siswa }}</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Tempatkan formulir untuk input nilai di sini -->
                                                    <!-- Contoh: -->
                                                    <form action="{{ route('admin.nilai.store') }}" method="POST">
                                                        @csrf

                                                        <!-- Input untuk tahun ajaran -->
                                                        <div class="form-group">
                                                            <label for="tahun_ajaran" class="tahun_ajaran">Tahun Ajaran</label>
                                                            <input class="form-control" type="text" name="tahun_ajaran" id="tahun_ajaran" value="{{ $tahun_ajaran }}">
                                                        </div>
                                                        <!-- Input untuk semester -->
                                                        <div class="form-group">
                                                            <label for="semester" class="semester">Semester</label>
                                                            <select class="form-control" name="semester" id="semester">
                                                                <option value="1" {{ $semester == '1' ? 'selected' : '' }}>Semester 1</option>
                                                                <option value="2" {{ $semester == '2' ? 'selected' : '' }}>Semester 2</option>
                                                            </select>
                                                        </div>
                                                        <input type="hidden" name="id_kelas" value="{{ $siswa->kelas_id }}">
                                                        <input type="hidden" name="nis" value="{{ $siswa->nis }}">
                                                        <!-- Input untuk NIP Guru -->
                                                        <div class="form-group">
                                                            <label for="nip">Nama Guru</label>
                                                            <select class="form-control" name="nip" id="nip">
                                                                <option value="" disabled selected>Pilih Guru</option> <!-- Placeholder untuk Nama Guru -->
                                                                @foreach($gurus as $guru)
                                                                    <option value="{{ $guru->nip }}">{{ $guru->nama_guru }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="id_mapel">Nama Mata Pelajaran</label>
                                                            <select class="form-control" name="id_mapel" id="id_mapel">
                                                                <option value="" disabled selected>Pilih Mata Pelajaran</option> <!-- Placeholder untuk Mata Pelajaran -->
                                                                @foreach($mapels as $mapel)
                                                                    <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }} ({{ $mapel->guru->nama_guru }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nilai_uh" class="nilai_uh">Nilai UH</label>
                                                            <input class="form-control" type="number" name="nilai_uh" id="nilai_uh">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nilai_uts" class="nilai_uts">Nilai UTS</label>
                                                            <input class="form-control" type="number" name="nilai_uts" id="nilai_uts">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nilai_uas" class="nilai_uas">Nilai UAS</label>
                                                            <input class="form-control" type="number" name="nilai_uas" id="nilai_uas">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="nilai_praktek" class="nilai_praktek">Nilai Praktek</label>
                                                            <input class="form-control" type="number" name="nilai_praktek" id="nilai_praktek">
                                                        </div>

                                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
