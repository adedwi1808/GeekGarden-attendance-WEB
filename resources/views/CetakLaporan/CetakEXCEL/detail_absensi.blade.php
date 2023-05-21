<table class="table table-bordered table-hover table-striped text-center" cellspacing="0" style="width: 100%">
    <thead>
    <tr>
        <th class="col-1">Nama Pegawai</th>
        <th class="col-1">Tempat</th>
        <th class="col-1">Longitude</th>
        <th class="col-1">Latitude</th>
        <th class="col-1">Foto Absensi</th>
        <th class="col-3">Progress</th>
        <th class="col-1">Lembur</th>
        <th class="col-1">Status</th>
        <th class="col-3">Tanggal</th>
    </tr>
    </thead>
    <tbody >

    @forelse($data_absensi as $index=>$absensi)
        @php
            $progress = \App\Models\Progress::where('id_absensi',$absensi->id_absensi)->first();
            $lembur = \App\Models\Lembur::where('id_absensi', $absensi->id_absensi)->first();
        @endphp
        <tr>
            <td  class="col-1">{{$absensi->pegawai->nama}}</td>
            <td  class="col-1">{{$absensi->tempat}}</td>
            <td  class="col-1">{{$absensi->longitude}}</td>
            <td  class="col-1">{{$absensi->latitude}}</td>
            <td  class="col-1"><a class="link-primary"
                                  href="/storage/bukti-absen/{{$absensi->foto}}">Link</a>
            </td>

            @if($progress)
                <td class="col-2">{{$progress->progress_pekerjaan}}</td>
            @else
                <td class="col-2">{{"-"}}</td>
            @endif

            @if($lembur)
                <td class="col-1">{{"Iya"}}</td>
            @else
                <td class="col-1">{{""}}</td>
            @endif

            <td  class="col-1">{{$absensi->status}}</td>
            <td  class="col-3">{{$absensi->tanggal}}</td>
        </tr>
    @empty
        <div class="alert alert-danger">
            Data Absensi Tidak Ditemukan / Belum Tersedia.
        </div>
    @endforelse
    </tbody>
</table>
