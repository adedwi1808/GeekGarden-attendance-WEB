<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <form method="get" action="{{route('admin.cari.lembur')}}">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="date_range">Rentang Waktu:</label>
                                        <div id="date_range" class="row">
                                            <div class="col-6">
                                                <input type="datetime-local" class="form-control" name="start_date"
                                                       value="2022-07-01T00:00">
                                            </div>
                                            <div class="col-6">
                                                <input type="datetime-local" class="form-control" name="end_date"
                                                       value="{{\Carbon\Carbon::now()->endOfDay()->toDateTimeString()}}">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="tempat_absen">Tempat Absen :</label>
                                        <select name="tempat_absen" id="tempat_absen" class="select2"
                                                style="width: 100%;">
                                            <option selected>All</option>
                                            <option>Dikantor</option>
                                            <option>Diluar Kantor</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="status_lembur">Status:</label>
                                        <select name="status_lembur" id="status_lembur" class="select2"
                                                style="width: 100%;">
                                            <option selected>All</option>
                                            <option>Diajukan</option>
                                            <option>Ditolak</option>
                                            <option>Diterima</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" class="form-control form-control-lg"
                                           placeholder="Cari Pengajuan Lembur" name="cari_lembur">
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
                        @if(Session::get('success'))
                            <div class="alert alert-success" role="alert">
                                {{Session::get('success')}}
                            </div>
                        @endif
                        @if(Session::get('success2'))
                            <div class="alert alert-warning" role="alert">
                                {{Session::get('success2')}}
                            </div>
                        @endif
                        @if(Session::get('fail'))
                            <div class="alert alert-danger" role="alert">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered table-striped table-hover text-center" id="tableLembur">
                            <thead>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Tempat Absen</th>
                                <th>Status Lembur</th>
                                <th>Tanggal</th>
                                <th>Konfirmator</th>
                                <th>Tanggal Dikonfirmasi</th>
                                <th>Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_pengajuan_lembur as $index=>$lembur)
                                <tr>
                                    <td>{{$lembur->nama_pegawai}}</td>
                                    <td>{{$lembur->tempat}}</td>
                                    <td>
                                        <span class="badge @if($lembur->status_lembur == "Diterima") badge-success
                                        @elseif($lembur->status_lembur == "Ditolak") badge-danger @else badge-info
@endif badge-pill">
                                            {{$lembur->status_lembur}}</span></td>
                                    <td>{{$lembur->tanggal_dibuat}}</td>
                                    <td>{{($lembur->id_admin == null)? "-": $lembur->admin->nama}}</td>
                                    <td>{{$lembur->tanggal_konfirm}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <form class="mx-2"
                                                  action="{{route("admin.halaman.konfirmasi.lembur", $lembur->id_lembur)}}"
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
                                    Data Lembur Tidak Ditemukan / Belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Tempat Absen</th>
                                <th>Status Lembur</th>
                                <th>Tanggal</th>
                                <th>Konfirmator</th>
                                <th>Tanggal Dikonfirmasi</th>
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
