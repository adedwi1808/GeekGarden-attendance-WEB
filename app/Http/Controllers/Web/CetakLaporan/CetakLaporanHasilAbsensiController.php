<?php

namespace App\Http\Controllers\Web\CetakLaporan;

use App\Exports\AbsensiPegawaiExport;
use App\Exports\DetailAbsensiPegawaiExport;
use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Tanggal_Libur;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;

class CetakLaporanHasilAbsensiController extends Controller
{
    public function cetakhasilAbsensiPDF(Request $request)
    {
        $waktu = [$request->start_date, $request->end_date];

        $data_absensi = Absensi::with('pegawai')
            ->whereBetween('tanggal', $waktu)
            ->get();


        $pdf = PDF::loadview('CetakLaporan.CetakPDF.index', compact('data_absensi'))->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
    }

    public function cetakhasilAbsensiEXCEL(Request $request)
    {
        $waktu = [$request->start_date, $request->end_date];

        return \Maatwebsite\Excel\Facades\Excel::download(new AbsensiPegawaiExport($waktu), 'Absensi.xlsx');
    }

}
