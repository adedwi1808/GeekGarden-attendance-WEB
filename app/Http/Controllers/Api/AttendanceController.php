<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function fillAttendance(Request $request, $id) {
        $user = User::where('id', $id)->first();
        if (!$user) return $this->error("User Tidak Ditemukan");

        $validasi = Validator::make($request->all(), [
            'id_user' => 'required',
            'tempat_absensi_datang'=>'required',
            'status_absensi_datang'=>'required',
            'longitude_datang'=>'required',
            'latitude_datang'=>'required',
            ]);

        if ($validasi->fails())
        {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id'=>$request->post('id'),
            'id_user' => intval($request->post('id_user')),
            'tempat_absensi_datang' => $request->post('tempat_absensi_datang'),
            'status_absensi_datang' => $request->post('status_absensi_datang'),
            'longitude_datang' => $request->post('longitude_datang'),
            'latitude_datang' => $request->post('latitude_datang'),
        ];

        $absensi = Absensi::create($data);

        $absensiResponse = Absensi::where('id', $absensi->id)->first();
        if ($absensi) {
            return $this->success($absensiResponse, 'Anda berhasil melakukan absensi');
        } else {
            return $this->error("Terjadi kesalahan");
        }

    }

    public function uploadAttendanceImage(Request $request, $id)
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
                'foto_absensi_datang' => $fileName,
            ]);
            $absensiResponse = Absensi::where('id', $id)->first();
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
