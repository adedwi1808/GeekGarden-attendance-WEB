<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Laporan_Absensi;
use App\Models\Pegawai;
use App\Models\Pengajuan_izin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $title= "Dashboard";
        $jumlah_pegawai = Pegawai::count();
        $jumlah_absensi = Absensi::whereMonth('tanggal', \Carbon\Carbon::today()->month)->count();
        $jumlah_laporan_absensi = Laporan_Absensi::where("status_laporan", "Diajukan")->count();
        $jumlah_pengajuan_izin = Pengajuan_izin::where("status_izin", "Diajukan")->count();
        return view('Dashboard.index', compact('title','jumlah_pengajuan_izin', 'jumlah_laporan_absensi', 'jumlah_absensi', 'jumlah_pegawai'));
    }
}
