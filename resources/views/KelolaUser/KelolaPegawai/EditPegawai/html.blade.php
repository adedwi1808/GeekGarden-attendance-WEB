<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body mx-2">
            <p class="login-box-msg">Edit Admin</p>
            <form action="{{route('admin.edit.pegawai', $id)}}" method="post">
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
                        <input type="text" class="form-control @error('nama')is-invalid @enderror"
                               placeholder="Nama Lengkap" name="nama" id="nama" value="{{$pegawai->nama}}">
                        <span class="invalid-feedback">
                        @error('nama'){{$message}} @enderror
                    </span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-phone-alt"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                               placeholder="No. Telephone" name="nomor_hp" id="nomor_hp" value="{{$pegawai->nomor_hp}}">
                        <span class="invalid-feedback">
                        @error('nomor_hp'){{$message}} @enderror
                    </span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" name="email" id="email" value="{{$pegawai->email}}">
                        <span class="invalid-feedback">
                        @error('email'){{$message}} @enderror
                    </span>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fas fa-briefcase"></span>
                            </div>
                        </div>
                        <input type="text" class="form-control @error('jabatan') is-invalid @enderror"
                               placeholder="Jabatan / Posisi" name="jabatan" id="jabatan" value="{{$pegawai->jabatan}}">
                        <span class="invalid-feedback">
                        @error('jabatan'){{$message}} @enderror
                    </span>
                    </div>

                    <div class="form-group mb-3">
                        <label for="jenis_kelamin">Jenis Kelamin:</label>
                        <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin">
                            <option {{($pegawai->jenis_kelamin) == 'Laki-laki'?'Selected':''}}>Laki-laki</option>
                            <option {{($pegawai->jenis_kelamin) == 'Perempuan'?'Selected':''}}>Perempuan</option>
                        </select>
                        <span class="invalid-feedback">
                        @error('jenis_kelamin'){{$message}} @enderror
                    </span>
                    </div>

                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password" name="password" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback">
                        @error('password'){{$message}} @enderror
                    </span>
                    </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Edit Pegawai</button>
                    </div>
                    <!-- /.col -->
                </div>

            </form>
            <div class="row  mt-3">
                <!-- /.col -->
                <div class="col-12">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger btn-block" data-toggle="modal"
                            data-target="#modalHapusPegawai">Hapus Pegawai
                    </button>

                    <!-- Modal -->
                    <form action="{{route('admin.hapus.pegawai',$pegawai->id_pegawai)}}" method="post">
                        @csrf
                        <div class="modal fade" id="modalHapusPegawai" tabindex="-1" role="dialog"
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
                                        Yakin ingin mengapus Pegawai ini ?
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
