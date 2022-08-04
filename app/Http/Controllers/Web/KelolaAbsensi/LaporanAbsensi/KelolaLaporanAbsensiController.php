<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\LaporanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Laporan_Absensi;
use Illuminate\Http\Request;

class KelolaLaporanAbsensiController extends Controller
{
    public function index()
    {
        $title = 'Laporan Absensi';
        $data_laporan = Laporan_Absensi::with(['pegawai','admin'])
            ->get();
        return view('KelolaAbsensi.LaporanAbsensi.index', compact('data_laporan', 'title'));
    }
}
