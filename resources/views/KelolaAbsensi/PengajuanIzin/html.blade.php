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
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th scope="col" class="col-2">Nama Pegawai</th>
                                <th scope="col" class="col-1">Jenis Izin</th>
                                <th scope="col" class="col-1">Tanggal Mulai</th>
                                <th scope="col" class="col-1">Tanggal Selesai</th>
                                <th scope="col" class="col-1">Alasan Izin</th>
                                <th scope="col" class="col-1">Surat Izin</th>
                                <th scope="col" class="col-2">Tanggal Pengajuakan</th>
                                <th scope="col" class="col-1">Status</th>
                                <th scope="col" class="col-1">Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_pengajuan_izin as $index=>$pengajuan_izin)
                                <tr>
                                    <td class="col-2">{{$pengajuan_izin->pegawai->nama}}</td>
                                    <td class="col-1">{{$pengajuan_izin->jenis_izin}}</td>
                                    <td class="col-1">{{$pengajuan_izin->tanggal_mulai_izin}}</td>
                                    <td class="col-1">{{$pengajuan_izin->tanggal_selesai_izin}}</td>
                                    <td class="col-1">{{$pengajuan_izin->alasan_izin}}</td>
                                    <td class="col-1">{{$pengajuan_izin->surat_izin}}</td>
                                    <td class="col-2">{{$pengajuan_izin->tanggal_mengajukan_izin}}</td>
                                    <td class="col-1">{{$pengajuan_izin->status_izin}}</td>
                                    <td class="col-1">
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
                                    Data Absensi Tidak Ditemukan / Belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex align-items-center justify-content-center ">
                                                        {{$data_pengajuan_izin->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
