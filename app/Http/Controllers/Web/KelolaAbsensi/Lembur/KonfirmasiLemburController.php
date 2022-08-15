<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\Lembur;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Lembur;
use App\Models\Progress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class KonfirmasiLemburController extends Controller
{
    public function index($id)
    {
        $title = "Lembur";

        $data_lembur = Lembur::join('absensi', 'lembur.id_absensi', '=','absensi.id_absensi')
            ->join('pegawai', 'absensi.id_pegawai', '=','pegawai.id_pegawai')
            ->leftJoin('admin', 'lembur.id_admin', '=','admin.id_admin')
            ->where('id_lembur', $id)
            ->select('lembur.id_lembur','lembur.id_absensi','lembur.tanggal_dibuat as tanggal', 'lembur.status_lembur'
                , 'absensi.longitude', 'absensi.latitude', 'absensi.tempat', 'absensi.foto', 'pegawai.nama as nama_pegawai',
            'admin.nama as nama_admin')
            ->first();

        $data_progress = Progress::where('id_absensi', $data_lembur->id_absensi)
            ->first();

        return view('KelolaAbsensi.Lembur.KonfirmasiLembur.index', compact('data_lembur', 'data_progress', 'title'));
    }

    public function terima($id)
    {
        $title = "Lembur";

        $lembur = Lembur::where('id_lembur', $id)
            ->first();

        if($lembur->status_lembur == "Diterima"){
            return back()->with('fail', "Anda Sudah Menerima Pengajuan Ini");
        }


        if ($lembur){
            $lembur->update([
                'status_lembur' => 'Diterima',
                'id_admin'=>Session::get('admin.id_admin'),
                'tanggal_konfirm'=>now()
            ]);

            $absensi = Absensi::where('id_absensi', $lembur->id_absensi)
                ->first();
            $absensi->update([
                'status'=>'Lembur'
            ]);

            return redirect()->route('admin.halaman.kelola.lembur', compact('title'))
                ->with('success', "Lembur berhasil diterima");
        }
    }

    public function tolak($id)
    {
        $title = "Lembur";

        $lembur = Lembur::where('id_lembur', $id)
            ->first();

        if($lembur->status_lembur == "Diterima"){
            return back()->with('fail', "Anda Sudah Menerima Pengajuan Ini");
        }

        if ($lembur){
            $lembur->update([
                'status_lembur' => 'Ditolak',
                'id_admin'=>Session::get('admin.id_admin'),
                'tanggal_konfirm'=>now()
            ]);
            return redirect()->route('admin.halaman.kelola.lembur', compact('title'))
                ->with('success2', "Pengajuan Lembur Ditolak");
        }
    }

}
