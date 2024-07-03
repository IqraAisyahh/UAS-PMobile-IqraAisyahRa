@extends('layouts.app')

@section('content')

    @php
    $jamPelajaran = [
        "07:30:00 - 08:20:00",
        "08:20:00 - 09:10:00",
        "09:10:00 - 10:00:00",
        "10:00:00 - 10:20:00",
        "10:20:00 - 11:10:00",
        "11:10:00 - 12:00:00",
        "12:00:00 - 13:00:00",
        "13:00:00 - 13:50:00",
        "13:50:00 - 14:40:00",
        "14:40:00 - 15:30:00"
    ];

    $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
    @endphp

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row mb-3">
        
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h3 class="mb-0">Daftar Jadwal Pelajaran</h3>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush rounded">
                            <thead class="thead-light">
                                <tr>
                                    <th></th>
                                    @foreach($hari as $day)
                                        <th>{{ $day }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($jamPelajaran as $jam)
                                    <tr>
                                        <td>{{ $jam }}</td>
                                        @foreach($hari as $day)
                                            <td>
                                                @if(isset($groupedJadwals[$day]))
                                                    @foreach($groupedJadwals[$day] as $jadwal)
                                                        @if($jadwal->jam_masuk == substr($jam, 0, 8))
                                                            {{ $jadwal->mapel->nama_mapel }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </td>
                                        @endforeach
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
