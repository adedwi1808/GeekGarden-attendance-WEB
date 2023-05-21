<?php

namespace App\Http\Controllers\Api\RiwayatPengajuanIzin;

use App\Http\Controllers\Controller;
use App\Models\Pengajuan_izin;
use Illuminate\Http\Request;

class RiwayatPengajuanIzinController extends Controller
{
    public function riwayatPengajuanIzin()
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $pengajuan = Pengajuan_izin::with('admin')
            ->where('id_pegawai', $id)
            ->orderByDesc('tanggal_mengajukan_izin')
            ->take(15)
            ->get();
        if ($pengajuan) {
            return $this->success($pengajuan, '');
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
