<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Form Edit {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <p class="login-box-msg">Edit Admin</p>
            <form action="{{route('admin.edit.admin', $id)}}" method="post">
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
                    <input type="text" class="form-control @error('nama')is-invalid @enderror" placeholder="Nama Lengkap" name="nama" id="nama"
                           @if(\Illuminate\Support\Facades\Session::get('admin.id_admin') != $data_admin->id_admin)
                               disabled
                           @endif
                           value="{{$data_admin->nama}}">
                    <span class="invalid-feedback">
                        @error('nama'){{$message}} @enderror
                    </span>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email" name="email" id="email"
                           @if(\Illuminate\Support\Facades\Session::get('admin.id_admin') != $data_admin->id_admin)
                               disabled
                           @endif
                           value="{{$data_admin->email}}">
                    <span class="invalid-feedback">
                        @error('email'){{$message}} @enderror
                    </span>
                </div>

                <div class="input-group mb-3">
                    <button class="btn btn-warning btn-block text-white" formaction="{{route('lupa.password')}}">
                        <i class="fas fa-lock"></i>
                        Reset Password
                    </button>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block"
                                @if(\Illuminate\Support\Facades\Session::get('admin.id_admin') != $data_admin->id_admin)
                                    hidden
                            @endif
                        >
                            Edit Admin
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
        </div>

        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
