<?php

namespace App\Http\Controllers\Web\CetakLaporan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    public function index()
    {
        $title = "Cetak Laporan";

        $data_absensi = Absensi::with('pegawai')
            ->get();
        $data_pegawai = Pegawai::all();

        return view('CetakLaporan.index', compact('data_absensi','data_pegawai', 'title'));
    }


}
