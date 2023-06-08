<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    public function index()
    {
        return view('Auth.Register.register',
            ['title' => 'Register Page'
            ]);
    }

    public function register(Request $request)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'email' => 'required|email:dns|unique:admin',
            'password' => 'required|min:6']);



        $admin = Admin::create(array_merge($validasi, [
            'password' => bcrypt($request->password)
        ]));
        if ($admin){
            return back()->with('success','Berhasil, Silahkan login');
        }else{
            return back()->with('fail','Terjadi Kesalahan');
        }
    }

}
