<?php

namespace App\Http\Controllers\Web\KelolaWaktuKerja;

use App\Http\Controllers\Controller;
use App\Models\Jam_Kerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UbahJamKerjaController extends Controller
{
    public function ubah(Request $request)
    {
        $title = "Waktu Kerja";

        $validasi = Validator::make($request->all(),[
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
        ]);

        if (($request->post('jam_selesai') < $request->post('jam_mulai')) || ($request->post('jam_selesai') == $request->post('jam_mulai'))){
            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('fail_jam_kerja', "Harap Masukkan Jam Kerja Yang Benar");
        }

        if ($validasi->fails()){
            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('fail_jam_kerja', $validasi->errors()->first());
        }

        $data = [
            'id_admin' => Session::get('admin.id_admin'),
            'jam_mulai' => $request->post('jam_mulai'),
            'jam_selesai' => $request->post('jam_selesai')
        ];
        $jam_kerja = Jam_Kerja::create($data);
        $jam_kerja->save();

        if ($jam_kerja){
            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('success_jam_kerja', "Berhasil Mengubah Jam Kerja");
        }else{
            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('fail_jam_kerja', "Terjadi Kesalahan");
        }
    }
}
