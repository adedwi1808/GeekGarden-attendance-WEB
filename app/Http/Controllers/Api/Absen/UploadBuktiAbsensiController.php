<?php

namespace App\Http\Controllers\Api\Absen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UploadBuktiAbsensiController extends Controller
{
    public function uploadbuktiabsensi(Request $request, $id)
    {
        $absen = Absensi::where('id_absensi', $id)->first();
        if (!$absen) return $this->error("Absensi Tidak Ditemukan");

        if ($absen) {
            $fileName = "";
            if ($request->image) {
                $foto = $request->image->getClientOriginalName();
                $foto = str_replace(' ', '', $foto);
                $foto = Carbon::now()->format('YmdHis') . "_" . $foto;
                $fileName = $foto;
                $request->image->storeAs('public/bukti-absen', $foto);
            } else {
                return $this->error("File must be image");
            }
            $absen->where('id_absensi', $id)
                ->update([
                    'foto' => $fileName,
                ]);
            $absensiResponse = Absensi::where('id_absensi', $id)->first();
            return $this->success($absensiResponse);
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
