<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Jam Kerja</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <form action="#" method="post">
                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="date_range">Jam Kerja Waktu:</label>
                                <div id="date_range" class="row">
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="start_date"
                                               value="{{$jam_kerja_terbaru->jam_mulai}}">
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="end_date"
                                               value="{{$jam_kerja_terbaru->jam_selesai}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="form-group">
                                <div id="date_range" class="row">
                                    <div class="col-4">
                                        <label>Editor:</label>
                                        <input type="Text" class="form-control" name="start_date" disabled
                                               value="{{$jam_kerja_terbaru->admin->nama}}">
                                    </div>
                                    <div class="col-8">
                                        <label>Terakhir dirubah:</label>
                                        <input type="datetime-local" class="form-control" name="start_date"
                                               value="{{$jam_kerja_terbaru->tanggal_dibuat}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-block btn-warning text-white" type="submit">Update Jam Kerja</button>
                        </div>
                    </div>
                    <div class="row mt-4">
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
                        @include('KelolaWaktuKerja.modal')
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
                                            <form class="mx-2"
                                                  action="#"
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
