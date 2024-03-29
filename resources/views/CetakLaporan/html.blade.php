<section class="content">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Cetak Laporan Absensi</h2>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="container">
                <form method="get">
                    @csrf
                    <div class="row mt-3">
                        <div class="col-8">
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
                        <div class="col-4">
                            <div class="form-group">
                                <label for="pegawai">Pegawai:</label>
                                <select name="pegawai" id="pegawai" class="select2" style="width: 100%;">
                                    <option @if(old('$pegawai') == 'All') selected @endif value="All">All</option>
                                    @foreach($data_pegawai as $pegawai)
                                    <option value="{{$pegawai->id_pegawai}}" @if(old('pegawai') == $pegawai->nama) selected @endif>{{$pegawai->nama}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-danger btn-block" formaction="{{route('admin.cetak.laporan.hasil')}}">
                                <i class="fas fa-file-pdf"></i>
                                Cetak PDF
                            </button>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                                <button class="btn btn-success btn-block" formaction="{{route('admin.cetak.laporan.hasil.excel')}}">
                                    <i class="fas fa-file-excel"></i>
                                    Cetak Excel
                                </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</section>
