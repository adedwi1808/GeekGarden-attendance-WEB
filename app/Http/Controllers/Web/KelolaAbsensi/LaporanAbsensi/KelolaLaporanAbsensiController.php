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

//        return dd($request);

        $waktu = [$request->start_date, $request->end_date];

        if ($request->tanggal_absen != null){
            $tanggal_absen = ['tanggal_absen', '=', $request->tanggal_absen];
        }

        if ($request->status_izin != 'All'){
            $status = ['status_laporan', '=', $request->status_izin];
        }

        if (!empty($tanggal_absen)) { // Tempat -> all
            if (!empty($status)) { //tanggal_absen  & status
                $data_laporan = Laporan_Absensi::join('pegawai', 'laporan_absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->join('admin', 'laporan_absensi.id_admin', '=', 'admin.id_admin')
                    ->where([
                        ['pegawai.nama', 'LIKE', '%' . $request->cari_laporan_absensi . '%'],
                        $tanggal_absen,
                        $status
                    ])
                    ->whereBetween('tanggal_laporan', $waktu)
                    ->get();
            }else{
                $data_laporan = Laporan_Absensi::join('pegawai', 'laporan_absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->join('admin', 'laporan_absensi.id_admin', '=', 'admin.id_admin')
                    ->where([
                        ['pegawai.nama', 'LIKE', '%' . $request->cari_laporan_absensi . '%'],
                        $tanggal_absen
                    ])
                    ->whereBetween('tanggal_laporan', $waktu)
                    ->get();
            }
        } else {
            if (!empty($status)) { // Status
                $data_laporan = Laporan_Absensi::join('pegawai', 'laporan_absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->join('admin', 'laporan_absensi.id_admin', '=', 'admin.id_admin')
                    ->where([
                        ['pegawai.nama', 'LIKE', '%' . $request->cari_laporan_absensi . '%'],
                        $status
                    ])
                    ->whereBetween('tanggal_laporan', $waktu)
                    ->get();
            }else{ //Nothing
                $data_laporan = Laporan_Absensi::join('pegawai', 'laporan_absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->join('admin', 'laporan_absensi.id_admin', '=', 'admin.id_admin')
                    ->where([
                        ['pegawai.nama', 'LIKE', '%' . $request->cari_laporan_absensi . '%'],
                    ])
                    ->whereBetween('tanggal_laporan', $waktu)
                    ->get();
            }
        }
        return view('KelolaAbsensi.LaporanAbsensi.index', compact('data_laporan', 'title'));
    }

}
