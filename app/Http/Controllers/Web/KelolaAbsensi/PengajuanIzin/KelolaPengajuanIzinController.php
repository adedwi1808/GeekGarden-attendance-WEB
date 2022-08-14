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

        $data_pengajuan_izin = Pengajuan_izin::join('pegawai', 'pengajuan_izin.id_pegawai', '=', 'pegawai.id_pegawai')
            ->where(function ($query) use($request){
                $query->where('nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%');
                if ($request->jenis_izin != 'All'){
                    $query->where('jenis_izin', '=', $request->jenis_izin);
                }

                if ($request->status_izin != 'All'){
                    $query->where('status_izin', '=', $request->status_izin);
                }
            })
            ->whereBetween('tanggal_mengajukan_izin', $waktu)
            ->get();
        return view('KelolaAbsensi.PengajuanIzin.index', compact('data_pengajuan_izin', 'title'));
    }
}
