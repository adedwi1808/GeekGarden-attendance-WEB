<!-- Button trigger modal -->
<button type="button" class="btn btn-info float-left" formaction="" data-toggle="modal"
        data-target="#modalTambahAbsen">
    <i class="fa fa-plus"></i>
    Tambah Hari Libur
</button>
<form
    action="{{route('admin.tambah.hari.libur')}}"
    method="post">
    @csrf
    <div class="modal fade" id="modalTambahAbsen" tabindex="-1" role="dialog"
         aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Tambah Hari Libur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="input-group mb-3 ">
                        <div class="input-group-prepend">
                        <span class="input-group-text">
                            <i class="fas fa-heading"></i>
                        </span>
                        </div>
                        <input type="text"
                               class="form-control @error('nama')is-invalid @enderror"
                               placeholder="Nama Hari Libur" name="nama" id="nama"
                               value="{{old('nama')}}">
                        <span class="invalid-feedback">
                        @error('nama'){{$message}} @enderror
                    </span>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="date_range">Rentang Waktu:</label>
                                <div id="date_range" class="row">
                                    <div class="col-6">
                                        <input type="date" class="form-control"
                                               name="tanggal_mulai" value="">
                                    </div>
                                    <div class="col-6">
                                        <input type="date" class="form-control" name="tanggal_selesai"
                                               value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal
                    </button>
                    <button type="submit" class="btn btn-success">Tambahkan</button>
                </div>
            </div>
        </div>
    </div>
</form>
