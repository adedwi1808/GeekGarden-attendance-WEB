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
                                Berhasil Menambahkan Mading
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
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th scope="col" class="col-2">Judul</th>
                                <th scope="col" class="col-4">Informasi</th>
                                <th scope="col" class="col-2">Foto</th>
                                <th scope="col" class="col-2">Tanggal</th>
                                <th scope="col" class="col-2">Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_mading as $index=>$mading)
                                <tr>
                                    <td class="col-2">{{$mading->judul}}</td>
                                    <td class="col-4">{{(strlen($mading->informasi) > 60)? substr($mading->informasi, 0,60)."..." : $mading->informasi}}</td>
                                    <td class="col-2"><a class="link-primary" href="/storage/mading/{{$mading->foto}}">
                                            {{(strlen($mading->foto) > 18)? substr($mading->foto, 0,18)."..." : $mading->foto}}
                                        </a>
                                    </td>
                                    <td class="col-2">{{$mading->create_at}}</td>
                                    <td class="col-2">
                                        <div class="row justify-content-center">
                                            <form class="mx-2"
                                                  action="#"
                                                  method="get" target="_blank">
                                                <button type="submit" class="btn btn-info"><i
                                                        class="fas fa-eye"></i>
                                                </button>
                                            </form>
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
                                    Data Mading Tidak Ditemukan / Tidak Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                        </table>
                        <div class="d-flex align-items-center justify-content-center ">
                            {{$data_mading->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
