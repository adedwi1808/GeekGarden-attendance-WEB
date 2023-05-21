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
                       value="{{$data_lembur->nama_pegawai}}">
            </div>

            <div class="form-group mb-3">
                <label for="alsanIzin">Progress Pekerjaan:</label>
                <textarea class="form-control" id="alsanIzin"
                          rows="3" name="informasiMading"
                          placeholder="Informasi Mading" disabled>{{$data_progress->progress_pekerjaan}}</textarea>
            </div>

            <div class="form-group mb-3">
                <label>Bukti Absensi:</label>
                <br>
                <a class="link-{{($data_lembur->foto != null)?"primary":"black"}}"
                   href="/storage/public/bukti-absen/{{$data_lembur->foto}}"
                   style="{{($data_lembur->foto != null)?"":"pointer-events: none"}}">
                    {{($data_lembur->foto != null)?"Bukti Absensi Lembur":"Pegawai Tidak Mencantumkan Surat"}}
                </a>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Tanggal</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="text" class="form-control float-right"
                                   disabled
                                   value="{{$data_lembur->tanggal}}">
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Status Izin:</label>
                        <select class="form-control" disabled="">
                            <option {{($data_lembur->status_lembur == "Diterima")?"selected":""}}>Diterima</option>
                            <option {{($data_lembur->status_lembur == "Ditolak")?"selected":""}}>Ditolak</option>
                            <option {{($data_lembur->status_lembur == "Diajukan")?"selected":""}}>Diajukan</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row mt-5">
                <!-- /.col -->
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success btn-block" formaction="" data-toggle="modal"
                            data-target="#modalTerima">Menerima Lembur
                    </button>
                    <form action="{{route('admin.terima.lembur', $data_lembur->id_lembur)}}"
                          method="post">
                        @csrf
                        <div class="modal fade" id="modalTerima" tabindex="-1" role="dialog"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Konfirmasi Untuk Menerima Lembur
                                            Pegawai</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin menerima pengajuan lembur pegawai ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak
                                        </button>
                                        <button type="submit" class="btn btn-success">Ya, Terima</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
                <div class="col-6">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#modalTolak">Menolak Pengajuan Lembur
                    </button>

                    <!-- Modal -->
                    <form action="{{route('admin.tolak.lembur', $data_lembur->id_lembur)}}"
                          method="post">
                        @csrf
                        <div class="modal fade" id="modalTolak" tabindex="-1" role="dialog"
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
                                        Yakin ingin Menolak Pengajuan Lembur Pegawai ?
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
