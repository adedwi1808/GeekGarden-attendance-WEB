<!-- Button trigger modal -->
<button type="button" class="btn btn-warning float-right text-white" formaction="" data-toggle="modal"
        data-target="#modalUbahJamKerja">
    <i class="fa fa-edit"></i>
    Ubah Jam Kerja
</button>
<form
    action="{{route('admin.ubah.jam.kerja')}}"
    method="post">
    @csrf
    <div class="modal fade" id="modalUbahJamKerja" tabindex="-1" role="dialog"
         aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Ubah Jam Kerja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="date_range">Jam Kerja Waktu:</label>
                                <div id="date_range" class="row">
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="jam_mulai"
                                               value="{{$jam_kerja_terbaru->jam_mulai}}">
                                    </div>
                                    <div class="col-6">
                                        <input type="time" class="form-control" name="jam_selesai"
                                               value="{{$jam_kerja_terbaru->jam_selesai}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <div id="date_range" class="row">
                                    <div class="col-6">
                                        <label>Editor:</label>
                                        <input type="Text" class="form-control" name="editor" disabled
                                               value="{{$jam_kerja_terbaru->admin->nama}}">
                                    </div>
                                    <div class="col-6">
                                        <label>Terakhir dirubah:</label>
                                        <input type="datetime-local" class="form-control" name="tanggal_dibuat"
                                               disabled
                                               value="{{$jam_kerja_terbaru->tanggal_dibuat}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal
                    </button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                </div>
            </div>
        </div>
    </div>
</form>
