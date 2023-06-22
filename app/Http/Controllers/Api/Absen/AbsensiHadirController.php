<?php

namespace App\Http\Controllers\Api\Absen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jam_Kerja;
use App\Models\Pegawai;
use App\Models\Tanggal_Libur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsensiHadirController extends Controller
{
    public function absensiHadiriOS(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = auth('pegawai-api')->user()->id_pegawai;

//        $hari_libur = Tanggal_Libur::Where("tanggal", today())->first();

        if ($hari_libur){
            return $this->error("Hari ini adalah hari libur");
        }
        if ($hari_libur || today()->isWeekend()){
            return $this->error("Hari ini adalah hari libur");
        }

        $jam_kerja = Jam_Kerja::latest('tanggal_dibuat')->first();

//        if (now()->toTimeString() > Carbon::createFromTimeString($jam_kerja->jam_mulai)->addHours(2)->toTimeString()){
//            return $this->error("Anda Telat, Silahkan Lapor Ke Admin");
//        }

        if ($jam_kerja->jam_mulai > now()->toTimeString()){
            return $this->error("Sekarang Belumlah jam masuk kerja");
        }

        $absensi_izin = Absensi::where("id_pegawai", $id)->whereDate('tanggal', today())->first();

        if($absensi_izin){
            if ($absensi_izin->status == "Izin"){
                return $this->error("Anda Sedang Melakukan Izin Saat ini");
            }elseif ($absensi_izin->status == "Cuti"){
                return $this->error("Anda Sedang Melakukan Cuti Saat ini");
            }
        }

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
//        return $this->error($request->all());
        $validasi = Validator::make($request->all(), [
//            'tempat' => 'required',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'image' => 'required'
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $fileName = "";
        if ($request->image) {
            $foto = $request->image->getClientOriginalName();
            $foto = str_replace(' ', '', $foto);
            $foto = Carbon::now()->format('YmdHis') . "_" . $foto;
            $fileName = $foto;
            $request->image->storeAs('public/bukti-absen', $foto);
        } else {
            return $this->error("File must be image");
        }

        $data = [
            'id_pegawai' => $id,
//            'tempat' => $request->post('tempat'),
            'status' => $request->post('status'),
            'longitude' => $request->post('longitude'),
            'latitude' => $request->post('latitude'),
            'foto' => $request->image->storeAs('', $fileName),
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
    public function absensihadir(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = auth('pegawai-api')->user()->id_pegawai;

        $hari_libur = Tanggal_Libur::Where("tanggal", today())->first();

        if ($hari_libur){
            return $this->error("Hari ini adalah hari libur");
        }
        if ($hari_libur || today()->isWeekend()){
            return $this->error("Hari ini adalah hari libur");
        }

        $jam_kerja = Jam_Kerja::latest('tanggal_dibuat')->first();

//        if (now()->toTimeString() > Carbon::createFromTimeString($jam_kerja->jam_mulai)->addHours(2)->toTimeString()){
//            return $this->error("Anda Telat, Silahkan Lapor Ke Admin");
//        }

        if ($jam_kerja->jam_mulai > now()->toTimeString()){
            return $this->error("Sekarang Belumlah jam masuk kerja");
        }

        $absensi_izin = Absensi::where("id_pegawai", $id)->whereDate('tanggal', today())->first();

        if($absensi_izin){
            if ($absensi_izin->status == "Izin"){
                return $this->error("Anda Sedang Melakukan Izin Saat ini");
            }elseif ($absensi_izin->status == "Cuti"){
                return $this->error("Anda Sedang Melakukan Cuti Saat ini");
            }
        }

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
//            'tempat' => 'required',
            'status' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id_pegawai' => $id,
//            'tempat' => $request->post('tempat'),
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
