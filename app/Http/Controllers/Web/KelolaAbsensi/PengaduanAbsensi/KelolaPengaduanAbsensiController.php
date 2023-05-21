<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\PengaduanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan_Absensi;
use Illuminate\Http\Request;

class KelolaPengaduanAbsensiController extends Controller
{
    public function index()
    {
        $title = 'Pengaduan Absensi';
        $data_pengaduan = Pengaduan_Absensi::with(['pegawai','admin'])
            ->get();
        return view('KelolaAbsensi.PengaduanAbsensi.index', compact('data_pengaduan', 'title'));
    }

    public function cariPengaduanAbsensi(Request $request)
    {
        $title = 'Pengaduan Absensi';

        $waktu = [$request->start_date, $request->end_date];

        $pengaduan = Pengaduan_Absensi::join('pegawai', 'pengaduan_absensi.id_pegawai', '=', 'pegawai.id_pegawai')
            ->join('admin', 'pengaduan_absensi.id_admin', '=', 'admin.id_admin')
            ->where(function ($query) use ($request){
                $query->where('pegawai.nama', 'LIKE', '%' . $request->cari_pengaduan_absensi . '%');
                if ($request->tanggal_absen != null){
                    $query->where('tanggal_absen', '=', $request->tanggal_absen);
                }
                if ($request->status_pengaduan != 'All'){
                    $query->where('status_pengaduan', '=', $request->status_pengaduan);
                }
            })
            ->whereBetween('tanggal_pengaduan', $waktu)
            ->get();
        return view('KelolaAbsensi.LaporanAbsensi.index', compact('pengaduan', 'title'));
    }
}
