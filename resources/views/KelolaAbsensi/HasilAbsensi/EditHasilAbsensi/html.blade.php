<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body mx-2">
            <p class="login-box-msg">Edit Absensi</p>
            <form action="{{route('admin.edit.absensi', $id)}}" method="post">
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
                @csrf
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-user"></i>
                        </span>
                    </div>
                    <input type="text" disabled class="form-control @error('nama')is-invalid @enderror"
                           placeholder="Nama Lengkap" name="nama" id="nama" value="{{$absensi->pegawai->nama}}">
                    <span class="invalid-feedback">
                        @error('nama'){{$message}} @enderror
                    </span>
                </div>
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-calendar"></i>
                        </span>
                    </div>
                    <input type="text" disabled class="form-control @error('tanggal')is-invalid @enderror"
                           placeholder="Nama Lengkap" name="tanggal" id="tanggal" value="{{$absensi->tanggal}}">
                    <span class="invalid-feedback">
                        @error('tanggal'){{$message}} @enderror
                    </span>
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status :</label>
                    <select class="custom-select" name="status" id="status">
                        <option {{($absensi->status) == 'Hadir'?'Selected':''}}>Hadir</option>
                        <option {{($absensi->status) == 'Pulang'?'Selected':''}}>Pulang</option>
                        <option {{($absensi->status) == 'Izin'?'Selected':''}}>Izin</option>
                    </select>
                    <span class="invalid-feedback">
                        @error('status'){{$message}} @enderror
                    </span>
                </div>

                    @if(\App\Models\Progress::where('id_absensi',$absensi->id_absensi)->first())


                    <div class="form-group mb-3">
                        <label for="informasiMading">Progress Pekerjaan:</label>
                        <textarea class="form-control" id="informasiMading" disabled
                                  rows="5"
                                  placeholder="">{{\App\Models\Progress::where('id_absensi',$absensi->id_absensi)->first()->progress_pekerjaan}}</textarea>
                    </div>
                    @endif
                <div class="row mb-3">
                    {{--Tempat--}}
{{--                    <div class="col-4">--}}
{{--                        <div class="input-group">--}}
{{--                            <div class="input-group-prepend">--}}
{{--                        <span class="input-group-text">--}}
{{--                            <i class="fas fa-map-marked-alt"></i>--}}
{{--                        </span>--}}
{{--                            </div>--}}
{{--                            <input type="text" class="form-control @error('tempat')is-invalid @enderror"--}}
{{--                                   placeholder="Nama Lengkap" name="tempat" id="tempat"--}}
{{--                                   value="{{$absensi->tempat}}">--}}
{{--                            <span class="invalid-feedback">--}}
{{--                        @error('tempat'){{$message}} @enderror--}}
{{--                        </span>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-4">
                        {{--Logitude--}}
                        <div class="input-group">
                            <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                            </div>
                            <input type="text" class="form-control @error('longitude')is-invalid @enderror"
                                   placeholder="Nama Lengkap" name="longitude" id="longitude"
                                   value="{{$absensi->longitude}}">
                            <span class="invalid-feedback">
                        @error('longitude'){{$message}} @enderror
                    </span>
                        </div>
                    </div>

                    <div class="col-4">
                        {{--Latitude--}}
                        <div class="input-group">
                            <input type="text" class="form-control @error('latitude')is-invalid @enderror"
                                   placeholder="Nama Lengkap" name="latitude" id="latitude"
                                   value="{{$absensi->latitude}}">
                            <span class="invalid-feedback">
                        @error('latitude'){{$message}} @enderror
                    </span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Edit Absensi</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>
            <div class="row  mt-3">
                <!-- /.col -->
                <div class="col-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#modalHapusAbsensi">Hapus Absensi
                    </button>

                    <!-- Modal -->
                    <form action="{{route('admin.hapus.absensi',$id)}}" method="post">
                        @csrf
                        <div class="modal fade" id="modalHapusAbsensi" tabindex="-1" role="dialog"
                             aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalLabel">Konfirmasi Untuk Menghapus</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Yakin ingin mengapus Absensi ini ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close
                                        </button>
                                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- /.col -->
            </div>
        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
