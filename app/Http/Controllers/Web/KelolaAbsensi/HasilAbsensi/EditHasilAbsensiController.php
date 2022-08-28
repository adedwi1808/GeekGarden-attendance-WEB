<?php

namespace App\Http\Controllers\Web\KelolaAbsensi\HasilAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class EditHasilAbsensiController extends Controller
{
    public function index($id)
    {
        $title = "Absensi";

        $absensi = Absensi::with('pegawai')
            ->where('id_absensi','=',$id)
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
                return back()->with('success', 'Berhasil Mengedit Data Absensi');
        }
        return $this->back()->with('fail', 'Terjadi Kesalahan Saat Melakukan Edit Data Absensi');
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
