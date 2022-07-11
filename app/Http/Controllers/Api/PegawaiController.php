<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class PegawaiController extends Controller
{
    public function absensihadir(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        if (!$pegawai) return $this->error("Pegawai Tidak Ditemukan");

        $validasi = Validator::make($request->all(), [
            'id_pegawai' => 'required',
            'tempat'=>'required',
            'status'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
            ]);

        if ($validasi->fails())
        {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id_pegawai' => intval($request->post('id_pegawai')),
            'tempat' => $request->post('tempat'),
            'status' => $request->post('status'),
            'longitude' => $request->post('longitude'),
            'latitude' => $request->post('latitude'),
        ];

        $absensi = Absensi::create($data);
        $absensi->save();

        $absensiResponse = Absensi::where('id_absensi', $absensi->id)->first();
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

        if($absen){
            $fileName = "";
            if ($request->image){
                $foto = $request->image->getClientOriginalName();
                $foto = str_replace(' ', '',$foto);
                $foto = date('Hs').rand(1,999)."_".$foto;
                $fileName = $foto;
                $request->image->storeAs('public/bukti-absen', $foto);
            }else{
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

    public function completeAttendance(Request $request, $id) {
        $absensi = Absensi::where('id', $id)->first();

        if (!$absensi) return $this->error("absensi Tidak Ditemukan");
        $absensi->update($request->all());
        $absensi->tanggal_absensi_pulang = Carbon::now();
        $absensi->save();

        $absensiResponse = Absensi::where('id', $id)->first();

        if ($absensi) {
            return $this->success($absensiResponse, 'Anda berhasil melakukan absensi');
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function uploadCompleteAttendanceImage(Request $request, $id)
    {
        $absen = Absensi::where('id', $id)->first();
        if (!$absen) return $this->error("Absensi Tidak Ditemukan");

        if($absen){
            $fileName = "";
            if ($request->image){
                $image = $request->image->getClientOriginalName();
                $image = str_replace(' ', '',$image);
                $image = date('Hs').rand(1,999)."_".$image;
                $fileName = $image;
                $request->image->storeAs('public/bukti-absen', $image);
            }else{
                return $this->error("File must be image");
            }
            $absen->update([
                'foto_absensi_pulang' => $fileName,
            ]);
            $absensiResponse = Absensi::where('id', $id)->first();
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
