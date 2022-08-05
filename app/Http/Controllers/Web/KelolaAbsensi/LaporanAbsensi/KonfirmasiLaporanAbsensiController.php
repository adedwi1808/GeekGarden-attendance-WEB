<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\LaporanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Laporan_Absensi;
use App\Models\Pegawai;
use App\Models\Pengajuan_izin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KonfirmasiLaporanAbsensiController extends Controller
{
    public function index($id)
    {
        $title = 'Laporan Absensi';

        $data_laporan_absensi = Laporan_Absensi::with('pegawai')
            ->where('id_laporan_absensi', $id)
            ->first();
        return view('KelolaAbsensi.LaporanAbsensi.KonfirmasiLaporanAbsensi.index', compact('data_laporan_absensi', 'title'));
    }

    public function tolak($id)
    {
        $title = 'Laporan Absensi';

        $data_laporan_absensi = Laporan_Absensi::with('pegawai')
            ->where('id_laporan_absensi', $id)
            ->first();
        if ($data_laporan_absensi->status_laporan == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Laporan Ini Diterima, Tidak bisa diubah");
        }
        if ($data_laporan_absensi) {
            $nama_pegawai = $data_laporan_absensi->pegawai->nama;
            $data_laporan_absensi->update([
                'status_laporan' => 'Ditolak',
                'id_admin'=>Session::get('admin.id_admin')
            ]);
            return redirect()->route('admin.halaman.kelola.laporan.absensi', compact('title'))
                ->with('success2', "Laporan $nama_pegawai Ditolak");
        }
        return redirect()->route('admin.halaman.kelola.laporan.absensi', compact('title'))
            ->with('fail', "Terjadi Kesalahan");
    }

    public function terima($id)
    {
        $title = 'Laporan Absensi';
        $data_laporan_absensi = Laporan_Absensi::with('pegawai')
            ->where('id_laporan_absensi', $id)
            ->first();
        if ($data_laporan_absensi->status_laporan == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Laporan Ini Diterima, Tidak bisa diubah");
        }
        if ($data_laporan_absensi) {
            $nama_pegawai = $data_laporan_absensi->pegawai->nama;
            $data_laporan_absensi->update([
                'status_laporan' => 'Diterima',
                'id_admin'=>Session::get('admin.id_admin'),
            ]);

            return redirect()->route('admin.halaman.kelola.laporan.absensi', compact('title'))
                ->with('success', "Laporan $nama_pegawai diterima");
        }
        return redirect()->route('admin.halaman.kelola.laporan.absensi', compact('title'))
            ->with('fail', "Terjadi Kesalahan");
    }
}
