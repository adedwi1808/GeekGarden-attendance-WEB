<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Reset_Password;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LupaPasswordPegawaiController extends Controller
{
    public function lupapassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:Pegawai'
        ]);

        $token = Str::random(64);

        Reset_Password::create([
            'email'=>$request->email,
            'token'=>$token
        ]);

        $action_link = route('link.reset.password.pegawai', ['token'=>$token, 'email'=>$request->email]);
        $body = "Kami menerima bahwa anda kehilangan password anda yaitu ".$request->email." anda bisa melakukan reset password dengan menekan link dibawah";
        Mail::send('Auth.RecoverPassword.email-forgot', ['action_link'=>$action_link, 'body'=>$body], function ($message) use ($request){
            $pegawai = Pegawai::where('email', $request->email)->first();

            $message->from('noreply@example.com', 'GeekGarden Attendance');
            $message->to($request->email,$pegawai->nama)
                ->subject('Lupa Password');
        });

        $pegawai = Pegawai::where('email', $request->email)->first();

        return $this->success(data: $pegawai , message: "Silahkan Cek Email Anda Untuk Mereset Password");
    }

    public function formresetpassword(Request $request, $token = null)
    {
        return view('Auth.RecoverPassword.Pegawai.index', ['title' => 'Lupa Password Page'
        ])->with(['token'=>$token, 'email'=>$request->email]);
    }

    public function resetpassword(Request $request)
    {
        $request->validate([
            'email'=>'required|email|exists:Pegawai',
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
            Pegawai::where('email', $request->email)->update([
                'password' => bcrypt($request->password)
            ]);

            Reset_Password::where([
                'email'=>$request->email
            ])->delete();

            return back()->with('success', 'Password Berhasil DiReset');
        }
    }

    public function success($data, $message = "success")
    {
        return response()->json([
            'code' => 200,
            'message' => $message,
            'data' => $data
        ]);
    }

    public function error($message)
    {
        return response()->json([
            'code' => 400,
            'message' => $message
        ], 400);
    }
}
