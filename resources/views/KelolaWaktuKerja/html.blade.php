<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Jam Kerja</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="date_range">Jam Kerja Saat Ini:</label>
                            <div id="date_range" class="row">
                                <div class="col-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-clock"></i>
                        </span>
                                        </div>
                                        <input type="text"
                                               class="form-control"
                                               placeholder="Nama Hari Libur" disabled
                                               value="{{$jam_kerja_terbaru->jam_mulai}}">
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-clock"></i>
                        </span>
                                        </div>
                                        <input type="text"
                                               class="form-control"
                                               placeholder="Nama Hari Libur" disabled
                                               value="{{$jam_kerja_terbaru->jam_selesai}}">
                                    </div>

                                </div>

                                <div class="col-6">
                                    @include('KelolaWaktuKerja.modal_ubah_jam_kerja')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if(Session::get('success_jam_kerja'))
                            <div class="alert alert-success">
                                {{Session::get('success_jam_kerja')}}
                            </div>
                        @endif

                        @if(Session::get('fail_jam_kerja'))
                            <div class="alert alert-danger">
                                {{Session::get('fail_jam_kerja')}}
                            </div>
                        @endif
                    </div>
                </div>
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-12">
                            <table id="table" class="table table-bordered table-hover table-striped text-center">
                                <thead>
                                <tr>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Nama Editor</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($jam_kerja as $index=>$tanggal)
                                    <tr>
                                        <td>{{$tanggal->jam_mulai}}</td>
                                        <td>{{$tanggal->jam_selesai}}</td>
                                        <td>{{$tanggal->admin->nama}}</td>
                                        <td>{{$tanggal->tanggal_dibuat}}</td>
                                    </tr>
                                @empty
                                    <div class="alert alert-danger">
                                        Data Absensi Tidak Ditemukan / Belum Tersedia.
                                    </div>
                                @endforelse
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Jam Mulai</th>
                                    <th>Jam Selesai</th>
                                    <th>Nama Editor</th>
                                    <th>Tanggal Dibuat</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <p>
                            *riwayat perubahan jam kerja
                        </p>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tanggal Libur</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif

                        @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-6">
                        @include('KelolaWaktuKerja.modal_tambah_hari_libur')
                    </div>

                    <div class="col-6 ">
                        <form action="#" method="get">
                            <div class="input-group input-group-sm float-right" style="width: 60%;">
                                <input type="text" name="cari_pegawai" class="form-control float-right"
                                       placeholder="Cari Hari Libur">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <table id="table2" class="table table-bordered table-hover table-striped text-center">
                            <thead>
                            <tr>
                                <th>Nama Hari Libur</th>
                                <th>Tanggal</th>
                                <th>Penginput</th>
                                <th>Tanggal Dibuat</th>
                                <th>Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_tanggal_libur as $index=>$tanggal)
                                <tr>
                                    <td>{{$tanggal->nama}}</td>
                                    <td>{{$tanggal->tanggal}}</td>
                                    <td>{{$tanggal->admin->nama}}</td>
                                    <td>{{$tanggal->tanggal_dibuat}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#modalHapus"><i
                                                    class="fas fa-trash"></i>
                                            </button>
                                            <form class="mx-2"
                                                  action="{{route('admin.hapus.hari.libur', $tanggal->id_tanggal_libur)}}"
                                                  method="post">
                                                @csrf

                                                <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog"
                                                     aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Konfirmasi Untuk hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Yakin ingin Menghapus Tanggal Libur ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">Ya, hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Tanggal Libur Tidak Ditemukan / Belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nama Hari Libur</th>
                                <th>Tanggal</th>
                                <th>Penginput</th>
                                <th>Tanggal Dibuat</th>
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
</section>
