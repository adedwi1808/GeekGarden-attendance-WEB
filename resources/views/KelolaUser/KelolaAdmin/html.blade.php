<section class="content">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data {{$title}}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-12">
                        <form action="{{route('admin.halaman.tambah.admin')}}" method="get">
                            <button class="btn btn-info float-right">Tambah Admin</button>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center text-bold">
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
                        <table id="table" class="table table-bordered table-hover table-striped text-center">
                        <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data_admin as $admin)
                                <tr>
                                    <td>{{$admin->nama}}</td>
                                    <td>{{$admin->email}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <form class="mx-2" action="{{route('admin.halaman.edit.admin', $admin->id_admin)}}" method="get">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fas fa-edit"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#modalHapus"><i
                                                    class="fas fa-trash"></i>
                                            </button>
                                            <form class="mx-2" action="{{route('admin.hapus.admin',$admin->email)}}" method="post">
                                                @csrf
                                                <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog"
                                                     aria-labelledby="modalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalLabel">Konfirmasi Untuk hapus</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Yakin ingin Menghapus Admin ?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak
                                                                </button>
                                                                <button type="submit" class="btn btn-danger">Ya, hapus</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <div class="alert alert-danger">
                                    Data Admin belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Aksi</th>
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
