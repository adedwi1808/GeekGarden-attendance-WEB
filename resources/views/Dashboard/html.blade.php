<section class="content">
    @php
    $jumlah_pegawai = \App\Models\Pegawai::count();
    $jumlah_absensi = \App\Models\Absensi::whereMonth('tanggal', \Carbon\Carbon::today()->month)->count();
    $jumlah_laporan_absensi = \App\Models\Laporan_Absensi::where("status_laporan", "Diajukan")->count();
    $jumlah_pengajuan_izin = \App\Models\Pengajuan_izin::where("status_izin", "Diajukan")->count();
    @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-12">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3>{{$jumlah_pegawai}}</h3>
                        <p>Jumlah Pegawai</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-12">

                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>{{$jumlah_absensi}}</sup></h3>
                        <p>Absensi Bulan Ini</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>


        </div>
        <div class="row">

            <div class="col-lg-6 col-12">

                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>{{$jumlah_laporan_absensi}}</h3>
                        <p>Laporan Absensi Yang Belum Diproses</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6 col-12">

                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>{{$jumlah_pengajuan_izin}}</h3>
                        <p>Pengajuan Izin Yang Belum Diproses</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        More info <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>

        </div>

</section>
