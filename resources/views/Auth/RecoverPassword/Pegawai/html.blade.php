<div class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Silahkan Lengkapi Form Dibawah Untuk Membuat Password Baru</p>
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
                        @csrf
                    </div>
                </div>

                <form action="{{route('reset.password.pegawai')}}" method="post">
                    @csrf
                    <input type="hidden" name="token", value="{{$token}}">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="email" name="email" value="{{$email ?? old('email')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback">
                        @error('email'){{$message}} @enderror
                    </span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                               placeholder="Password" value="{{old('password')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback">
                        @error('password'){{$message}} @enderror
                    </span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                               placeholder="Confirm Password" value="{{old('password_confirmation')}}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span class="invalid-feedback">
                        @error('password_confirmation'){{$message}} @enderror
                    </span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Reset password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
</div>
