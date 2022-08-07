<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Konfirmasi {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    @if(Session::get('fail'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('fail')}}
                        </div>
                    @endif

                    @if(Session::get('warning'))
                        <div class="alert alert-warning" role="alert">
                            {{Session::get('warning')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="input-group mb-3 ">
                <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                </div>
                <input type="text" class="form-control"
                       placeholder="Nama Pegawai" name="namaPegawai" id="namaPegawai" disabled
                       value="{{$data_laporan_absensi->pegawai->nama}}">
            </div>
            <div class="form-group mb-3">
                <label for="keterangan_laporan">Keterangan Laporan:</label>
                <textarea class="form-control" id="keterangan_laporan"
                          rows="3" name="keterangan_laporan"
                          placeholder="Informasi Mading"
                          disabled>{{$data_laporan_absensi->keterangan_laporan}}</textarea>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Tanggal Absen(yang dilaporkan):</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control float-right" id="tanggal_absen"
                                   name="tanggal_absen"
                                   disabled
                                   value="{{$data_laporan_absensi->tanggal_absen}}">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Status Laporan:</label>
                        <select class="form-control" disabled="">
                            <option {{($data_laporan_absensi->status_laporan == "Diterima")?"selected":""}}>Diterima
                            </option>
                            <option {{($data_laporan_absensi->status_laporan == "Ditolak")?"selected":""}}>Ditolak
                            </option>
                            <option {{($data_laporan_absensi->status_laporan == "Diajukan")?"selected":""}}>Diajukan
                            </option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row mt-3">
                <div class="col-6">
                    <a href="{{route("admin.cari.absensi", [
                        $data_laporan_absensi->id_pegawai,
                        $data_laporan_absensi->tanggal_absen])}}" target="_blank">
                        <button type="button" class="btn btn-info btn-block">
                            <i class="fa fa-search"></i>
                            Cari Absensi
                        </button>
                    </a>
                </div>
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-secondary btn-block" formaction="" data-toggle="modal"
                            data-target="#modalTambahAbsen">
                        <i class="fa fa-plus"></i>
                        Tambahkan Absen
                    </button>
                    <form
                        action="{{route("admin.tambah.absensi", $data_laporan_absensi->id_laporan_absensi)}}"
                        method="post">
                        @csrf
                        <div class="modal fade" id="modalTambahAbsen" tabindex="-1" role="dialog"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Tambah Absen Pegawai</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label>Nama :</label>
                                            <div class="input-group mb-3 ">
                                                <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </span>
                                                </div>
                                                <input type="text" class="form-control"
                                                       placeholder="Nama Pegawai" name="namaPegawai" id="namaPegawai"
                                                       disabled
                                                       value="{{$data_laporan_absensi->pegawai->nama}}">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal :</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i
                                                            class="far fa-calendar-alt"></i></span>
                                                </div>
                                                <input type="text" class="form-control float-right" id="tanggal_absen"
                                                       name="tanggal_absen"
                                                       disabled
                                                       value="{{$data_laporan_absensi->tanggal_absen}}">
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Opsi Absensi:</label>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                               id="hadir" name="hadir" value="Hadir">
                                                        <label for="hadir"
                                                               class="custom-control-label">Hadir</label>
                                                    </div>
                                                    <div class="custom-control custom-checkbox">
                                                        <input class="custom-control-input" type="checkbox"
                                                               id="pulang" name="pulang" value="Pulang">
                                                        <label for="pulang"
                                                               class="custom-control-label">Pulang</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Lokasi Absensi:</label>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                               name="tempat" id="Dikantor" value="Dikantor"
                                                               checked
                                                        >
                                                        <label class="form-check-label" for="Dikantor">
                                                            Dikantor
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                               name="tempat" id="Diluar_kantor" value="Diluar Kantor">
                                                        <label class="form-check-label" for="Diluar_kantor">
                                                            Diluar Kantor
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak
                                        </button>
                                        <button type="submit" class="btn btn-success">Tambahkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row mt-4">
                <!-- /.col -->
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-block" formaction="" data-toggle="modal"
                            data-target="#modalMengizinkan">Menerima izin
                    </button>
                    <form
                        action="{{route('admin.terima.laporan.absensi',$data_laporan_absensi->id_laporan_absensi)}}"
                        method="post">
                        @csrf
                        <div class="modal fade" id="modalMengizinkan" tabindex="-1" role="dialog"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Konfirmasi Untuk Mengizinkan
                                            Pegawai</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menerima pengajuan izin pegawai ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak
                                        </button>
                                        <button type="submit" class="btn btn-success">Ya, Izinkan</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#modalMenolakIzin">Menolak Izin
                    </button>

                    <!-- Modal -->
                    <form
                        action="{{route('admin.tolak.laporan.absensi',$data_laporan_absensi->id_laporan_absensi)}}"
                        method="post">
                        @csrf
                        <div class="modal fade" id="modalMenolakIzin" tabindex="-1" role="dialog"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Konfirmasi Untuk Penolakan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin Menolak Pengajuan Izin ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak
                                        </button>
                                        <button type="submit" class="btn btn-danger">Ya, Tolak</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- /.col -->
            </div>
            <div class="row  mt-3">
                <!-- /.col -->

                <!-- /.col -->
            </div>
        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>