<?php

namespace App\Http\Controllers\Api\EditProfilePegawai;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class EditProfilePegawaiController extends Controller
{
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
