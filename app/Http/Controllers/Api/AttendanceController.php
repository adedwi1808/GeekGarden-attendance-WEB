<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    public function fillAttendance(Request $request) {
        $validasi = Validator::make($request->all(), [
            'tempat_absensi'=>'required',
            'status_absensi'=>'required',
            'longitude'=>'required',
            'latitude'=>'required',
            'foto_absensi'=>'required',
            'tanggal_absensi'=>'required'
            ]);


        if ($validasi->fails())
        {
            return $this->error($validasi->errors()->first());
        }

        $fileName = "";
        if ($request->foto_absensi){
            $image = $request->foto_absensi->getClientOriginalName();
            $image = str_replace(' ', '',$image);
            $image = date('Hs').rand(1,999)."_".$image;
            $fileName = $image;
            $request->foto_absensi->storeAs('public/absensi', $image);
        }else{
            return $this->error("File must be image");
        }

        $data = [
            'tempat_absensi' => $request->post('tempat_absensi'),
            'status_absensi' => $request->post('status_absensi'),
            'longitude' => $request->post('longitude'),
            'latitude' => $request->post('latitude'),
            'foto_absensi' => $request->foto_absensi->storeAs('', $fileName),
        ];

        $absensi = Absensi::create($data);


        if ($absensi) {
            return $this->success($absensi, 'Anda berhasil melakukan absensi ');
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }
}
