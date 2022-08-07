<?php

namespace App\Exports;

use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Facades\Excel;

class DetailAbsensiPegawaiExport implements FromView
{

    public function __construct($waktu, )
    {
        $this->waktu = $waktu;
    }

    public function view(): View
    {
        $data_absensi_pegawai = Pegawai::with('absensi')
            ->get();
        $waktu = $this->waktu;

        return view('CetakLaporan.CetakEXCEL.detail_absensi', compact('data_absensi_pegawai' , 'waktu'));
    }

}
