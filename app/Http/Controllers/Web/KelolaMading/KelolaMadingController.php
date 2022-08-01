<?php

namespace App\Http\Controllers\Web\KelolaMading;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Mading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaMadingController extends Controller
{
    public function index()
    {
        $title = 'Mading';
        $data_mading = DB::table('mading')->get();
        return view('KelolaMading.index', compact('data_mading', 'title'));
    }

    public function tambahMadingPage()
    {
        $title = 'Mading';
        $mading = Mading::all();
        if ($mading->count() <10) {
            return view('KelolaMading.TambahMading.index', compact('title'));
        }else{
            return back()->with('fail','Mading maksimal 10');
        }
    }

    public function cariMading(Request $request)
    {
        $data_mading = Mading::where('judul', 'LIKE', "%". $request->cari_mading. "%")
            ->orWhere('informasi','LIKE','%'.$request->cari_mading.'%')
            ->get();
        $title = 'Mading';
        return view('KelolaMading.index', compact('data_mading', 'title'));
    }

    public function tambahMading(Request $request)
    {
        $title = 'Mading';

        $validasi = $request->validate([
            'judul' => 'required',
            'informasiMading' => 'required',
            'thumbnailMading' => 'required'
        ]);


        if (!$validasi)
        {
            return back()->with('fail','Terjadi Kesalahan');
        }

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

        $mading = Mading::create($data);
        if ($mading){
            return redirect()->route('admin.halaman.mading')->with('success','Berhasil, Akun Pegawai siap digunakan');
        }else{
            return back()->with('fail','Terjadi Kesalahan');
        }
    }

    public function lihatMadingPage($id)
    {
        $title = "Mading";
        $mading = Mading::where('id_mading',$id)->first();
        return view('KelolaMading.LihatMading.index', compact('mading', 'title'));
    }

}
