<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\Lembur;

use App\Http\Controllers\Controller;
use App\Models\Lembur;
use Illuminate\Http\Request;

class KelolaLemburController extends Controller
{
    public function index()
    {
        $title = "Lembur";

        $data_pengajuan_lembur = Lembur::join('absensi', 'lembur.id_absensi', '=','absensi.id_absensi')
            ->join('pegawai', 'absensi.id_pegawai', '=','pegawai.id_pegawai')
            ->leftJoin('admin', 'lembur.id_admin', '=','admin.id_admin')
            ->select('admin.nama as nama_admin', 'admin.id_admin as id_admin', 'lembur.tanggal_konfirm',
                'lembur.tanggal_dibuat', 'lembur.status_lembur', 'lembur.id_lembur',  'pegawai.nama as nama_pegawai'
                ,
//                'absensi.tempat'
            )
            ->get();
        return view('KelolaAbsensi.Lembur.index', compact('data_pengajuan_lembur', 'title'));
    }

    public function cariLembur(Request $request)
    {
        $title = 'Lembur';

        $waktu = [$request->start_date, $request->end_date];

        $data_pengajuan_lembur = Lembur::join('absensi', 'lembur.id_absensi', '=','absensi.id_absensi')
            ->join('pegawai', 'absensi.id_pegawai', '=','pegawai.id_pegawai')
            ->leftJoin('admin', 'lembur.id_admin', '=','admin.id_admin')
            ->select('admin.nama as nama_admin', 'admin.id_admin as id_admin', 'lembur.tanggal_konfirm',
                'lembur.tanggal_dibuat', 'lembur.status_lembur', 'lembur.id_lembur',  'pegawai.nama as nama_pegawai',
//                'absensi.tempat'
            )
            ->where(function ($query) use($request){
                $query->where('pegawai.nama', 'LIKE', '%' . $request->cari_lembur . '%');
//                if ($request->tempat_absen != 'All'){
//                    $query->where('absensi.tempat', '=', $request->tempat_absen);
//                }

                if ($request->status_lembur != 'All'){
                    $query->where('status_lembur', '=', $request->status_lembur);
                }
            })
            ->whereBetween('tanggal_dibuat', $waktu)
            ->get();
        return view('KelolaAbsensi.Lembur.index', compact('data_pengajuan_lembur', 'title'));
    }
}
