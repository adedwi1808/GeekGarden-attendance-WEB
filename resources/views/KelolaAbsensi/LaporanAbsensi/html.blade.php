<section class="content">
    <div class="card">
        <div class="card-header">
            {{--            <h3 class="card-title">Data {{$title}}</h3>--}}
        </div>
        <!-- /.card-header -->
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(Session::get('success'))
                        <div class="alert alert-success" role="alert">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::get('success2'))
                        <div class="alert alert-warning" role="alert">
                            {{Session::get('success2')}}
                        </div>
                    @endif
                    @if(Session::get('fail'))
                        <div class="alert alert-danger" role="alert">
                            {{Session::get('fail')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-hover text-center" id="table">
                        <thead>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Absen</th>
                            <th>Keterangan Laporan</th>
                            <th>Tanggal Pengajuakan</th>
                            <th>Status</th>
                            <th>Kelola</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($data_laporan as $index=>$laporan)
                            <tr>
                                <td>{{$laporan->pegawai->nama}}</td>
                                <td>{{$laporan->tanggal_absen}}</td>
                                <td>{{$laporan->keterangan_laporan}}</td>
                                <td>{{$laporan->tanggal_laporan}}</td>
                                <td>{{$laporan->status_laporan}}</td>
                                <td>
                                    <div class="row justify-content-center">
                                        <form class="mx-2"
                                              action="#"
                                              method="get">
                                            <button type="submit" class="btn btn-success"><i
                                                    class="fas fa-edit"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <div class="alert alert-danger">
                                Data Laporan Absensi Tidak Ditemukan / Belum Tersedia.
                            </div>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>Nama Pegawai</th>
                            <th>Tanggal Absen</th>
                            <th>Keterangan Laporan</th>
                            <th>Tanggal Pengajuakan</th>
                            <th>Status</th>
                            <th>Kelola</th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
