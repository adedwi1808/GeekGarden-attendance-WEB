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
                'lembur.tanggal_dibuat', 'lembur.status_lembur', 'lembur.id_lembur',  'pegawai.nama as nama_pegawai',
                'absensi.tempat')
            ->get();

//        return dd($data_pengajuan_lembur);
        return view('KelolaAbsensi.Lembur.index', compact('data_pengajuan_lembur', 'title'));
    }
}
