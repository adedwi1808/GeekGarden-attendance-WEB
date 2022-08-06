<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\PengajuanIzin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan_izin;
use Illuminate\Http\Request;

class KelolaPengajuanIzinController extends Controller
{
    public function index()
    {
        $title = 'Pengajuan Izin';

        $data_pengajuan_izin = Pengajuan_izin::with(['pegawai','admin'])
            ->orderBy('tanggal_mengajukan_izin', 'asc')
            ->get();
        return view('KelolaAbsensi.PengajuanIzin.index', compact('data_pengajuan_izin', 'title'));
    }

    public function cariPengajuanIzin(Request $request)
    {
        $title = 'Pengajuan Izin';

        $waktu = [$request->start_date, $request->end_date];

        if ($request->jenis_izin != 'All'){
            $jenis_izin = ['jenis_izin', '=', $request->jenis_izin];
        }

        if ($request->status_izin != 'All'){
            $status = ['status_izin', '=', $request->status_izin];
        }

        if (!empty($jenis_izin)) { // Tempat -> all
            if (!empty($status)) { //jenis_izin  & status
                $data_pengajuan_izin = Pengajuan_izin::join('pegawai', 'pengajuan_izin.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $jenis_izin,
                        $status
                    ])
                    ->whereBetween('tanggal_mengajukan_izin', $waktu)
                    ->get();
            }else{
                $data_pengajuan_izin = Pengajuan_izin::join('pegawai', 'pengajuan_izin.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $jenis_izin
                    ])
                    ->whereBetween('tanggal_mengajukan_izin', $waktu)
                    ->get();
            }
        } else {
            if (!empty($status)) { // Status
                $data_pengajuan_izin = Pengajuan_izin::join('pegawai', 'pengajuan_izin.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $status
                    ])
                    ->whereBetween('tanggal_mengajukan_izin', $waktu)
                    ->get();
            }else{ //Nothing
                $data_pengajuan_izin = Pengajuan_izin::join('pegawai', 'pengajuan_izin.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['pegawai.nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                    ])
                    ->whereBetween('tanggal_mengajukan_izin', $waktu)
                    ->get();
            }
        }
        return view('KelolaAbsensi.PengajuanIzin.index', compact('data_pengajuan_izin', 'title'));
    }



}
