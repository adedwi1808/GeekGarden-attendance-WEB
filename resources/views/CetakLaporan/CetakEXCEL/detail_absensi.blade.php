<table>
    <thead>
    <tr>
        <th rowspan="2">Nama</th>
        <th colspan="3">Detail Absensi</th>
    </tr>
    <tr>
        <th>Hadir</th>
        <th>Izin</th>
        <th>Cuti</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data_absensi_pegawai as $data)
        <tr>
            <td>{{ $data->nama }}</td>
            <td>{{ \App\Models\Absensi::where('id_pegawai', $data->id_pegawai)
->where('status', 'Hadir')
->whereBetween('tanggal', $waktu)
->count()
}}</td>
            <td>{{ \App\Models\Absensi::where('id_pegawai', $data->id_pegawai)
->where('status', 'Izin')
->whereBetween('tanggal', $waktu)
->count()
}}</td>
            <td>{{ \App\Models\Absensi::where('id_pegawai', $data->id_pegawai)
->where('status', 'Cuti')
->whereBetween('tanggal', $waktu)
->count()
}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
