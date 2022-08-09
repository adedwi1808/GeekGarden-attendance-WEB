<?php

namespace App\Http\Controllers\Api\RiwayatLaporanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Laporan_Absensi;
use Illuminate\Http\Request;

class RiwayatLaporanAbsensiController extends Controller
{
    public function riwayatlaporanabsensi()
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $laporan = Laporan_Absensi::with('admin')
            ->where('id_pegawai', $id)
            ->take(15)
            ->get();
        if ($laporan) {
            return $this->success($laporan, '');
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
