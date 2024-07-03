<!-- resources/views/nilai/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Input Nilai</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.nilai.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="nis" class="nis">Nama Siswa</label>
                                <select class="form-control" name="nis" id="nis">
                                    @foreach($siswas as $nis => $nama_siswa)
                                        <option value="{{ $nis }}">{{ $nama_siswa }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @csrf
                            <div class="form-group">
                                <label for="nip" class="nip">Nama Guru</label>
                                <select class="form-control" name="nip" id="nip">
                                    @foreach($gurus as $nip => $nama_guru)
                                        <option value="{{ $nip }}">{{ $nama_guru }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="mapel">Mata Pelajaran</label>
                                <select id="mapel" class="form-control" name="id_mapel[]" multiple required>
                                    @foreach($mapel as $mapel)
                                        <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="nilai_uh">Nilai Ulangan Harian</label>
                                <input id="nilai_uh" type="text" class="form-control" name="nilai_uh[]" required>
                            </div>

                            <div class="form-group">
                                <label for="nilai_uts">Nilai Ujian Tengah Semester</label>
                                <input id="nilai_uts" type="text" class="form-control" name="nilai_uts[]" required>
                            </div>

                            <div class="form-group">
                                <label for="nilai_uas">Nilai Ujian Akhir Semester</label>
                                <input id="nilai_uas" type="text" class="form-control" name="nilai_uas[]" required>
                            </div>

                            <div class="form-group">
                                <label for="nilai_praktek">Nilai Praktek</label>
                                <input id="nilai_praktek" type="text" class="form-control" name="nilai_praktek[]" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
