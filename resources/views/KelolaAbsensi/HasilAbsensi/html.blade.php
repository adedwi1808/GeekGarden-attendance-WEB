<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <form method="get" action="{{route('admin.cari.hasil.absensi')}}">
                    <div class="row mb-2">
                        <div class="col">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="filter">Rentang Waktu:</label>
                                        <select id="filter" name="rentang_waktu" class="select2" data-placeholder="Any" style="width: 100%;">
                                            <option selected>Satu Bulan Terakhir</option>
                                            <option>Hari Ini</option>
                                            <option>7 Hari Terakhir</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="tempat">Tempat :</label>
                                        <select name="tempat" id="tempat" class="select2" style="width: 100%;">
                                            <option selected>All</option>
                                            <option>Dikantor</option>
                                            <option>Diluar Kantor</option>
                                        </select>
                                    </div>
                                </div><div class="col-2">
                                    <div class="form-group">
                                        <label for="status">Status:</label>
                                        <select name="status" id="status" class="select2" style="width: 100%;">
                                            <option selected>All</option>
                                            <option>Hadir</option>
                                            <option>Pulang</option>
                                            <option>Izin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="sort">Sort Order:</label>
                                        <select name="sort_order" id="sort" class="select2" style="width: 100%;">
                                            <option selected value="asc">ASC</option>
                                            <option value="desc">DESC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="order">Order By:</label>
                                        <select name="order_by" id="order" class="select2" style="width: 100%;">
                                            <option selected>Tanggal</option>
                                            <option>Nama</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" class="form-control form-control-lg"
                                           placeholder="Cari Hasil Absensi" name="cari_hasil_absensi">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-default">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th scope="col" class="col-2">Nama Pegawai</th>
                                <th scope="col" class="col-1">Tempat</th>
                                <th scope="col" class="col-1">Longitude</th>
                                <th scope="col" class="col-1">Latitude</th>
                                <th scope="col" class="col-1">Foto Absensi</th>
                                <th scope="col" class="col-1">Status</th>
                                <th scope="col" class="col-2">Tanggal</th>
                                <th scope="col" class="col-3">Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_absensi as $index=>$absensi)
                                <tr>
                                    <td class="col-2">{{$absensi->nama}}</td>
                                    <td class="col-1">{{$absensi->tempat}}</td>
                                    <td class="col-1">{{$absensi->longitude}}</td>
                                    <td class="col-1">{{$absensi->latitude}}</td>
                                    <td class="col-1"><a class="link-primary"
                                                         href="/storage/bukti-absen/{{$absensi->foto}}">{{(strlen($absensi->foto) > 18)? substr($absensi->foto, 0,18)."..." : $absensi->foto}}</a>
                                    </td>
                                    <td class="col-1">{{$absensi->status}}</td>
                                    <td class="col-2">{{$absensi->tanggal}}</td>
                                    <td class="col-3">
                                        <div class="row justify-content-center">
                                            <form class="mx-2"
                                                  action="https://www.google.com/maps/search/{{$absensi->latitude.','.$absensi->longitude}}"
                                                  method="get" target="_blank">
                                                <button type="submit" class="btn btn-info"><i
                                                        class="fas fa-map-marked"></i>
                                                </button>
                                            </form>
                                            <form class="mx-2"
                                                  action="{{route('admin.halaman.edit.absensi', $absensi->id_absensi)}}"
                                                  method="get">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <form class="mx-2" action="" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="far fa-trash-alt"></i></button>
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
                            {{$data_absensi->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
