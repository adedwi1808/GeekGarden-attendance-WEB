<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <form method="get" action="{{route('admin.cari.pengajuan.izin')}}">
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
                                        <label for="jenis_izin">Jenis Izin :</label>
                                        <select name="jenis_izin" id="jenis_izin" class="select2" style="width: 100%;">
                                            <option selected>All</option>
                                            <option>Sakit</option>
                                            <option>Cuti</option>
                                            <option>Keperluan Lainnya</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="status_izin">Status:</label>
                                        <select name="status_izin" id="status_izin" class="select2"
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
                                           placeholder="Cari Pengajuan Izin" name="cari_hasil_absensi">
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
                                <th>Jenis Izin</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan</th>
                                <th>Surat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Konfirmator</th>
                                <th>Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_pengajuan_izin as $index=>$pengajuan_izin)
                                <tr>
                                    <td>{{$pengajuan_izin->pegawai->nama}}</td>
                                    <td>{{$pengajuan_izin->jenis_izin}}</td>
                                    <td>{{$pengajuan_izin->tanggal_mulai_izin}}</td>
                                    <td>{{$pengajuan_izin->tanggal_selesai_izin}}</td>
                                    <td>{{(strlen($pengajuan_izin->alasan_izin) > 3)? substr($pengajuan_izin->alasan_izin, 0,3)."..." : $pengajuan_izin->alasan_izin}}</td>
                                    <td><a class="link-primary"
                                           href="/storage/surat-izin/{{$pengajuan_izin->surat_izin}}">{{(strlen($pengajuan_izin->surat_izin) > 5)? substr($pengajuan_izin->surat_izin, 0,5)."..." : $pengajuan_izin->surat_izin}}</a>
                                    </td>
                                    <td>{{$pengajuan_izin->tanggal_mengajukan_izin}}</td>
                                    <td>
                                        <span  class="badge @if($pengajuan_izin->status_izin == "Diterima") badge-success
                                        @elseif($pengajuan_izin->status_izin == "Ditolak") badge-danger @else badge-info
@endif badge-pill">
                                            {{$pengajuan_izin->status_izin}}</span></td>
                                    <td>{{(strlen($pengajuan_izin->keterangan_admin) > 3)? substr($pengajuan_izin->keterangan_admin, 0,3)."..." : $pengajuan_izin->keterangan_admin}}</td>
                                    <td>{{($pengajuan_izin->id_admin == null)? "-": $pengajuan_izin->admin->nama}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <form class="mx-2"
                                                  action="{{route('admin.halaman.konfirmasi.pengajuan.izin', $pengajuan_izin->id_pengajuan_izin)}}"
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
                                    Data Pengajuan Izin Tidak Ditemukan / Belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Jenis Izin</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan</th>
                                <th>Surat</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Keterangan</th>
                                <th>Konfirmator</th>
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
