<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <p class="login-box-msg">Silahkan Masukkan Data Pegawai Baru</p>
            <form action="{{route('admin.tambahkan.pegawai')}}" method="post">
                @if(Session::get('success'))
                    <div class="alert alert-success">
                        Berhasil Menambahkan Pegawai
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
                           placeholder="Nama Lengkap" name="nama" id="nama" value="{{old('nama')}}">
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
                    <input type="number" class="form-control @error('nomor_hp') is-invalid @enderror"
                           placeholder="No. Telephone" name="nomor_hp" id="nomor_hp" value="{{old('nomor_hp')}}">
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
                           placeholder="Email" name="email" id="email" value="{{old('email')}}">
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
                           placeholder="Jabatan / Posisi" name="jabatan" id="jabatan" value="{{old('jabatan')}}">
                    <span class="invalid-feedback">
                        @error('jabatan'){{$message}} @enderror
                    </span>
                </div>

                <div class="form-group mb-3">
                    <label for="jenis_kelamin">Jenis Kelamin:</label>
                    <select class="custom-select" name="jenis_kelamin" id="jenis_kelamin">
                        <option>Laki-laki</option>
                        <option>Perempuan</option>
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
                        <button type="submit" class="btn btn-primary btn-block">Buat Pegawai Baru</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
