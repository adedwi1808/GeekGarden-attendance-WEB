<?php

namespace App\Http\Controllers\Web\KelolaUser;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaAdminController extends Controller
{
    public function index()
    {
        $data_admin = Admin::orderBy('nama', 'asc')
            ->paginate(5);
        $title = 'Admin';

        return view('KelolaUser.KelolaAdmin.index', compact('data_admin', 'title'));
    }

    public function tambahpage()
    {
        $title = 'Admin';

        return view('KelolaUser.KelolaAdmin.TambahAdmin.index', compact('title'));
    }

    public function editpage(Request $request, $id)
    {
        $title = 'Admin';
        $data_admin = Admin::where('id_admin', $id)->first();

        return view('KelolaUser.KelolaAdmin.EditAdmin.index', compact('data_admin', 'title', 'id'));

    }

    public function hapus($email)
    {
        if (Admin::count() <= 2){
            return back()->with('fail', 'Admin Tidak Boleh kurang dari 2');
        }
        $admin = Admin::where('email', $email)->first();

        if ($admin) {
            $admin->delete();
            return back()->with('success', 'Berhasil Menghapus Admin');
        }
    }

    public function editadmin(Request $request, $id)
    {
        $admin = Admin::where('id_admin', $id)->first();

        if ($admin) {
            if ($request->get('password') != "") {
                $admin->update(array_merge($request->all(), [
                    'password' => bcrypt($request->password),
                ]));
                return back()->with('success', 'Berhasil Mengedit Admin');

            } else {
                $admin->update([
                    'nama' => $request->nama,
                    'email' => $request->email,
                ]);
                return back()->with('success', 'Berhasil Mengedit Admin');
            }
        }
        return back()->with('fail', 'Terjadi Kesalahan Saat Melakukan Edit Data');

    }

    public function tambah(Request $request){
        $validasi = $request->validate([
            'nama' => 'required',
            'email' => 'required|unique:admin',
            'password' => 'required|min:6'
        ]);

        $admin = Admin::create(array_merge($validasi, [
            'password' => bcrypt($request->password)
        ]));
        if ($admin){
            return back()->with('success','Berhasil, Akun Pegawai siap digunakan');
        }else{
            return back()->with('fail','Terjadi Kesalahan');
        }
    }


}
