<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\PengaduanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jam_Kerja;
use App\Models\Pengaduan_Absensi;
use App\Models\Tanggal_Libur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KonfirmasiPengaduanAbsensiController extends Controller
{
    public function index($id)
    {
        $title = 'Pengaduan Absensi';

        $data_pengaduan_absensi = Pengaduan_Absensi::with('pegawai')
            ->where('id_pengaduan_absensi', $id)
            ->first();
        return view('KelolaAbsensi.PengaduanAbsensi.KonfirmasiPengaduanAbsensi.index', compact('data_pengaduan_absensi', 'title'));
    }

    public function tolak(Request $request, $id)
    {
        $title = 'Pengaduan Absensi';

        $data_pengaduan_absensi = Pengaduan_Absensi::with('pegawai')
            ->where('id_pengaduan_absensi', $id)
            ->first();

        $validasi = $request->validate([
            'keterangan_admin' => 'required',
        ]);

        if (!$validasi){
            return back()->withError('Harap Masukkan Alasan Ditolak');
        }
        if ($data_pengaduan_absensi->status_pengaduan == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Pengaduan Ini Diterima, Tidak bisa diubah");
        }
        if ($data_pengaduan_absensi) {
            $nama_pegawai = $data_pengaduan_absensi->pegawai->nama;
            $data_pengaduan_absensi->update([
                'status_pengaduan' => 'Ditolak',
                'keterangan_admin'=> $request->keterangan_admin,
                'id_admin'=>Session::get('admin.id_admin')
            ]);
            return redirect()->route('admin.halaman.kelola.pengaduan.absensi', compact('title'))
                ->with('success2', "Pengaduan $nama_pegawai Ditolak");
        }
        return redirect()->route('admin.halaman.kelola.pengaduan.absensi', compact('title'))
            ->with('fail', "Terjadi Kesalahan");
    }

    public function terima($id)
    {
        $title = 'Pengaduan Absensi';
        $data_pengaduan_absensi = Pengaduan_Absensi::with('pegawai')
            ->where('id_pengaduan_absensi', $id)
            ->first();

        $tanggal_absen = new Carbon($data_pengaduan_absensi->tanggal_absen);

        $hari_libur = Tanggal_Libur::Where("tanggal", $tanggal_absen)->first();

        if ($hari_libur){
            return back()->with('warning', "Tanggal Yang Dilaporkan Merupakan Hari Libur");
        }
        if ($data_pengaduan_absensi->status_pengaduan == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Pengaduan Ini Diterima, Tidak bisa diubah");
        }
        if ($data_pengaduan_absensi) {
            $nama_pegawai = $data_pengaduan_absensi->pegawai->nama;
            $data_pengaduan_absensi->update([
                'status_pengaduan' => 'Diterima',
                'keterangan_admin' => 'Pengaduan Diterima',
                'id_admin'=>Session::get('admin.id_admin'),
            ]);

            return redirect()->route('admin.halaman.kelola.pengaduan.absensi', compact('title'))
                ->with('success', "Pengaduan $nama_pegawai diterima");
        }
        return redirect()->route('admin.halaman.kelola.pengaduan.absensi', compact('title'))
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
        $title = 'Pengaduan Absensi';

        $data_pengaduan_absensi = Pengaduan_Absensi::with('pegawai')
            ->where('id_pengaduan_absensi', $id)
            ->first();

        $tanggal_absen = new Carbon($data_pengaduan_absensi->tanggal_absen);


        $hari_libur = Tanggal_Libur::Where("tanggal", $tanggal_absen)->first();

        if ($tanggal_absen->isWeekend()){
            return back()->with('warning', "Tanggal Yang Adukan Merupakan Weekend");
        }

        if ($hari_libur){
            return back()->with('warning', "Tanggal Yang Adukan Merupakan Hari Libur");
        }

        if ($data_pengaduan_absensi->status_pengaduan == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Pengaduan Ini Diterima, Tidak bisa diubah");
        }

        if ($data_pengaduan_absensi){

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
            $jam_kerja = Jam_Kerja::latest('tanggal_dibuat')->first();


            $nama_pegawai = $data_pengaduan_absensi->pegawai->nama;

            Absensi::where('id_pegawai', $data_pengaduan_absensi->id_pegawai)
                ->where('status','Izin')
                ->whereDate('tanggal', $tanggal_absen)
                ->delete();

            Absensi::where('id_pegawai', $data_pengaduan_absensi->id_pegawai)
                ->where('status','Cuti')
                ->whereDate('tanggal', $tanggal_absen)
                ->delete();


            if ($request->post('opsi_absen') == 'Hadir'){

                Absensi::where('id_pegawai', $data_pengaduan_absensi->id_pegawai)
                    ->where('status','Hadir')
                    ->whereDate('tanggal', $tanggal_absen)
                    ->delete();

                $tanggal = Carbon::create($data_pengaduan_absensi->tanggal_absen)->setTimeFrom(Carbon::createFromTimeString($jam_kerja->jam_mulai));
                $data = [
                    'id_pegawai' => $data_pengaduan_absensi->id_pegawai,
                    'tempat' => $request->post('tempat'),
                    'status' => "Hadir",
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'tanggal' => $tanggal
                ];
                $absensi = Absensi::create($data);
                $absensi->save();
            }else{

                Absensi::where('id_pegawai', $data_pengaduan_absensi->id_pegawai)
                    ->where('status','Pulang')
                    ->whereDate('tanggal', $tanggal_absen)
                    ->delete();

                $tanggal = Carbon::create($data_pengaduan_absensi->tanggal_absen)->setTimeFrom(Carbon::createFromTimeString($jam_kerja->jam_selesai));
                $data = [
                    'id_pegawai' => $data_pengaduan_absensi->id_pegawai,
                    'tempat' => $request->post('tempat'),
                    'status' => "Pulang",
                    'longitude' => $longitude,
                    'latitude' => $latitude,
                    'tanggal' => $tanggal
                ];
                $absensi = Absensi::create($data);
                $absensi->save();
            }

            $data_pengaduan_absensi->update([
                'status_pengaduan' => 'Diterima',
                'id_admin'=>Session::get('admin.id_admin'),
            ]);

            return redirect()->route('admin.halaman.kelola.pengaduan.absensi', compact('title'))
                ->with('success', "pengaduan $nama_pegawai diterima");
        }
        return redirect()->route('admin.halaman.kelola.pengaduan.absensi', compact('title'))
            ->with('fail', "Terjadi Kesalahan");
    }
}
