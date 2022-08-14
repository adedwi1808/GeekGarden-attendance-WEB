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

    public function cariLaporanAbsensi(Request $request)
    {
        $title = 'Laporan Absensi';

        $waktu = [$request->start_date, $request->end_date];

        $data_laporan = Laporan_Absensi::join('pegawai', 'laporan_absensi.id_pegawai', '=', 'pegawai.id_pegawai')
            ->join('admin', 'laporan_absensi.id_admin', '=', 'admin.id_admin')
            ->where(function ($query) use ($request){
                $query->where('pegawai.nama', 'LIKE', '%' . $request->cari_laporan_absensi . '%');
                if ($request->tanggal_absen != null){
                    $query->where('tanggal_absen', '=', $request->tanggal_absen);
                }
                if ($request->status_izin != 'All'){
                    $query->where('status_laporan', '=', $request->status_izin);
                }
            })
            ->whereBetween('tanggal_laporan', $waktu)
            ->get();
        return view('KelolaAbsensi.LaporanAbsensi.index', compact('data_laporan', 'title'));
    }

}
