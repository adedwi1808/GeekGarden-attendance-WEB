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
                                            <form class="mx-2" action="{{route('admin.hapus.admin',$admin->email)}}" method="post">
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="far fa-trash-alt"></i></button>
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
