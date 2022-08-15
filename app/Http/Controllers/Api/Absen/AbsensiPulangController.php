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

class AbsensiPulangController extends Controller
{
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

            $jam_aktif_lembur = Carbon::createFromTimeString($jam_kerja->jam_selesai)->addHour()->toTimeString();

            $absensiDatang = Absensi::where('id_pegawai', $absensi->id_pegawai)
                ->whereDate('tanggal', Carbon::today())
                ->first();

            $mulai = Carbon::parse($absensiDatang->tanggal);
            $selesai = Carbon::parse($absensiResponse->tanggal);

            //menit
            $selisih = $mulai->diffInMinutes($selesai);
            //jam
//            $selisih = $mulai->diffInHours($selesai);
            //5
            if ((now()->toTimeString() > $jam_aktif_lembur) && ($selisih > 5)){
                    $lembur = Lembur::create([
                        'id_absensi'=> $absensiResponse->id_absensi,
                    ]);
                    $lembur->save();
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
