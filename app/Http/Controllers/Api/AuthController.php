<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class  AuthController extends Controller
{
    public function login(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validasi->fails()) {
            return response()->json([
                "message"=> "ada inputan yang tidak sesuai" + $validasi->errors()->first()
            ], Response::HTTP_BAD_REQUEST);
        }

        $data = [
            'email' => $request->post('email'),
            'password' => $request->post('password')
        ];

        if (!$token = auth('api')->attempt($data)){

            return response()->json([
                "message"=>"email atau password saalah"
            ], Response::HTTP_BAD_REQUEST);

        }
        $user = User::where('email', $request->email)->first();

        return $this->respondWithToken($user, $token);
    }


    public function register(Request $request) {
        $validasi = Validator::make($request->all(), [
            'name' => 'required',
            'gender' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required|min:6',]);

        if ($validasi->fails())
        {
            return $this->error($validasi->errors()->first());
        }

        $user = User::create(array_merge($request->all(), [
            'password' => bcrypt($request->password)
        ]));

        if ($user) {
            return $this->success($user, 'selamat datang ' . $user->name);
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if($user){

            $user->update($request->all());
            return $this->success($user);
        }

        return $this->error("Error User tidak ditemukan");
    }

    public function upload(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        if($user){
            $fileName = "";
            if ($request->image){
                $image = $request->image->getClientOriginalName();
                $image = str_replace(' ', '',$image);
                $image = date('Hs').rand(1,999)."_".$image;
                $fileName = $image;
                $request->image->storeAs('public/user', $image);
            }else{
                return $this->error("File must be image");
            }
            $user->update([
                'image' => $fileName,
            ]);
            return $this->success($user);
        }

        return $this->error("Terjadi Kesalahan saat mengupload");
    }

    protected function respondWithToken($user, $token){

        return response()->json([
            'data' => $user,
            'token' => $token
        ], Response::HTTP_OK);
    }

    public function getAuthenticatedUser()
    {
        try {

            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }

        return response()->json(compact('user'));
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
