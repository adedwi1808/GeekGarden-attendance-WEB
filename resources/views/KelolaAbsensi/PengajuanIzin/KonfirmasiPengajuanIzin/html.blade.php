<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Konfirmasi {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
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
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control"
                           placeholder="Nama Pegawai" name="namaPegawai" id="namaPegawai" disabled
                           value="{{$data_pengajuan_izin->pegawai->nama}}">
                </div>

                <div class="form-group">
                    <label>Jenis Izin:</label>
                    <select class="form-control" disabled="">
                        <option {{($data_pengajuan_izin->jenis_izin == "Sakit")?"selected":""}}>Sakit</option>
                        <option {{($data_pengajuan_izin->jenis_izin == "Keperluan Lainnya")?"selected":""}}>Keperluan
                            Lainnya
                        </option>
                        <option {{($data_pengajuan_izin->jenis_izin == "Cuti")?"selected":""}}>Cuti</option>
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="alsanIzin">Alasan Izin:</label>
                    <textarea class="form-control" id="alsanIzin"
                              rows="3" name="informasiMading"
                              placeholder="Informasi Mading" disabled>{{$data_pengajuan_izin->alasan_izin}}</textarea>
                </div>
                <div class="form-group mb-3">
                    <label>Surat Izin(Opsional):</label>
                    <br>
                    <a class="link-{{($data_pengajuan_izin->surat_izin != null)?"primary":"black"}}"
                       href="/storage/surat-izin/{{$data_pengajuan_izin->surat_izin}}"
                       style="{{($data_pengajuan_izin->surat_izin != null)?"":"pointer-events: none"}}">
                        {{($data_pengajuan_izin->surat_izin != null)?"Surat Izin":"Pegawai Tidak Mencantumkan Surat"}}
                    </a>
                </div>

                <div class="form-group">
                    <label>Rentang Izin:</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                        </div>
                        <input type="text" class="form-control float-right"
                               disabled
                               value="{{$data_pengajuan_izin->tanggal_mulai_izin}} - {{$data_pengajuan_izin->tanggal_selesai_izin}}">
                    </div>

                </div>

                <div class="row mt-5">
                    <!-- /.col -->
                    <div class="col-6">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success btn-block" formaction="" data-toggle="modal"
                                data-target="#modalMengizinkan">Menerima izin
                        </button>
                        <form action="#" method="post">
                            @csrf
                            <div class="modal fade" id="modalMengizinkan" tabindex="-1" role="dialog"
                                 aria-labelledby="modalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalLabel">Konfirmasi Untuk Mengizinkan Pegawai</h5>
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
                        <form action="#" method="post">
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
