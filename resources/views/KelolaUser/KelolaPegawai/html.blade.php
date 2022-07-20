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
                        <button class="btn btn-info float-right">Tambah User</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th scope="col" class="col-2">Nama</th>
                                <th scope="col" class="col-1">Jenis Kelamin</th>
                                <th scope="col" class="col-2">Nomor Hp</th>
                                <th scope="col" class="col-2">Email</th>
                                <th scope="col" class="col-1">Jabatan / Posisi</th>
                                <th scope="col" class="col-1">Foto Profile</th>
                                <th scope="col" class="col-3">Kelola</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($data_pegawai as $index=>$pegawai)
                                <tr>
                                    <td class="col-2">{{$pegawai->nama}}</td>
                                    <td class="col-1">{{$pegawai->jenis_kelamin}}</td>
                                    <td class="col-2">{{$pegawai->nomor_hp}}</td>
                                    <td class="col-2">{{(strlen($pegawai->email) > 18)? substr($pegawai->email, 0,18)."..." : $pegawai->email}}</td>
                                    <td class="col-1">{{$pegawai->jabatan}}</td>
                                    <td class="col-1">{{($pegawai->foto_profile == null)? "-":$pegawai->foto_profile}}</td>
                                    <td class="col-3">
                                        <button type="button" class="btn btn-primary"><i class="far fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-success"><i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                                        </button>
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
                            {{$data_pegawai->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
