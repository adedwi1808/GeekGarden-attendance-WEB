<?php

namespace App\Http\Controllers\Api\RiwayatPengaduanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan_Absensi;
use Illuminate\Http\Request;

class RiwayatPengaduanAbsensiController extends Controller
{
    public function riwayatPengaduanAbsensi()
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $pengaduan = Pengaduan_Absensi::with('admin')
            ->where('id_pegawai', $id)
            ->take(15)
            ->get();
        if ($pengaduan) {
            return $this->success($pengaduan, '');
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
