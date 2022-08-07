<table class="table table-bordered table-hover table-striped text-center" cellspacing="0" style="width: 100%">
    <thead>
    <tr>
        <th>Nama Pegawai</th>
        <th>Tempat</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Foto Absensi</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>
    </thead>
    <tbody >

    @forelse($data_absensi as $index=>$absensi)
        <tr>
            <td>{{$absensi->pegawai->nama}}</td>
            <td>{{$absensi->tempat}}</td>
            <td>{{$absensi->longitude}}</td>
            <td>{{$absensi->latitude}}</td>
            <td><a class="link-primary"
                   href="/storage/bukti-absen/{{$absensi->foto}}">{{(strlen($absensi->foto) > 18)? substr($absensi->foto, 0,18)."..." : $absensi->foto}}</a>
            </td>
            <td>{{$absensi->status}}</td>
            <td>{{$absensi->tanggal}}</td>
        </tr>
    @empty
        <div class="alert alert-danger">
            Data Absensi Tidak Ditemukan / Belum Tersedia.
        </div>
    @endforelse
    </tbody>
    <tfoot>
    <tr >
        <th>Nama Pegawai</th>
        <th>Tempat</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th>Foto Absensi</th>
        <th>Status</th>
        <th>Tanggal</th>
    </tr>
    </tfoot>
</table>
