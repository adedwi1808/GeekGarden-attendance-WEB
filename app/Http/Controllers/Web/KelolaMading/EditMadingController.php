<?php

namespace App\Http\Controllers\Web\KelolaMading;

use App\Http\Controllers\Controller;
use App\Models\Mading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class EditMadingController extends Controller
{
    public function index($id)
    {
        $title = "Mading";
        $mading = Mading::where('id_mading',$id)->first();
        return view('KelolaMading.EditMading.index', compact('mading', 'title'));
    }

    public function editMading( Request $request, $id)
    {
        $absensi = Mading::where('id_mading', $id)->first();
        $validasi = $request->validate([
            'judul' => 'required',
            'informasiMading' => 'required',
            'thumbnailMading' => 'file|mimes:jpeg,jpg,png|max:3000',
        ]);

        if (!$validasi)
        {
            return back()->with('fail', $validasi);
        }


        if ($absensi){
            if ($request->has('thumbnailMading')){
                $fileName = "";
                if ($request->thumbnailMading){
                    $file = $request->file('thumbnailMading');
                    $image = $request->file('thumbnailMading')->getClientOriginalName();
                    $image = str_replace(' ', '',$image);
                    $image = date('Hs').rand(1,999)."_".$image;
                    $fileName = $image;
                    $request->file('thumbnailMading')->storeAs('public/mading', $fileName);
                }else{
                    return back()->with('fail','Terjadi Kesalahan');
                }

                $data = [
                    'judul' => $request->post('judul'),
                    'informasi' => $request->post('informasiMading'),
                    'foto' => $fileName,
                ];
            }else{
                $data = [
                    'judul' => $request->post('judul'),
                    'informasi' => $request->post('informasiMading'),
                ];
            }

            $absensi->update($data);
            return back()->with('success', 'Berhasil Mengedit Mading');
        }
        return $this->back()->with('fail', 'Terjadi Kesalahan Saat Melakukan Edit Data');
    }

    public function hapusMading($id)
    {
        $mading = DB::table('mading')->count();
        if ($mading <= 1){
            return redirect()->route('admin.halaman.mading')->with('fail', 'Harus memiliki mading setidaknya 1');
        }

        $mading = Mading::where('id_mading', $id)->first();

        if ($mading) {
            Mading::where('id_mading', $id)->delete();
            return redirect()->route('admin.halaman.mading')->with('success', 'Berhasil Menghapus Mading');
        }
        return $this->back()->with('fail', 'Terjadi Kesalahan Saat Melakukan Menghapus Data');
    }
}
