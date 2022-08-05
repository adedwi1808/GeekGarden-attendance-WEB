<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('layouts.backend-kelolauser.stylesheet')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


    @include('layouts.backend-dashboard.navbar')

    @include('layouts.backend-dashboard.sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Kelola {{$title}}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Kelola Pegawai</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        @yield('content')
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('layouts.backend-dashboard.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('layouts.backend-kelolauser.javascript')
</body>
</html>
