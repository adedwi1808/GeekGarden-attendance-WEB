<section class="content">
    <div class="card">
        <div class="card-header">
{{--            <h3 class="card-title">Data {{$title}}</h3>--}}
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-6">
                        <form action="{{route('admin.halaman.tambah.pegawai')}}" method="get">
                            <button class="btn btn-info float-left">Tambah Pegawai</button>
                        </form>
                    </div>
                    <div class="col-6 ">
                        <form action="{{route('admin.cari.pegawai')}}" method="get">
                            <div class="input-group input-group-sm float-right" style="width: 60%;">
                                <input type="text" name="cari_pegawai" class="form-control float-right"
                                       placeholder="Cari Pegawai">
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
                        <table id="table" class="table table-bordered table-hover">
                            <thead>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor Hp</th>
                                <th>Email</th>
                                <th>Jabatan / Posisi</th>
                                <th>Foto Profile</th>
                                <th>Kelola</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($data_pegawai as $index=>$pegawai)
                                <tr>
                                    <td>{{$pegawai->nama}}</td>
                                    <td>{{$pegawai->jenis_kelamin}}</td>
                                    <td>{{$pegawai->nomor_hp}}</td>
                                    <td>{{(strlen($pegawai->email) > 18)? substr($pegawai->email, 0,18)."..." : $pegawai->email}}</td>
                                    <td>{{$pegawai->jabatan}}</td>
                                    <td>{{($pegawai->foto_profile == null)? "-":((strlen($pegawai->foto_profile) > 18)? substr($pegawai->foto_profile, 0,18)."..." : $pegawai->foto_profile)}}</td>
                                    <td>
                                        <div class="row justify-content-center">
                                            <form class="mx-2"
                                                  action="{{route('admin.halaman.edit.pegawai', $pegawai->id_pegawai)}}"
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
                                    Data Pegawai belum Tersedia.
                                </div>
                            @endforelse
                            </tbody>
                            <tfoot>
                            <tr class="text-center">
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Nomor Hp</th>
                                <th>Email</th>
                                <th>Jabatan / Posisi</th>
                                <th>Foto Profile</th>
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
