<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiPegawaiExport implements FromView
{

    public function __construct($waktu, )
    {
        $this->waktu = $waktu;
    }

    public function view(): View
    {
        $waktu = $this->waktu;

        $data_absensi = Absensi::with('pegawai')
            ->whereBetween('tanggal', $waktu)
            ->get();

        return view('CetakLaporan.CetakEXCEL.detail_absensi', compact('data_absensi'));
    }
}
