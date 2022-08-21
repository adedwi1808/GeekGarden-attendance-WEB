<?php

namespace App\Http\Controllers\Api\PengaduanAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use App\Models\Pengaduan_Absensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengaduanAbsensiController extends Controller
{
    public function mengadukanAbsen(Request $request)
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $pegawai = Pegawai::where('id_pegawai', $id)->first();

        if (!$pegawai){
            return $this->error("Error User tidak ditemukan");
        }
        $check_pengaduan_absensi = Pengaduan_Absensi::where('id_pegawai', $id)
            ->where('status_pengaduan', '=', 'Diajukan')
            ->get()
            ->count();
        if ($check_pengaduan_absensi >= 2){
            return $this->error("Anda Memiliki 2 Pengaduan Yang Belum Di Proses");
        }

        $validasi = Validator::make($request->all(), [
            'tanggal_absen' => 'required|date',
            'keterangan_pengaduan' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id_pegawai' => $id,
            'tanggal_absen' => $request->post('tanggal_absen'),
            'keterangan_pengaduan' => $request->post('keterangan_pengaduan'),
        ];


        $pengaduan_absensi = Pengaduan_Absensi::create($data);
        $pengaduan_absensi->save();

        $pengaduan_absensi_response = Pengaduan_Absensi::with('admin')
            ->where('id_pegawai', $id)
            ->orderByDesc('tanggal_pengaduan')
            ->take(15)
            ->get();
        if ($pengaduan_absensi) {
            return $this->success($pengaduan_absensi_response, 'Anda berhasil membuat pengaduan absensi');
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
