<?php

namespace App\Http\Controllers\Api\DataAbsensiPegawai;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Lembur;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataAbsensiPegawaiController extends Controller
{
    public function dataabsensi()
    {
        $id = auth('pegawai-api')->user()->id_pegawai;

        $hadir = Absensi::where('id_pegawai', $id)
            ->where('status', 'Hadir')
            ->whereMonth('tanggal', Carbon::today()->month)
            ->count();

        $izin = Absensi::where('id_pegawai', $id)
            ->where('status', 'Izin')
            ->whereMonth('tanggal', Carbon::today()->month)
            ->count();

        $cuti = Absensi::where('id_pegawai', $id)
            ->where('status', 'Cuti')
            ->whereMonth('tanggal', Carbon::today()->month)
            ->count();

        $lembur = Lembur::join('absensi','absensi.id_absensi','lembur.id_absensi')
            ->where('id_pegawai', $id)
            ->whereMonth('tanggal_dibuat', Carbon::today()->month)
            ->count();

        $data = [
          "cuti"=>$cuti,
          "izin"=> $izin,
          "lembur"=> $lembur,
            "hadir"=>$hadir
        ];

        return $this->success($data, "Kiw");
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
