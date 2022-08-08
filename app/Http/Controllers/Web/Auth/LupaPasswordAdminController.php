<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Reset_Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LupaPasswordAdminController extends Controller
{
    public function index()
    {
        return view('Auth.LupaPassword.index',
            ['title' => 'Lupa Password Page'
            ]);
    }

    public function lupapassword(Request $request)
    {
        $request->validate([
           'email'=>'required|email|exists:Admin'
        ]);


        $token = Str::random(64);

        Reset_Password::create([
            'email'=>$request->email,
            'token'=>$token
        ]);

        $action_link = route('link.reset.password', ['token'=>$token, 'email'=>$request->email]);
        $body = "Kami menerima bahwa anda kehilangan password anda yaitu ".$request->email." anda bisa melakukan reset password dengan menekan link dibawah";
        Mail::send('Auth.RecoverPassword.email-forgot', ['action_link'=>$action_link, 'body'=>$body], function ($message) use ($request){
            $admin = Admin::where('email', $request->email)->first();

            $message->from('noreply@example.com', 'GeekGarden Attendance');
           $message->to($request->email, $admin->nama)
                    ->subject('Lupa Password');
        });

        return back()->with('success', 'Silahkan Cek Email Untuk Melakukan Reset Password');
    }

    public function formresetpassword(Request $request, $token = null)
    {
        return view('Auth.RecoverPassword.index', ['title' => 'Lupa Password Page'
        ])->with(['token'=>$token, 'email'=>$request->email]);
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:Admin',
            'password'=>'required|min:6|confirmed',
            'password_confirmation'=>'required'
        ]);

        $check_token = Reset_Password::where([
            'email'=>$request->email,
            'token'=>$request->token
        ])->first();

        if (!$check_token){
            return back()->withInput()->with('fail', 'Token Tidak Valid');
        }else{
            Admin::where('email', $request->email)->update([
                'password' => bcrypt($request->password)
            ]);

            Reset_Password::where([
                'email'=>$request->email
            ])->delete();

            return back()->with('success', 'Password Berhasil DiReset');
        }
    }
}
