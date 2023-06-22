<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <form method="get" action="{{route('admin.cari.hasil.absensi')}}">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="date_range">Rentang Waktu:</label>
                                        <div id="date_range" class="row">
                                            <div class="col-6">
                                                <input type="datetime-local" class="form-control" name="start_date" value="2022-07-01T00:00">
                                            </div>
                                            <div class="col-6">
                                                <input type="datetime-local" class="form-control" name="end_date" value="{{\Carbon\Carbon::now()->endOfDay()->toDateTimeString()}}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
{{--                                <div class="col-3">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="tempat">Tempat :</label>--}}
{{--                                        <select name="tempat" id="tempat" class="select2" style="width: 100%;">--}}
{{--                                            <option selected>All</option>--}}
{{--                                            <option>Dikantor</option>--}}
{{--                                            <option>Diluar Kantor</option>--}}
{{--                                        </select>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="select2" style="width: 100%;">
                                            <option selected>All</option>
                                            <option>Hadir</option>
                                            <option>Pulang</option>
                                            <option>Izin</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" class="form-control form-control-lg"
                                           placeholder="Cari Hasil Absensi" name="cari_hasil_absensi">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <table id="tableAbsensi" class="table table-bordered table-hover table-striped text-center">
                            <thead>
                            <tr>
                                <th>Nama Pegawai</th>
{{--                                <th>Tempat</th>--}}
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Foto Absensi</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Kelola</th>
                            </tr>
                            </thead>
                            <tbody>


                            @forelse($data_absensi as $index=>$absensi)
                                @php
                                    $progress = \App\Models\Progress::where('id_absensi',$absensi->id_absensi)->first();
                                    $lembur = \App\Models\Lembur::where('id_absensi', $absensi->id_absensi)
                                    ->where('status_lembur', 'Diterima')
                                    ->first();
                                @endphp
                                <tr>
                                    <td>{{$absensi->pegawai->nama}}</td>
{{--                                    <td>{{$absensi->tempat}}</td>--}}
                                    <td>{{$absensi->longitude}}</td>
                                    <td>{{$absensi->latitude}}</td>
                                    <td><a class="link-primary"
                                                         href="/storage/public/bukti-absen/{{$absensi->foto}}" target="_blank">{{(strlen($absensi->foto) > 9)? substr($absensi->foto, 0,9)."..." : $absensi->foto}}</a>
                                    </td>
                                    @if($progress)
                                    <td>{{(strlen($progress->progress_pekerjaan) > 25)?substr($progress->progress_pekerjaan,0,25)."...":$progress->progress_pekerjaan}}</td>
                                    @else
                                        <td>{{"-"}}</td>
                                    @endif

                                    @if($lembur)
                                        <td><span class="badge badge-warning badge-pill">{{$absensi->status}}</span></td>
                                        <td><span class="badge badge-warning badge-pill">{{$absensi->tanggal}}</span></td>
                                    @else
                                        <td>{{$absensi->status}}</td>
                                        <td><span class="badge badge-info badge-pill">{{$absensi->tanggal}}</span></td>
                                    @endif
                                    <td>
                                        <div class="row justify-content-center">
                                            <form class="col-6"
                                                  action="https://www.google.com/maps/search/{{$absensi->latitude.','.$absensi->longitude}}"
                                                  method="get" target="_blank">
                                                <button type="submit" class="btn btn-info"><i
                                                        class="fas fa-map-marked"></i>
                                                </button>
                                            </form>
                                            <form class="col-6"
                                                  action="{{route('admin.halaman.edit.absensi', $absensi->id_absensi)}}"
                                                  method="get">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Absensi Tidak Ditemukan / Belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nama Pegawai</th>
{{--                                <th>Tempat</th>--}}
                                <th>Longitude</th>
                                <th>Latitude</th>
                                <th>Foto Absensi</th>
                                <th>Progress</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                                <th>Kelola</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
