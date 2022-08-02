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

        if ($request->tempat != 'All'){
            $tempat = ['tempat', '=', $request->tempat];
        }

        if ($request->status != 'All'){
            $status = ['status', '=', $request->status];
        }

        if (!empty($tempat)) { // Tempat -> all
            if (!empty($status)) { //tempat  & status
                $data_absensi = Absensi::join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $tempat,
                        $status
                    ])
                    ->whereBetween('tanggal', $waktu)
                    ->get();
            }else{
                $data_absensi = Absensi::join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $tempat
                    ])
                    ->whereBetween('tanggal', $waktu)
                    ->get();
            }
        } else {
            if (!empty($status)) { // Status
                $data_absensi = Absensi::join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $status
                    ])
                    ->whereBetween('tanggal', $waktu)
                    ->get();
            }else{ //Nothing
                $data_absensi = Absensi::join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->where([
                        ['pegawai.nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                    ])
                    ->whereBetween('tanggal', $waktu)
                    ->get();
            }
        }
        return view('KelolaAbsensi.HasilAbsensi.index', compact('data_absensi', 'title'));
    }
}
