<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('admin.logout');
    }

    public function index()
    {
        return view('Auth.Login.login', ['title' => 'Login Page']);
    }

    public function login(Request $request)
    {
        $validasi = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6']);

        if (Auth::guard('admin')->attempt($validasi)) {
            $request->session()->regenerate();
            $admin = Admin::where('email', $request->email)->first();

            Session::put('isLogin',true);
            Session::put('admin',[
                'nama'=>$admin->nama,
                'email'=>$admin->email,
            ]);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('fail','Email/Password anda salah');
    }

}
