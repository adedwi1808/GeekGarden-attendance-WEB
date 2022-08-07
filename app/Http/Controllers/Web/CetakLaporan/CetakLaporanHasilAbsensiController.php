<?php

namespace App\Http\Controllers\Web\CetakLaporan;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CetakLaporanHasilAbsensiController extends Controller
{
    public function cetakhasilAbsensiPDF()
    {
        $data_absensi = Absensi::with('pegawai')
            ->get();

        $pdf = PDF::loadview('CetakLaporan.CetakPDF.index', compact('data_absensi'))->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
