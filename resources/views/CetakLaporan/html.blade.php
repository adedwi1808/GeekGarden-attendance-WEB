<section class="content">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Cetak Laporan Absensi</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="date_range">Rentang Waktu:</label>
                            <div id="date_range" class="row">
                                <div class="col-6">
                                    <input type="datetime-local" class="form-control" name="start_date"
                                           value="2022-07-01T00:00">
                                </div>
                                <div class="col-6">
                                    <input type="datetime-local" class="form-control" name="end_date"
                                           value="{{\Carbon\Carbon::now()->endOfDay()->toDateTimeString()}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <a class="btn btn-danger btn-block" href="{{route('admin.cetak.laporan.hasil')}}" target="_blank">
                            <i class="fas fa-file-pdf"></i>
                            Cetak PDF
                        </a>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <a class="btn btn-success btn-block" href="#" target="_blank">
                            <i class="fas fa-file-excel"></i>
                            Cetak Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
