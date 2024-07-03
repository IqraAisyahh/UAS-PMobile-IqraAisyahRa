@extends('layouts.app', ['title' => 'Penilaian Rapor'])

@section('content')
@php
    $tahun_ajaran = ''; // Inisialisasi variabel tahun ajaran
    $semester = ''
@endphp

<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>

<div class="container-fluid mt--7">
    <div class="card shadow">
        <div class="card-header border-0">
            <form action="{{ route('admin.nilai.search') }}" method="GET"> <!-- Menentukan rute untuk menangani pencarian -->
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <label for="nis">NIS</label>
                        <input type="text" class="form-control" id="nis" name="nis" placeholder="Masukkan NIS">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="tahun_ajaran">Tahun Ajaran</label>
                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" placeholder="Contoh: 2023/2024">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="semester">Semester</label>
                        <select class="form-control" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="1">Semester 1</option>
                            <option value="2">Semester 2</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <button type="submit" class="btn btn-primary mt-4">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
