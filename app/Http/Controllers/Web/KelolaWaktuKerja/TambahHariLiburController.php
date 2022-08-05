<?php

namespace App\Http\Controllers\Web\KelolaWaktuKerja;

use App\Http\Controllers\Controller;
use App\Models\Jam_Kerja;
use App\Models\Tanggal_Libur;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TambahHariLiburController extends Controller
{
    public function tambah(Request $request)
    {
        $title = "Waktu Kerja";

        $validasi = Validator::make($request->all(),[
            'nama' => 'required',
            'tanggal_mulai' => 'required',
        ]);


        if ($validasi->fails()){
            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('fail', $validasi->errors()->first());
        }
        if ($request->has('tanggal_selesai') && ($request->post('tanggal_selesai') != $request->post('tanggal_mulai'))){
            $end = new DateTime($request->post('tanggal_selesai'));
            $begin = new DateTime($request->post('tanggal_mulai'));
            $end->add(DateInterval::createFromDateString('+ 1 day'));
            $interval = DateInterval::createFromDateString('1 day');
            $period = new DatePeriod($begin, $interval, $end);

            foreach ($period as $dt) {
                $data = [
                    'id_admin' => Session::get('admin.id_admin'),
                    'nama' => $request->post('nama'),
                    'tanggal' => $dt
                ];
                $tanggal_hari_libur = Tanggal_Libur::create($data);
                $tanggal_hari_libur->save();
            }
        } else{
            $data = [
                'id_admin' => Session::get('admin.id_admin'),
                'nama' => $request->post('nama'),
                'tanggal' => $request->post('tanggal_mulai')
            ];
            $tanggal_hari_libur = Tanggal_Libur::create($data);
            $tanggal_hari_libur->save();
        }


            return redirect()->route('admin.halaman.kelola.waktu.kerja', compact('title'))
                ->with('success', "Hari Libur Berhasil Ditambahkan");

    }

}
