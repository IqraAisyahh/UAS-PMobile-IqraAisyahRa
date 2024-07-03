<table>
    <thead>
        <tr>
            <th>Hari</th>
            <th>07:30 - 08:20</th>
            <th>08:20 - 09:10</th>
            <!-- Tambahkan kolom waktu lainnya di sini -->
        </tr>
    </thead>
    <tbody>
        @foreach($jadwals as $hari => $jadwal)
            <tr>
                <td>{{ $hari }}</td>
                @foreach($jadwal as $jam)
                    <td>{{ $jam }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
