<?php

namespace App\Http\Controllers\Api\Absen;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Jam_Kerja;
use App\Models\Lembur;
use App\Models\Pegawai;
use App\Models\Progress;
use App\Models\Tanggal_Libur;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AbsenController extends Controller
{

    public function absensihadir(Request $request): \Illuminate\Http\JsonResponse
    {
        $id = auth('pegawai-api')->user()->id_pegawai;

        $hari_libur = Tanggal_Libur::Where("tanggal", today())->first();

        if ($hari_libur){
            return $this->error("Hari ini adalah hari libur");
        }
//        if ($hari_libur || today()->isWeekend()){
//            return $this->error("Hari ini adalah hari libur");
//        }


        $jam_kerja = Jam_Kerja::latest('tanggal_dibuat')->first();

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

        $hari_libur = Tanggal_Libur::Where("tanggal", today())->first();

//        if ($hari_libur || today()->isWeekend()){
//            return $this->error("Hari ini adalah hari libur");
//        }

        if ($hari_libur){
            return $this->error("Hari ini adalah hari libur");
        }

        $jam_kerja = Jam_Kerja::latest('tanggal_dibuat')->first();

        if ($jam_kerja->jam_selesai > now()->toTimeString()){
            return $this->error("Sekarang Belumlah jam Pulang kerja");
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
        ];


        $absensi = Absensi::create($data);
        $absensi->save();

        $absensiResponse = Absensi::where('id_absensi', $absensi->id_absensi)->first();

        if ($absensiResponse) {
            $progress = Progress::create([
                'id_absensi'=>$absensiResponse->id_absensi,
                'progress_pekerjaan'=>$request->post('progress_hari_ini')
            ]);

            $progress->save();

            if (now()->toTimeString() > Carbon::createFromTimeString($jam_kerja->jam_selesai)->addHour()->toTimeString()){
                $cek_absensi_datang = Absensi::where('id_pegawai', $absensi->id_pegawai)
                    ->where('tempat', 'Dikantor')
                    ->whereDate('tanggal', Carbon::today())
                    ->first();
                if ($absensiResponse->tempat == "Dikantor" && $cek_absensi_datang){
                    $lembur = Lembur::create([
                        'id_absensi'=> $absensiResponse->id_absensi,
                    ]);

                    $lembur->save();
                }
            }

            return $this->success($absensiResponse, 'Anda berhasil melakukan absensi pulang');
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
