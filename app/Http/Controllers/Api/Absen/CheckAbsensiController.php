<?php

namespace App\Http\Controllers\Api\Absen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use Illuminate\Http\Request;

class CheckAbsensiController extends Controller
{
    public function checkabsensi()
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $jumlah_absen = Absensi::where("id_pegawai", $id)
            ->where('status','!=','Izin')
            ->where('status','!=','Cuti')
            ->whereDate('tanggal', today())
            ->count();
        if ($jumlah_absen < 1) {
            $data = [
                'jumlah_absen_hari_ini' => $jumlah_absen,
            ];
        }else if ($jumlah_absen == 1){
            $data = [
                'jumlah_absen_hari_ini' => $jumlah_absen,
                'jam_hadir' => Absensi::select("tanggal")
                    ->where("id_pegawai", $id)
                    ->whereDate('tanggal', today())
                    ->where("status","Hadir")
                    ->get()->first(),
            ];
        }else {
            $data = [
                'jumlah_absen_hari_ini' => $jumlah_absen,
                'jam_hadir' => Absensi::select("tanggal")
                    ->where("id_pegawai", $id)
                    ->whereDate('tanggal', today())
                    ->where("status","Hadir")
                    ->get()->first(),
                'jam_pulang' => Absensi::select("tanggal")
                    ->where("id_pegawai", $id)
                    ->whereDate('tanggal', today())
                    ->where("status","Pulang")
                    ->get()->first()
            ];
        }


        return
            $this->success($data);
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
