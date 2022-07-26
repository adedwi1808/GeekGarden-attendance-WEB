<?php

namespace App\Http\Controllers\Web\KelolaMading;

use App\Http\Controllers\Controller;
use App\Models\Mading;
use Illuminate\Http\Request;

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
        ]);


        if (!$validasi)
        {
            return back()->with('fail','Terjadi Kesalahan');
        }


        if ($absensi){
            if ($request->has('thumbnailMading')){
                $fileName = "";
                if ($request->thumbnailMading){
                    $image = $request->file('thumbnailMading')->getClientOriginalName();
                    $image = str_replace(' ', '',$image);
                    $image = date('Hs').rand(1,999)."_".$image;
                    $fileName = $image;
                    $request->file('thumbnailMading')->storeAs('public/mading', $image);
                }else{
                    return back()->with('fail','Terjadi Kesalahan');
                }

                $data = [
                    'judul' => $request->post('judul'),
                    'informasi' => $request->post('informasiMading'),
                    'foto' => $request->thumbnailMading->storeAs('', $fileName),
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
}
