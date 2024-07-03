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

        $kelas_list = App\Models\Kelas::all();

        $groupedJadwals = [];
        foreach ($kelas_list as $kelas) {
            $groupedJadwals[$kelas->id_kelas] = [
                'kelas' => $kelas->kelas,
                'nama_kelas' => $kelas->nama_kelas,
                'jadwals' => []
            ];
            foreach ($hari as $day) {
                $groupedJadwals[$kelas->id_kelas]['jadwals'][$day] = \App\Models\Jadwal::where('id_kelas', $kelas->id_kelas)
                    ->where('hari', $day)
                    ->orderBy('jam_masuk')
                    ->get();
            }
        }

        // Pencarian berdasarkan kelas
        $search = request()->query('search');
        if ($search) {
            $groupedJadwals = [];
            $searchTerm = '%' . request()->query('search') . '%';
            $kelas = App\Models\Kelas::where('nama_kelas', 'LIKE', $searchTerm)->get();
            foreach ($kelas as $kelasItem) {
                $groupedJadwals[$kelasItem->id_kelas] = [
                    'kelas' => $kelasItem->kelas,
                    'nama_kelas' => $kelasItem->nama_kelas,
                    'jadwals' => []
                ];
                foreach ($hari as $day) {
                    $groupedJadwals[$kelasItem->id_kelas]['jadwals'][$day] = \App\Models\Jadwal::where('id_kelas', $kelasItem->id_kelas)
                        ->where('hari', $day)
                        ->orderBy('jam_masuk')
                        ->get();
                }
            }
        }
    @endphp

    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8"></div>
    <div class="container-fluid mt--7">
        <div class="row mb-3">
            <div class="col">
                <a href="{{ url('admin/jadwal/create') }}" class="btn btn-success">Add Data</a>
            </div>
        </div>

        <!-- Formulir pencarian -->
        <div class="row mb-3">
            <div class="col">
                <form id="searchForm" action="{{ route('admin.jadwal.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari kelas..." name="search" value="{{ request()->query('search') }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">Cari</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if($groupedJadwals)
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="mb-0">Daftar Jadwal Pelajaran</h3>
                        </div>
                        <div class="table-responsive">
                            @foreach($groupedJadwals as $id_kelas => $data)
                                <div class="card-header border-0 d-flex justify-content-between align-items-center">
                                    <h4>{{ $data['kelas'] }} {{ $data['nama_kelas'] }} (ID: {{ $id_kelas }})</h4>
                                    <div>
                                        @php
                                            $jadwals = $data['jadwals'];
                                        @endphp
                                        @if (!empty($jadwals))
                                        <form method="POST" action="{{ url('admin/jadwal/' . $id_kelas) }}" accept-charset="UTF-8">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirm delete?')">
                                                <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                            </button>
                                        </form>

                                        @endif
                                    </div>
                                </div>

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
                                                    @php
                                                        $mapel = '';
                                                        if (isset($jadwals[$day])) {
                                                            foreach ($jadwals[$day] as $jadwal) {
                                                                if ($jadwal->jam_masuk == substr($jam, 0, 8)) {
                                                                    $mapel = $jadwal->mapel->nama_mapel;
                                                                    break;
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                    <td>{{ $mapel }}</td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                Data tidak ditemukan.
            </div>
        @endif
    </div>

    <script>
        // Jika formulir pencarian disubmit, gulir ke bagian hasil pencarian
        document.getElementById('searchForm').addEventListener('submit', function() {
            document.getElementById('searchResult').scrollIntoView({ behavior: 'smooth' });
        });
    </script>
@endsection
