<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\LaporanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Laporan_Absensi;
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

    public function cariAbsensi(Request $request, $id, $tanggal_absen)
    {
        $title = 'Hasil Absensi';

        $data_absensi = Absensi::join('pegawai','absensi.id_pegawai', '=', 'pegawai.id_pegawai')
            ->where('absensi.id_pegawai', '=', $id)
            ->whereDate('tanggal', $tanggal_absen)
            ->get();

        return view('KelolaAbsensi.HasilAbsensi.index', compact('data_absensi', 'title'));

    }

    public function tambahAbsen(Request $request, $id)
    {
        $title = 'Laporan Absensi';

        $data_laporan_absensi = Laporan_Absensi::with('pegawai')
            ->where('id_laporan_absensi', $id)
            ->first();

        if ($data_laporan_absensi->status_laporan == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Laporan Ini Diterima, Tidak bisa diubah");
        }

        if ($data_laporan_absensi){

            switch ($request->post('tempat')){
                case "Dikantor":
                    $longitude= 110.3846192;
                    $latitude= -7.7557429;
                    break;
                case "Diluar Kantor":
                    $longitude= 0;
                    $latitude= 0;
                    break;
                default:
                    $longitude= 0;
                    $latitude= 0;
                    break;
            }

            $nama_pegawai = $data_laporan_absensi->pegawai->nama;
            if ($request->has('hadir')){
                $tanggal = Carbon::create($data_laporan_absensi->tanggal_absen)->setTime(8,0,0);
                $data = [
                    'id_pegawai' => $data_laporan_absensi->id_pegawai,
                    'tempat' => $request->post('tempat'),
                    'status' => "Hadir",
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'tanggal' => $tanggal
                ];
                $absensi = Absensi::create($data);
                $absensi->save();
            }
            if ($request->has('pulang')){
                $tanggal = Carbon::create($data_laporan_absensi->tanggal_absen)->setTime(15,59,59);
                $data = [
                    'id_pegawai' => $data_laporan_absensi->id_pegawai,
                    'tempat' => $request->post('tempat'),
                    'status' => "Pulang",
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'tanggal' => $tanggal
                ];
                $absensi = Absensi::create($data);
                $absensi->save();
            }

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
