<?php

namespace App\Exports;

use App\Models\Absensi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class AbsensiPegawaiExport implements FromView
{

    public function __construct($waktu, $pegawai)
    {
        $this->waktu = $waktu;
        $this->pegawai = $pegawai;
    }

    public function view(): View
    {
        $waktu = $this->waktu;
        $pegawai = $this->pegawai;
        $data_absensi = Absensi::with('pegawai')
            ->where(function ($query) use($pegawai){
                if ($pegawai != "All") {
                    $query->where('id_pegawai', $pegawai);
                }
            })
            ->whereBetween('tanggal', $waktu)
            ->get();

        return view('CetakLaporan.CetakEXCEL.detail_absensi', compact('data_absensi'));
    }
}
