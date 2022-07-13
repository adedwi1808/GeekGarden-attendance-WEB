<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class AuthPegawaiController extends Controller
{

    public function pegawairegister(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'required|unique:pegawai',
            'nomor_hp' => 'required|unique:pegawai',
            'password' => 'required|min:6',]);

        if ($validasi->fails())
        {
            return $this->error($validasi->errors()->first());
        }

        $pegawai = Pegawai::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($pegawai) {
            return $this->success($pegawai, 'selamat datang ' . $pegawai->name);
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function pegawailogin(Request $request)
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


        if (!$token = auth('pegawai-api')->attempt($data)){
            return response()->json([
                "message"=>"email atau password salah"
            ], Response::HTTP_BAD_REQUEST);

        }
        $pegawai = Pegawai::where('email', $request->email)->first();

        return $this->respondWithToken($pegawai, $token);
    }

    public function updatepegawai(Request $request, $id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        if($pegawai){
            $pegawai->update($request->all());
            return $this->success($pegawai);
        }
        return $this->error("Error User tidak ditemukan");
    }

    public function editfotoprofile(Request $request, $id)
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        if($pegawai){
            $fileName = "";
            if ($request->image){
                $image = $request->image->getClientOriginalName();
                $image = str_replace(' ', '',$image);
                $image = date('Hs').rand(1,999)."_".$image;
                $fileName = $image;
                $request->image->storeAs('public/pegawai', $image);
            }else{
                return $this->error("File must be image");
            }
            $pegawai->update([
                'foto_profile' => $fileName,
            ]);
            return $this->success($pegawai);
        }

        return $this->error("Terjadi Kesalahan saat mengupload");
    }

    public function me()
    {
        return response()->json(auth('pegawai-api')->user());
    }

    public function logout()
    {
        auth('pegawai-api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($pegawai, $token){

        return response()->json([
            'data' => $pegawai,
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
