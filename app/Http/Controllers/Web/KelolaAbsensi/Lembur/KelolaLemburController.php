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
            ->get();
        return view('KelolaAbsensi.Lembur.index', compact('data_pengajuan_lembur', 'title'));
    }
}
