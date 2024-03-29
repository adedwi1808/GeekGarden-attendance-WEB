<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\PengajuanIzin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\Pengajuan_izin;
use App\Models\Tanggal_Libur;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KonfirmasiPengajuanIzinController extends Controller
{
    public function index($id)
    {
        $title = 'Pengajuan Izin';

        $data_pengajuan_izin = Pengajuan_izin::with('pegawai')
            ->where('id_pengajuan_izin', $id)
            ->first();
        return view('KelolaAbsensi.PengajuanIzin.KonfirmasiPengajuanIzin.index', compact('data_pengajuan_izin', 'title'));
    }

    public function tolak($id, Request $request)
    {
        $title = 'Pengajuan Izin';

        $validasi = $request->validate([
            'keterangan_admin' => 'required',
        ]);

        if (!$validasi){
            return back()->withError('Harap Masukkan Alasan Ditolak');
        }

        $data_pengajuan_izin = Pengajuan_izin::with('pegawai')
            ->where('id_pengajuan_izin', $id)
            ->first();

        if ($data_pengajuan_izin->status_izin == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Pengajuan Ini Diterima, Tidak bisa diubah");
        }
        if ($data_pengajuan_izin) {
            $nama_pegawai = $data_pengajuan_izin->pegawai->nama;
            $data_pengajuan_izin->update([
                'status_izin' => 'Ditolak',
                'keterangan_admin'=> $request->keterangan_admin,
                'id_admin'=>Session::get('admin.id_admin')
                    ]);
            return redirect()->route('admin.halaman.kelola.pengajuan.izin', compact('title'))
                ->with('success2', "Pengajuan $nama_pegawai Ditolak");
        }
        return redirect()->route('admin.halaman.kelola.pengajuan.izin', compact('title'))
            ->with('fail', "Terjadi Kesalahan");
    }

    public function terima($id)
    {
        $title = 'Pengajuan Izin';
        $data_pengajuan_izin = Pengajuan_izin::with('pegawai')
            ->where('id_pengajuan_izin', $id)
            ->first();
        if ($data_pengajuan_izin->status_izin == "Diterima") {
            return back()->with('fail', "Anda Sudah Mengkonfirmasi Pengajuan Ini Diterima");
        }
        if ($data_pengajuan_izin) {
            $nama_pegawai = $data_pengajuan_izin->pegawai->nama;
            $data_pengajuan_izin->update([
                'status_izin' => 'Diterima',
                'keterangan_admin' => 'Pengajuan Diterima',
                'id_admin'=>Session::get('admin.id_admin'),
            ]);


            $begin = new DateTime($data_pengajuan_izin->tanggal_mulai_izin);
            $end = new DateTime($data_pengajuan_izin->tanggal_selesai_izin);
            $end->add(DateInterval::createFromDateString('+ 1 day'));

            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);

            $pegawai = Pegawai::where('id_pegawai', $data_pengajuan_izin->pegawai->id_pegawai)->first();
            if (!$pegawai) return redirect()->route('admin.halaman.kelola.pengajuan.izin', compact('title'))
                ->with('fail', "Pegawai Tidak Ditemukan");

            if ($begin == $end){

                $day = new Carbon($data_pengajuan_izin->tanggal_mulai_izin);
                $hari_libur = Tanggal_Libur::WhereDate("tanggal", $day)->first();

                if (!$day->isWeekend() || $day!=$hari_libur){
                    Absensi::where('id_pegawai', $pegawai->id_pegawai)
                        ->whereDate('tanggal', '=', $day)
                        ->delete();

                    $data = [
                        'id_pegawai' => $pegawai->id_pegawai,
//                        'tempat' => '-',
                        'status' => ($data_pengajuan_izin->jenis_izin == 'Cuti')? 'Cuti': 'Izin',
                        'longitude' => '0',
                        'latitude' => '0',
                        'foto' => '',
                        'tanggal' => $data_pengajuan_izin->tanggal_mulai_izin
                    ];
                    $absensi = Absensi::create($data);
                    $absensi->save();

                    return redirect()->route('admin.halaman.kelola.pengajuan.izin', compact('title'))
                        ->with('success', "Pengajuan $nama_pegawai diterima");
                }
                return redirect()->route('admin.halaman.kelola.pengajuan.izin', compact('title'))
                    ->with('fail', "Terjadi Kesalahan");
            }

            foreach ($period as $dt) {
                $day = new Carbon($dt);

                $hari_libur = Tanggal_Libur::Where("tanggal", $day)->first();

                if ($hari_libur){
                    $libur = new Carbon($hari_libur->tanggal);
                    if ($day->isWeekday() && $day != $libur) {

                        Absensi::where('id_pegawai', $pegawai->id_pegawai)
                            ->whereDate('tanggal', '=', $day)
                            ->delete();

                        $data = [
                            'id_pegawai' => $pegawai->id_pegawai,
//                            'tempat' => '-',
                            'status' => ($data_pengajuan_izin->jenis_izin == 'Cuti')? 'Cuti': 'Izin',
                            'longitude' => '0',
                            'latitude' => '0',
                            'foto' => '',
                            'tanggal' => $dt
                        ];
                        $absensi = Absensi::create($data);
                        $absensi->save();
                    }
                }else{
                    if ($day->isWeekday()) {

                        Absensi::where('id_pegawai', $pegawai->id_pegawai)
                            ->whereDate('tanggal', '=', $day)
                            ->delete();

                        $data = [
                            'id_pegawai' => $pegawai->id_pegawai,
                            'status' => ($data_pengajuan_izin->jenis_izin == 'Cuti')? 'Cuti': 'Izin',
                            'longitude' => '0',
                            'latitude' => '0',
                            'foto' => '',
                            'tanggal' => $dt
                        ];
                        $absensi = Absensi::create($data);
                        $absensi->save();
                    }
                }
            }
            return redirect()->route('admin.halaman.kelola.pengajuan.izin', compact('title'))
                ->with('success', "Pengajuan $nama_pegawai diterima");
        }
        return redirect()->route('admin.halaman.kelola.pengajuan.izin', compact('title'))
            ->with('fail', "Terjadi Kesalahan");
    }
}
