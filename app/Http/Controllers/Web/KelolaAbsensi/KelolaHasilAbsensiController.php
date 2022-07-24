<?php

namespace App\Http\Controllers\Web\KelolaAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaHasilAbsensiController extends Controller
{
    public function index()
    {

        $title = 'Hasil Absensi';
        $data_absensi = DB::table('absensi')
            ->join('pegawai', 'absensi.id_pegawai','=','pegawai.id_pegawai')
            ->select('pegawai.nama', 'absensi.id_absensi' ,'absensi.tempat', 'absensi.longitude', 'absensi.latitude'
                , 'absensi.foto','absensi.status', 'absensi.tanggal')
            ->orderBy('tanggal', 'asc')
            ->paginate(15);
        return view('KelolaAbsensi.HasilAbsensi.index', compact('data_absensi', 'title'));
    }
}
