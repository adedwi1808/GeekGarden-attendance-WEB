<?php

namespace App\Http\Controllers\Web\KelolaAbsensi;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\Pegawai;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaHasilAbsensiController extends Controller
{
    public function index()
    {

        $title = 'Hasil Absensi';
        $data_absensi = Absensi::with('pegawai')
            ->orderBy('tanggal', 'asc')
            ->paginate(15);
        return view('KelolaAbsensi.HasilAbsensi.index', compact('data_absensi', 'title'));
    }

    public function cariHasilAbsensi(Request $request)
    {
        $currentDate = Carbon::today();
        $pastweek = today()->subDays(today()->dayOfWeek)->subWeek();
        $pastmonth = today()->subDays(today()->dayOfWeek)->subMonth();

        switch ($request->rentang_waktu) {
            case "Hari Ini":
                $waktu = ['tanggal', '>=', $currentDate];
                break;
            case "7 Hari Terakhir":
                $waktu = ['tanggal', '>=', $pastweek];
                break;
            default:
                $waktu = ['tanggal', '>=', $pastmonth];
                break;
        }

        switch ($request->tempat) {
            case "Dikantor":
                $tempat = ['tempat', '=', "Dikantor"];
                break;
            case "Diluar Kantor":
                $tempat = ['tempat', '=', "Diluar Kantor"];
                break;
            default:
                break;
        }

        switch ($request->status) {
            case "Hadir":
                $status = ['status', '=', "Hadir"];
                break;
            case "Pulang":
                $status = ['status', '=', "Pulang"];
                break;
            case "Izin":
                $status = ['status', '=', "Izin"];
                break;
            default:
                break;
        }

        $title = "Absensi";
        if (!empty($tempat)) { // Tempat -> all
            if (!empty($status)) { //tempat  & status
                $data_absensi = DB::table('absensi')
                    ->join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->select('pegawai.nama', 'absensi.id_absensi', 'absensi.tempat', 'absensi.longitude', 'absensi.latitude'
                        , 'absensi.foto', 'absensi.status', 'absensi.tanggal')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $waktu,
                        $tempat,
                        $status
                    ])
                    ->orderBy(($request->order_by != null) ? $request->order_by : "tanggal", ($request->sort_order != null) ? $request->sort_order : "asc")
                    ->paginate(3);
            }else{
                $data_absensi = DB::table('absensi')
                    ->join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->select('pegawai.nama', 'absensi.id_absensi', 'absensi.tempat', 'absensi.longitude', 'absensi.latitude'
                        , 'absensi.foto', 'absensi.status', 'absensi.tanggal')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $waktu,
                        $tempat
                    ])
                    ->orderBy(($request->order_by != null) ? $request->order_by : "tanggal", ($request->sort_order != null) ? $request->sort_order : "asc")
                    ->paginate(3);
            }
        } else {
            if (!empty($status)) { // Status
                $data_absensi = DB::table('absensi')
                    ->join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->select('pegawai.nama', 'absensi.id_absensi', 'absensi.tempat', 'absensi.longitude', 'absensi.latitude'
                        , 'absensi.foto', 'absensi.status', 'absensi.tanggal')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $waktu,
                        $status
                    ])
                    ->orderBy(($request->order_by != null) ? $request->order_by : "tanggal", ($request->sort_order != null) ? $request->sort_order : "asc")
                    ->paginate(3);
            }else{ //Nothing
                $data_absensi = DB::table('absensi')
                    ->join('pegawai', 'absensi.id_pegawai', '=', 'pegawai.id_pegawai')
                    ->select('pegawai.nama', 'absensi.id_absensi', 'absensi.tempat', 'absensi.longitude', 'absensi.latitude'
                        , 'absensi.foto', 'absensi.status', 'absensi.tanggal')
                    ->where([
                        ['nama', 'LIKE', '%' . $request->cari_hasil_absensi . '%'],
                        $waktu
                    ])
                    ->orderBy(($request->order_by != null) ? $request->order_by : "tanggal", ($request->sort_order != null) ? $request->sort_order : "asc")
                    ->paginate(3);
            }
        }
        return view('KelolaAbsensi.HasilAbsensi.index', compact('data_absensi', 'title'));
    }
}
