<?php

namespace App\Http\Controllers\Api\RiwayatAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;

class RiwayatAbsensiController extends Controller
{
    public function riwayatAbsensi()
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $absensi = Absensi::where('id_pegawai', $id)
            ->orderBy('id_absensi', 'desc')
            ->take(15)
            ->get();
        if ($absensi) {
            return $this->success($absensi, '');
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
