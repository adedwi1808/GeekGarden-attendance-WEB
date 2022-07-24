<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <form>
                    <div class="row mb-2">
                        <div class="col">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="filter">Result Type:</label>
                                        <select id="filter" class="select2" multiple="multiple" data-placeholder="Any" style="width: 100%;">
                                            <option>7 Hari Terakhir</option>
                                            <option>Images</option>
                                            <option>Video</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="sort">Sort Order:</label>
                                        <select id="sort" class="select2" style="width: 100%;">
                                            <option selected>ASC</option>
                                            <option>DESC</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="order">Order By:</label>
                                        <select id="order" class="select2" style="width: 100%;">
                                            <option selected>Title</option>
                                            <option>Date</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-lg">
                                    <input type="search" class="form-control form-control-lg" placeholder="Type your keywords here" value="Lorem ipsum">
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
                                <th scope="col" class="col-2">Foto Absensi</th>
                                <th scope="col" class="col-1">Status</th>
                                <th scope="col" class="col-2">Tanggal</th>
                                <th scope="col" class="col-2">Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_absensi as $index=>$absensi)
                                <tr>
                                    <td class="col-2">{{$absensi->nama}}</td>
                                    <td class="col-1">{{$absensi->tempat}}</td>
                                    <td class="col-1">{{$absensi->longitude}}</td>
                                    <td class="col-1">{{$absensi->latitude}}</td>
                                    <td class="col-2"><a class="link-primary"
                                                         href="/storage/bukti-absen/{{$absensi->foto}}">{{(strlen($absensi->foto) > 18)? substr($absensi->foto, 0,18)."..." : $absensi->foto}}</a>
                                    </td>
                                    <td class="col-1">{{$absensi->status}}</td>
                                    <td class="col-2">{{$absensi->tanggal}}</td>
                                    <td class="col-2">
                                        <div class="row justify-content-center">
                                            <form class="mx-2"
                                                  action="{{route('admin.halaman.edit.pegawai', $absensi->id_absensi)}}"
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
                                    Data Pegawai belum Tersedia.
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
