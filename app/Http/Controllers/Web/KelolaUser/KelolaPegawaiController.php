<?php

namespace App\Http\Controllers\Web\KelolaUser;

use App\Http\Controllers\Controller;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaPegawaiController extends Controller
{
    public function index()
    {
        $data_pegawai = DB::table('pegawai')->paginate(5);
        $title = "Pegawai";

        return view('KelolaUser.KelolaPegawai.index', compact('data_pegawai', 'title'));
    }
}
