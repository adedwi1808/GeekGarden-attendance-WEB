<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\HasilAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelolaHasilAbsensiController extends Controller
{
    public function index()
    {
        $title = 'Hasil Absensi';
        $data_absensi = Absensi::with('pegawai')
            ->get();
        return view('KelolaAbsensi.HasilAbsensi.index', compact('data_absensi', 'title'));
    }

    public function cariHasilAbsensi(Request $request)
    {
        $title = 'Hasil Absensi';

        $waktu = [$request->start_date, $request->end_date];

        $data_absensi= Absensi::join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
            ->where(function ($query) use ($request) {
                $query->where('nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%');
                if($request->tempat != 'All') {
                    $query->where('tempat', '=', $request->tempat);
                }
                if ($request->status != 'All'){
                    $query->where('status', '=', $request->status);
                }

            })->whereBetween('tanggal', $waktu)
            ->get();
        return view('KelolaAbsensi.HasilAbsensi.index', compact('data_absensi', 'title'));
    }
}
