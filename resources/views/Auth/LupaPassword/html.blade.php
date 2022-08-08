<div class="register-box">
    <div class="register-logo">
        <a href="/login"><b>Admin</b>LTE</a>
    </div>

    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Lupa Password</p>

            <form action="{{route('lupa.password')}}" method="post">
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
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           placeholder="Email" name="email" id="email" value="{{old('email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                    <span class="invalid-feedback">
                        @error('email'){{$message}} @enderror
                    </span>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Reset password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="{{route('admin.login')}}" class="text-center">Login</a>
        </div>
        <!-- /.form-box -->
    </div><!-- /.card -->
</div>
