<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.dashboard')}}" class="nav-link">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.halaman.mading')}}" class="nav-link">Mading GeekGarden</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{route('admin.halaman.cetak.laporan')}}" class="nav-link">Cetak Laporan</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a class="dropdown-item">
                    <form action="{{route('admin.halaman.edit.admin', \Illuminate\Support\Facades\Session::get('admin.id_admin'))}}"  class="dropitem" method="get">
                        @csrf
                        <button class="btn btn-flat"><i class="fas fa-user-cog"></i></button>
                        Edit Profile
                    </form>
                </a>
                <div class="dropdown-divider"></div>

                <a class="dropdown-item">
                    <form action="{{route('admin.logout')}}"  class="dropitem" method="POST">
                        @csrf
                        <button class="btn btn-flat"><i class="fas fa-sign-out-alt"></i></button>
                        Logout
                    </form>
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- /.navbar -->

