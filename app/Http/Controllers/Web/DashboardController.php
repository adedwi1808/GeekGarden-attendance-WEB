<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\Pengaduan_Absensi;
use App\Models\Pengajuan_izin;


class DashboardController extends Controller
{
    public function index()
    {
        $title= "Dashboard";
        $jumlah_pegawai = Pegawai::count();
        $jumlah_absensi = Absensi::whereMonth('tanggal', \Carbon\Carbon::today()->month)->count();
        $jumlah_pengaduan_absensi = Pengaduan_Absensi::where("status_pengaduan", "Diajukan")->count();
        $jumlah_pengajuan_izin = Pengajuan_izin::where("status_izin", "Diajukan")->count();
        return view('Dashboard.index', compact('title','jumlah_pengajuan_izin', 'jumlah_pengaduan_absensi', 'jumlah_absensi', 'jumlah_pegawai'));
    }
}
