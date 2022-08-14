<?php

namespace App\Http\Controllers\Web\KelolaUser;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPegawaiController extends Controller
{
    public function index()
    {
        $data_pegawai = Pegawai::orderBy('nama', 'asc')
            ->get();
        $title = "Pegawai";

        return view('KelolaUser.KelolaPegawai.index', compact('data_pegawai', 'title'));
    }

    public function tambahpage()
    {
        $title = 'Pegawai';

        return view('KelolaUser.KelolaPegawai.TambahPegawai.index', compact('title'));
    }

    public function editpage(Request $request, $id)
    {
        $title = 'Pegawai';
        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        return view('KelolaUser.KelolaPegawai.EditPegawai.index', compact('pegawai', 'title', 'id'));

    }

    public function tambahkan(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|unique:pegawai',
            'jabatan' => 'required',
            'nomor_hp' => 'required|min:10|unique:pegawai|regex:/^([0-9\s\-\+\(\)]*)$/',
            'password' => 'required|min:6'
        ]);

        $admin = Pegawai::create(array_merge($validasi, [
            'password' => bcrypt($request->password)
        ]));
        if ($admin){
            return back()->with('success','Berhasil, Akun Pegawai siap digunakan');
        }else{
            return back()->with('fail','Terjadi Kesalahan');
        }
    }

    public function editpegawai(Request $request, $id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
        ]);

        if ($request->email != $pegawai->email){
            $request->validate(['email' => 'required|unique:pegawai']);
        }
        if ($request->nomor_hp != $pegawai->nomor_hp){
            $request->validate(['nomor_hp' => 'required|min:10|unique:pegawai|regex:/^([0-9\s\-\+\(\)]*)$/']);
        }
        if ($pegawai) {
            if ($request->get('password') != "") {
                $request->validate(['password' => 'min:6']);
                $pegawai->update(array_merge($request->all(), [
                    'password' => bcrypt($request->password),
                ]));
                return back()->with('success', 'Berhasil Mengedit Pegawai');

            } else {
                $pegawai->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'jenis_kelamin' => $request->jenis_kelamin,
                    'jabatan' => $request->jabatan,
                    'nomor_hp' => $request->nomor_hp,
                ]);
                return back()->with('success', 'Berhasil Mengedit Pegawai');
            }
        }
        return $this->back()->with('fail', 'Terjadi Kesalahan Saat Melakukan Edit Data');
    }

    public function hapus($id)
    {

        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if ($pegawai) {
            Pegawai::where('id_pegawai', $id)->delete();
            return redirect()->route('admin.kelola.pegawai')->with('success', 'Berhasil Menghapus Pegawai');
        }
    }

    public function cariPegawai(Request $request)
    {
        $data_pegawai = Pegawai::where('nama', 'LIKE', "%". $request->cari_pegawai. "%")
            ->orWhere('email','LIKE','%'.$request->cari_pegawai.'%')
            ->paginate(3);
        $title = "Pegawai";
        return view('KelolaUser.KelolaPegawai.index', compact('data_pegawai', 'title'));
    }
}
