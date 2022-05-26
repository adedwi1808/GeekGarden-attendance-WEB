<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MadingController extends Controller
{
    public function uploadMading(Request $request)
    {
        $validasi = Validator::make($request->all(), [
            'judul_mading' => 'required',
            'body_mading' => 'required',
            'foto_mading' => 'required',
            ]);

        if ($validasi->fails())
        {
            return $this->error($validasi->errors()->first());
        }

        $fileName = "";
        if ($request->foto_mading){
            $image = $request->foto_mading->getClientOriginalName();
            $image = str_replace(' ', '',$image);
            $image = date('Hs').rand(1,999)."_".$image;
            $fileName = $image;
            $request->foto_mading->storeAs('public/mading', $image);
        }else{
            return $this->error("File must be image");
        }

        $data = [
            'judul_mading' => $request->post('judul_mading'),
            'body_mading' => $request->post('body_mading'),
            'foto_mading' => $request->foto_mading->storeAs('', $fileName),
        ];

        $mading = Mading::create($data);

        if ($mading) {
            return $this->success($mading, 'Mading Berhasil di Upload : ' . $mading->judul_mading);
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function selectAllMading(Request $request)
    {
        Mading::all();

        $madings = Mading::all();

        if ($madings) {
            return $this->success($madings, '');
        } else {
            return $this->error("Terjadi kesalahan");
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
