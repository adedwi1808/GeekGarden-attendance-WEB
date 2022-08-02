<section class="content">
    <div class="card">
        <div class="card-header">
            {{--            <h3 class="card-title">Data {{$title}}</h3>--}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                {{--                <form method="get" action="#">--}}
                {{--                    <div class="row mb-2">--}}
                {{--                        <div class="col">--}}
                {{--                            <div class="row">--}}
                {{--                                <div class="col-4">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label for="filter">Rentang Waktu:</label>--}}
                {{--                                        <select id="filter" name="rentang_waktu" class="select2" data-placeholder="Any" style="width: 100%;">--}}
                {{--                                            <option selected>Satu Bulan Terakhir</option>--}}
                {{--                                            <option>Hari Ini</option>--}}
                {{--                                            <option>7 Hari Terakhir</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-2">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label for="tempat">Tempat :</label>--}}
                {{--                                        <select name="tempat" id="tempat" class="select2" style="width: 100%;">--}}
                {{--                                            <option selected>All</option>--}}
                {{--                                            <option>Dikantor</option>--}}
                {{--                                            <option>Diluar Kantor</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div><div class="col-2">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label for="status">Status:</label>--}}
                {{--                                        <select name="status" id="status" class="select2" style="width: 100%;">--}}
                {{--                                            <option selected>All</option>--}}
                {{--                                            <option>Hadir</option>--}}
                {{--                                            <option>Pulang</option>--}}
                {{--                                            <option>Izin</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-2">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label for="sort">Sort Order:</label>--}}
                {{--                                        <select name="sort_order" id="sort" class="select2" style="width: 100%;">--}}
                {{--                                            <option selected value="asc">ASC</option>--}}
                {{--                                            <option value="desc">DESC</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-2">--}}
                {{--                                    <div class="form-group">--}}
                {{--                                        <label for="order">Order By:</label>--}}
                {{--                                        <select name="order_by" id="order" class="select2" style="width: 100%;">--}}
                {{--                                            <option selected>Tanggal</option>--}}
                {{--                                            <option>Nama</option>--}}
                {{--                                        </select>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="form-group">--}}
                {{--                                <div class="input-group input-group-lg">--}}
                {{--                                    <input type="search" class="form-control form-control-lg"--}}
                {{--                                           placeholder="Cari Hasil Absensi" name="cari_hasil_absensi">--}}
                {{--                                    <div class="input-group-append">--}}
                {{--                                        <button type="submit" class="btn btn-lg btn-default">--}}
                {{--                                            <i class="fa fa-search"></i>--}}
                {{--                                        </button>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </form>--}}
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
                                <th>Jenis Izin</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan Izin</th>
                                <th>Surat Izin</th>
                                <th>Tanggal Pengajuakan</th>
                                <th>Status</th>
                                <th>Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_pengajuan_izin as $index=>$pengajuan_izin)
                                <tr>
                                    <td>{{$pengajuan_izin->pegawai->nama}}</td>
                                    <td>{{$pengajuan_izin->jenis_izin}}</td>
                                    <td>{{$pengajuan_izin->tanggal_mulai_izin}}</td>
                                    <td>{{$pengajuan_izin->tanggal_selesai_izin}}</td>
                                    <td>{{$pengajuan_izin->alasan_izin}}</td>
                                    <td><a class="link-primary"
                                           href="/storage/surat-izin/{{$pengajuan_izin->surat_izin}}">{{(strlen($pengajuan_izin->surat_izin) > 18)? substr($pengajuan_izin->surat_izin, 0,18)."..." : $pengajuan_izin->surat_izin}}</a></td>
                                    <td>{{$pengajuan_izin->tanggal_mengajukan_izin}}</td>
                                    <td>{{$pengajuan_izin->status_izin}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <form class="mx-2"
                                                  action="{{route('admin.halaman.konfirmasi.pengajuan.izin', $pengajuan_izin->id_pengajuan_izin)}}"
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
                                    Data Absensi Tidak Ditemukan / Belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Nama Pegawai</th>
                                <th>Jenis Izin</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Alasan Izin</th>
                                <th>Surat Izin</th>
                                <th>Tanggal Pengajuakan</th>
                                <th>Status</th>
                                <th>Kelola</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
