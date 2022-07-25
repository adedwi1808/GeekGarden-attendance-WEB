<?php

namespace App\Http\Controllers\Web\KelolaAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EditHasilAbsensiController extends Controller
{
    public function index($id)
    {
        $title = "Absensi";
        $absensi = DB::table('absensi')
            ->join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
            ->select('pegawai.nama', 'absensi.id_absensi', 'absensi.tempat', 'absensi.longitude', 'absensi.latitude'
                , 'absensi.foto', 'absensi.status', 'absensi.tanggal')
            ->where('absensi.id_absensi', '=',$id)
            ->first();
        return view('KelolaAbsensi.HasilAbsensi.EditHasilAbsensi.index',compact('title', 'absensi', 'id'));
    }

    public function editAbsensi(Request $request, $id)
    {
        $absensi = Absensi::where('id_absensi', $id)->first();
        $request->validate([
            'status' => 'required',
            'longitude' =>'between:-180,180',
            'latitude' =>'between:-90,90'
        ]);
        if ($absensi){
                $absensi->update([
                    'status' => $request->status,
                    'tempat' => $request->tempat,
                    'longitude' => $request->longitude,
                    'latitude' => $request->latitude,
                ]);
                return back()->with('success', 'Berhasil Mengedit Pegawai');
        }
        return $this->back()->with('fail', 'Terjadi Kesalahan Saat Melakukan Edit Data');
    }

    public function hapus($id)
    {
        $absensi = Absensi::where('id_absensi', $id)->first();

        if ($absensi) {
            Absensi::where('id_absensi', $id)->delete();
            return redirect()->route('admin.halaman.kelola.hasil.absensi')->with('success', 'Berhasil Menghapus Absensi');
        }
    }
}
