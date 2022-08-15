<?php

namespace App\Http\Controllers\Web\KelolaWaktuKerja;

use App\Http\Controllers\Controller;
use App\Models\Tanggal_Libur;
use Illuminate\Http\Request;

class HapusTanggalLiburController extends Controller
{
    public function hapus($id)
    {
        $title = "Waktu Kerja";

        $tanggal = Tanggal_Libur::where('id_tanggal_libur', $id)->delete();
        if ($tanggal){
            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('success', "Hari Libur Berhasil Dihapus");
        }else{
            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('fail', "Hari Libur Gagal Dihapus");
        }

    }
}
