<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <form action="{{route('admin.edit.mading', $mading->id_mading)}}" method="POST" enctype="multipart/form-data">
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
                            <i class="fas fa-heading"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control @error('judul')is-invalid @enderror"
                           placeholder="Judul Mading" name="judul" id="judul" value="{{$mading->judul}}">
                    <span class="invalid-feedback">
                        @error('judul'){{$message}} @enderror
                    </span>
                </div>

                <div class="form-group mb-3">
                    <label for="informasiMading">Informasi Mading:</label>
                    <textarea class="form-control @error('informasiMading') is-invalid @enderror" id="informasiMading"
                              rows="5" name="informasiMading" placeholder="Informasi Mading" >{{$mading->informasi}}</textarea>
                    <span class="invalid-feedback">
                        @error('informasiMading'){{$message}} @enderror
                    </span>
                </div>

                    <div class="input-group mb-3">
                        <div class="custom-file" id="choosefile">
                            <input type="file" class="custom-file-input @error('thumbnailMading') is-invalid @enderror"
                                   name="thumbnailMading" accept="image/*" id="thumbnailMading">
                            <label class="custom-file-label text-muted" for="thumbnailMading" aria-describedby="thumbnailMading">@error('thumbnailMading'){{$message}} @enderror</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text" id="thumbnailMading">Upload</span>
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
