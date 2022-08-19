<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="container">
            <form method="get" action="{{route('admin.cari.pengaduan.absensi')}}">
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
                                    <label for="tanggal_absen">Tanggal Absen :</label>
                                    <input type="date" class="form-control" name="tanggal_absen" id="tanggal_absen"
                                           value="">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="status_izin">Status:</label>
                                    <select name="status_izin" id="status_pengaduan" class="select2"
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
                                       placeholder="Cari Pengaduan absen" name="cari_pengaduan_absensi">
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
                    <table class="table table-bordered table-striped table-hover text-center" id="table">
                        <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Absen</th>
                            <th>Keterangan pengaduan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Keterangan Admin</th>
                            <th>Konfirmator</th>
                            <th>Kelola</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($data_pengaduan as $index=>$pengaduan)
                            <tr>
                                <td>{{$pengaduan->pegawai->nama}}</td>
                                <td>{{$pengaduan->tanggal_absen}}</td>
                                <td>{{$pengaduan->keterangan_pengaduan}}</td>
                                <td>{{$pengaduan->tanggal_pengaduan}}</td>
                                <td><span class="badge @if($pengaduan->status_pengaduan == "Diterima") badge-success
                                        @elseif($pengaduan->status_pengaduan == "Ditolak") badge-danger
                                        @else badge-info
                        @endif badge-pill">{{$pengaduan->status_pengaduan}}</span></td>
                                <td>{{(strlen($pengaduan->keterangan_admin) > 18)? substr($pengaduan->keterangan_admin, 0,18)."..." : $pengaduan->keterangan_admin}}</td>
                                <td>{{($pengaduan->id_admin == null)? "-": $pengaduan->admin->nama}}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <form class="mx-2"
                                              action="{{route('admin.halaman.konfirmasi.pengaduan.absensi', $pengaduan->id_pengaduan_absensi)}}"
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
                                Data pengaduan Absensi Tidak Ditemukan / Belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Absen</th>
                            <th>Keterangan pengaduan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Status</th>
                            <th>Keterangan Admin</th>
                            <th>Konfirmator</th>
                            <th>Kelola</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
