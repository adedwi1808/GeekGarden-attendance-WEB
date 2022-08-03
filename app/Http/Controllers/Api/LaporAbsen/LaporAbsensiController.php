<?php

namespace App\Http\Controllers\Api\LaporAbsen;

use App\Http\Controllers\Controller;
use App\Models\Laporan_Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaporAbsensiController extends Controller
{
    public function melaporkanAbsen(Request $request)
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if (!$pegawai){
            return $this->error("Error User tidak ditemukan");

        }
        $check_lapor_absensi = Laporan_Absensi::where('id_pegawai', $id)
            ->where('status_laporan', '=', 'Diajukan')
            ->get()
            ->count();
        if ($check_lapor_absensi >= 2){
            return $this->error("Anda Memiliki 2 Laporan Yang Belum Di Proses");
        }

        $validasi = Validator::make($request->all(), [
            'tanggal_absen' => 'required|date',
            'keterangan_laporan' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id_pegawai' => $id,
            'tanggal_absen' => $request->post('tanggal_absen'),
            'keterangan_laporan' => $request->post('keterangan_laporan'),
        ];


        $laporan_absensi = Laporan_Absensi::create($data);
        $laporan_absensi->save();

        $laporan_absensi_response = Laporan_Absensi::where('id_laporan_absensi', $laporan_absensi->id_laporan_absensi)->first();
        if ($laporan_absensi) {
            return $this->success($laporan_absensi_response, 'Anda berhasil melakukan laporan absensi');
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
