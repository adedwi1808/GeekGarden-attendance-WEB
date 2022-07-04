<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function adminregister(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:admin',
            'password' => 'required|min:6',]);

        if ($validasi->fails())
        {
            return $this->error($validasi->errors()->first());
        }

        $admin = Admin::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($admin) {
            return $this->success($admin, 'selamat datang ' . $admin->name);
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function adminlogin(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                "message"=> "ada inputan yang tidak sesuai" . $validasi->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ];

        if (!$token = auth('admin-api')->attempt($data)){

            return response()->json([
                "message"=>"email atau password saalah"
            ], Response::HTTP_BAD_REQUEST);

        }
        $pegawai = Admin::where('email', $request->email)->first();

        return $this->respondWithToken($pegawai, $token);
    }

    public function me()
    {
        return response()->json(auth('pegawai-api')->user());
    }


    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    protected function respondWithToken($user, $token){

        return response()->json([
            'data' => $user,
            'token' => $token
        ], Response::HTTP_OK);
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
