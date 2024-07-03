@extends('layouts.app', ['title' => 'Edit Nilai'])

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
                    <h3 class="mb-0">Edit Nilai</h3>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ url('admin/nilai/' . $nilai->id_nilai) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Tambahkan input tersembunyi untuk menyimpan semester dan tahun ajaran -->
                <input type="hidden" name="semester" value="{{ $nilai->semester }}">
                <input type="hidden" name="tahun_ajaran" value="{{ $nilai->tahun_ajaran }}">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="nilai_uh">Nilai UH</label>
                        <input type="number" class="form-control" id="nilai_uh" name="nilai_uh" value="{{ $nilai->nilai_uh }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nilai_uts">Nilai UTS</label>
                        <input type="number" class="form-control" id="nilai_uts" name="nilai_uts" value="{{ $nilai->nilai_uts }}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="nilai_uas">Nilai UAS</label>
                        <input type="number" class="form-control" id="nilai_uas" name="nilai_uas" value="{{ $nilai->nilai_uas }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nilai_praktek">Nilai Praktek</label>
                        <input type="number" class="form-control" id="nilai_praktek" name="nilai_praktek" value="{{ $nilai->nilai_praktek }}">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
</div>
@endsection
