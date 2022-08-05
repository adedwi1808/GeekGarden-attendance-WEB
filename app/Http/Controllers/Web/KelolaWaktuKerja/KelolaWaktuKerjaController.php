<?php

namespace App\Http\Controllers\Web\KelolaWaktuKerja;

use App\Http\Controllers\Controller;
use App\Models\Jam_Kerja;
use App\Models\Tanggal_Libur;
use Illuminate\Http\Request;

class KelolaWaktuKerjaController extends Controller
{
    public function index()
    {
        $title = "Waktu Kerja";
        $jam_kerja = Jam_Kerja::with('admin')
            ->get();

        $jam_kerja_terbaru = Jam_Kerja::with('admin')
            ->latest('tanggal_dibuat')
            ->first();

        $data_tanggal_libur = Tanggal_Libur::with('admin')
            ->get();

        return view('KelolaWaktuKerja.index', compact('jam_kerja', 'jam_kerja_terbaru', 'data_tanggal_libur', 'title'));
    }
}
