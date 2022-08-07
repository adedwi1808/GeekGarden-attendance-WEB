<?php

namespace App\Http\Controllers\Web\CetakLaporan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    public function index()
    {
        $title = "Cetak Laporan";

        $data_absensi = Absensi::with('pegawai')
            ->get();

        return view('CetakLaporan.index', compact('data_absensi', 'title'));
    }


}
