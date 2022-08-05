<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('assets/AdminLTE/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-md">GeekGarden Attendance</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 ml-2 d-flex">
            <div class="info">
                <a href="#" class="d-block">ADM-{{\Illuminate\Support\Facades\Session::get('admin.nama')}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{($title == 'Dashboard')? 'active': ''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item {{($title == 'Hasil Absensi') || ($title == 'Pengajuan Izin' || $title == 'Laporan Absensi')? 'menu-is-opening menu-open': ''}}">
                    <a href="#" class="nav-link {{($title == 'Hasil Absensi') || ($title == 'Pengajuan Izin'|| $title == 'Laporan Absensi')? 'active': ''}}">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Absensi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.halaman.kelola.hasil.absensi')}}" class="nav-link {{($title == 'Hasil Absensi')? 'active': ''}}">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>
                                    Hasil Absensi
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.halaman.kelola.pengajuan.izin')}}" class="nav-link {{($title == 'Pengajuan Izin')? 'active': ''}}">
                                <i class="nav-icon fas fa-file-contract"></i>
                                <p>
                                    Pengajuan Izin
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.halaman.kelola.laporan.absensi')}}" class="nav-link {{($title == 'Laporan Absensi')? 'active': ''}}">
                                <i class="nav-icon fas fa-exclamation"></i>
                                <p>
                                    Laporan Absensi
                                </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{($title == 'Mading')? 'menu-is-opening menu-open': ''}}">
                    <a href="{{route('admin.halaman.mading')}}" class="nav-link {{($title == 'Mading')? 'active': ''}}">
                        <i class="nav-icon fas fa-newspaper"></i>
                        <p>
                            Mading GeekGarden
                        </p>
                    </a>
                </li>
{{--                LAINNYA------------------------------------------------------------------------------------------------------------------------}}
                <li class="nav-header">Lainnya</li>
                {{--                Kelola User------------------------------------------------------------------------------------------------------------------------}}

                <li class="nav-item {{($title == 'Admin') || ($title == 'Pegawai')? 'menu-is-opening menu-open': ''}}">
                    <a href="#" class="nav-link {{($title == 'Admin') || ($title == 'Pegawai')? 'active': ''}}">
                        <i class="nav-icon fas fa-users-cog"></i>
                        <p>
                            Kelola User
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('admin.kelola.admin')}}" class="nav-link {{($title == 'Admin')? 'active': ''}}">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>Kelola Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('admin.kelola.pegawai')}}" class="nav-link {{($title == 'Pegawai')? 'active': ''}}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Kelola Pegawai</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--                Waktu Kerja------------------------------------------------------------------------------------------------------------------------}}
                <li class="nav-item {{($title == 'Jam Kerja') || ($title == 'Tanggal Libur')? 'menu-is-opening menu-open': ''}}">
                    <a href="#" class="nav-link {{($title == 'Jam Kerja') || ($title == 'Tanggal Libur')? 'active': ''}}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Kelola Waktu Kerja
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{($title == 'Jam Kerja')? 'active': ''}}">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>Kelola Jam Kerja</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{($title == 'Tanggal Libur')? 'active': ''}}">
                                <i class="nav-icon fas fa-calendar-day"></i>
                                <p>Kelola Tanggal Libur</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item {{($title == 'Logout')? 'menu-is-opening menu-open': ''}}">
                    <a href="#" class="nav-link {{($title == 'Logout')? 'active': ''}}">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
