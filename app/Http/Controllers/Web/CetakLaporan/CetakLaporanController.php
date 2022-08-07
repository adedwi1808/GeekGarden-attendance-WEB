<?php

namespace App\Http\Controllers\Web\CetakLaporan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CetakLaporanController extends Controller
{
    public function index()
    {
        $title = "Cetak Laporan";

        return view('CetakLaporan.index', compact('title'));
    }
}
