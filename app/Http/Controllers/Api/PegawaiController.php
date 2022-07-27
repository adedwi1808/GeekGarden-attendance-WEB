<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function absensihadir(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $cek = Absensi::where("id_pegawai", $id)
            ->whereDate('tanggal', today())
            ->count();

        if ($cek == 1) {
            return $this->error("Anda Sudah Mengisi Absensi Hadir");
        } elseif ($cek == 2) {
            return $this->error("Anda Sudah Melengkapi Absensi");
        }

        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        if (!$pegawai) return $this->error("Pegawai Tidak Ditemukan");

        $validasi = Validator::make($request->all(), [
            'tempat' => 'required',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id_pegawai' => $id,
            'tempat' => $request->post('tempat'),
            'status' => $request->post('status'),
            'longitude' => $request->post('longitude'),
            'latitude' => $request->post('latitude'),
        ];


        $absensi = Absensi::create($data);
        $absensi->save();

        $absensiResponse = Absensi::where('id_absensi', $absensi->id_absensi)->first();
        if ($absensi) {
            return $this->success($absensiResponse, 'Anda berhasil melakukan absensi');
        } else {
            return $this->error("Terjadi kesalahan");
        }

    }

    public function uploadbuktiabsensi(Request $request, $id)
    {
        $absen = Absensi::where('id_absensi', $id)->first();
        if (!$absen) return $this->error("Absensi Tidak Ditemukan");

        if ($absen) {
            $fileName = "";
            if ($request->image) {
                $foto = $request->image->getClientOriginalName();
                $foto = str_replace(' ', '', $foto);
                $foto = date('Hs') . rand(1, 999) . "_" . $foto;
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

    public function absensipulang(Request $request)
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $cek = Absensi::where("id_pegawai", $id)
            ->whereDate('tanggal', today())
            ->count();

        if ($cek == 2) {
            return $this->error("Anda Sudah Melengkapi Absensi");
        }

        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        if (!$pegawai) return $this->error("Pegawai Tidak Ditemukan");

        $validasi = Validator::make($request->all(), [
            'tempat' => 'required',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'progress_hari_ini' => 'required'
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id_pegawai' => $id,
            'tempat' => $request->post('tempat'),
            'status' => $request->post('status'),
            'longitude' => $request->post('longitude'),
            'latitude' => $request->post('latitude'),
            'progress_hari_ini' => $request->post('progress_hari_ini'),
        ];


        $absensi = Absensi::create($data);
        $absensi->save();

        $absensiResponse = Absensi::where('id_absensi', $absensi->id_absensi)->first();
        if ($absensi) {
            return $this->success($absensiResponse, 'Anda berhasil melakukan absensi pulang');
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function checkabsensi(Request $request)
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $jumlah_absen = Absensi::where("id_pegawai", $id)
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
