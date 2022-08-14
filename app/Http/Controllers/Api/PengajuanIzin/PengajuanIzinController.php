<?php

namespace App\Http\Controllers\Api\PengajuanIzin;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use App\Models\Pengajuan_izin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PengajuanIzinController extends Controller
{
    public function mengajukanIzin(Request $request)
    {
        $id = auth('pegawai-api')->user()->id_pegawai;
        $pegawai = Pegawai::where('id_pegawai', $id)->first();
        $checkPengajuan = Pengajuan_izin::where('id_pegawai', $id)
            ->where('status_izin', '=', 'Diajukan')
            ->get()
            ->count();
        if ($checkPengajuan >= 2){
            return $this->error("Anda Memiliki 2 Pengajuan Yang Belum Di Proses");
        }

        $validasi = Validator::make($request->all(), [
            'jenis_izin' => 'required',
            'tanggal_mulai_izin' => 'required|date',
            'tanggal_selesai_izin' => 'required',
            'alasan_izin' => 'required',
            'status_izin' => 'required',
        ]);

        if ($validasi->fails()) {
            return $this->error($validasi->errors()->first());
        }

        $data = [
            'id_pegawai' => $id,
            'jenis_izin' => $request->post('jenis_izin'),
            'tanggal_mulai_izin' => $request->post('tanggal_mulai_izin'),
            'tanggal_selesai_izin' => $request->post('tanggal_selesai_izin'),
            'alasan_izin' => $request->post('alasan_izin'),
            'status_izin' => $request->post('status_izin'),
        ];


        $pengajuan_izin = Pengajuan_izin::create($data);
        $pengajuan_izin->save();

        $absensiResponse = Pengajuan_izin::where('id_pengajuan_izin', $pengajuan_izin->id_pengajuan_izin)->first();
        if ($pengajuan_izin) {
            return $this->success($absensiResponse, 'Anda berhasil melakukan pengajuan_izin');
        } else {
            return $this->error("Terjadi kesalahan");
        }
    }

    public function uploadSuratizin(Request $request, $id)
    {
        $pengajuan_izin = Pengajuan_izin::where('id_pengajuan_izin', $id)->first();
        if (!$pengajuan_izin) return $this->error("Pengajuan Izin Tidak Ditemukan");

        if ($pengajuan_izin) {
            $fileName = "";
            if ($request->image) {
                $image = $request->image->getClientOriginalName();
                $image = str_replace(' ', '', $image);
                $image = 'SI_'.Carbon::now()->format('YmdHis') . "_" . $image;
                $fileName = $image;
                $request->image->storeAs('public/surat-izin', $image);
            } else {
                return $this->error("File must be image");
            }
            $pengajuan_izin->where('id_pengajuan_izin', $id)
                ->update([
                    'surat_izin' => $fileName,
                ]);
            $pengajuan_izin_response = Pengajuan_izin::where('id_pengajuan_izin', $id)->first();
            return $this->success($pengajuan_izin_response);
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
