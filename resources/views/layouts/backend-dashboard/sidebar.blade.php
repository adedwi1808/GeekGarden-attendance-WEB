<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="{{asset('assets/gg.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light text-md">GeekGarden Attendance</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('assets/admin.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{\Illuminate\Support\Facades\Session::get('admin.nama')}}</a>
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

                <li class="nav-item {{($title == 'Hasil Absensi') || ($title == 'Pengajuan Izin' || $title == 'Pengaduan Absensi' || $title == 'Lembur')? 'menu-is-opening menu-open': ''}}">
                    <a href="#" class="nav-link {{($title == 'Hasil Absensi') || ($title == 'Pengajuan Izin'|| $title == 'Pengaduan Absensi' || $title == 'Lembur')? 'active': ''}}">
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
                            <a href="{{route('admin.halaman.kelola.pengaduan.absensi')}}" class="nav-link {{($title == 'Pengaduan Absensi')? 'active': ''}}">
                                <i class="nav-icon fas fa-exclamation"></i>
                                <p>
                                    Pengaduan Absensi
                                </p>
                            </a>

                        <li class="nav-item">
                            <a href="{{route('admin.halaman.kelola.lembur')}}" class="nav-link {{($title == 'Lembur')? 'active': ''}}">
                                <i class="nav-icon fas fa-user-clock"></i>
                                <p>
                                    Lembur
                                </p>
                            </a>
                        </li>
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
                <li class="nav-item {{($title == 'Cetak Laporan')? 'menu-is-opening menu-open': ''}}">
                    <a href="{{route('admin.halaman.cetak.laporan')}}" class="nav-link {{($title == 'Cetak Laporan')? 'active': ''}}">
                        <i class="nav-icon fas fa-print"></i>
                        <p>
                            Cetak Laporan
                        </p>
                    </a>
                </li>
                {{--                Waktu Kerja------------------------------------------------------------------------------------------------------------------------}}
                <li class="nav-item {{($title == 'Waktu Kerja')? 'menu-is-opening menu-open': ''}}">
                    <a href="{{route('admin.halaman.kelola.waktu.kerja')}}" class="nav-link {{($title == 'Waktu Kerja')? 'active': ''}}">
                        <i class="nav-icon fas fa-calendar-alt"></i>
                        <p>
                            Kelola Waktu Kerja
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

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
