<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Tambah {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <p class="login-box-msg">Silahkan Masukkan Informasi Mading</p>
            <form action="#" method="post">
                @if(Session::get('success'))
                    <div class="alert alert-success">
                        Berhasil Menambahkan Mading
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
                            <i class="fas fa-heading"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control @error('judul')is-invalid @enderror"
                           placeholder="Judul Mading" name="judul" id="judul" value="{{old('judul')}}">
                    <span class="invalid-feedback">
                        @error('judul'){{$message}} @enderror
                    </span>
                </div>

                <div class="form-group mb-3">
                    <label for="informasiMading">Informasi Mading:</label>
                    <textarea class="form-control @error('informasiMading') is-invalid @enderror" id="informasiMading"
                              rows="5" placeholder="Informasi Mading"></textarea>
                    <span class="invalid-feedback">
                        @error('informasiMading'){{$message}} @enderror
                    </span>
                </div>

                    <div class="form-group">
                        <label for="chooseFile">Thumbnail:</label>
                        <div class="custom-file" id="chooseFile">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label text-muted" for="customFile">Choose Thumbnail</label>
                        </div>
                    </div>

                    <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Buat Mading Baru</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
