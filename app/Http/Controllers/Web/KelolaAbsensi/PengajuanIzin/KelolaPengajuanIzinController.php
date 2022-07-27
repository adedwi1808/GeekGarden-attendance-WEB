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

        $data_pengajuan_izin = Pengajuan_izin::with('pegawai')
            ->orderBy('tanggal_mengajukan_izin', 'asc')
            ->paginate(10);
        return view('KelolaAbsensi.PengajuanIzin.index', compact('data_pengajuan_izin', 'title'));
    }
}
