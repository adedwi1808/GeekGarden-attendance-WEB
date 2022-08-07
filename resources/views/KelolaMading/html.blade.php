<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <div class="row  mb-3">
                    <div class="col-6">
                        <form action="{{route('admin.halaman.tambah.mading')}}" method="get">
                            <button class="btn btn-info float-left">Tambah Mading</button>
                        </form>
                    </div>
                    <div class="col-6">
                        <form action="{{route('admin.cari.mading')}}" method="get">
                            <div class="input-group input-group-sm float-right" style="width: 60%;">
                                <input type="text" name="cari_mading" class="form-control"
                                       placeholder="Cari Mading">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @if(Session::get('success'))
                            <div class="alert alert-success">
                                {{Session::get('success')}}
                            </div>
                        @endif

                        @if(Session::get('fail'))
                            <div class="alert alert-danger">
                                {{Session::get('fail')}}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <table id="table" class="table table-bordered table-striped table-hover text-center">
                            <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Informasi</th>
                                <th>Foto</th>
                                <th>Tanggal</th>
                                <th>Penulis</th>
                                <th>Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_mading as $index=>$mading)
                                <tr>
                                    <td>{{$mading->judul}}</td>
                                    <td>{{(strlen($mading->informasi) > 60)? substr($mading->informasi, 0,60)."..." : $mading->informasi}}</td>
                                    <td><a class="link-primary" href="/storage/mading/{{$mading->foto}}">
                                            {{(strlen($mading->foto) > 18)? substr($mading->foto, 0,18)."..." : $mading->foto}}
                                        </a>
                                    </td>
                                    <td>{{$mading->create_at}}</td>
                                    <td>{{$mading->admin->nama}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <form class="col-6"
                                                  action="{{route('admin.lihat.mading',$mading->id_mading)}}"
                                                  method="get" target="_blank">
                                                <button type="submit" class="btn btn-info"><i
                                                        class="fas fa-eye"></i>
                                                </button>
                                            </form>
                                            <form class="col-6"
                                                  action="{{route('admin.halaman.edit.mading',$mading->id_mading)}}"
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
                                    Data Mading Tidak Ditemukan / Tidak Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Judul</th>
                                <th>Informasi</th>
                                <th>Foto</th>
                                <th>Tanggal</th>
                                <th>Penulis</th>
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
