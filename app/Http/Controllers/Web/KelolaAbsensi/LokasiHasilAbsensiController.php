<?php

namespace App\Http\Controllers\Web\KelolaAbsensi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LokasiHasilAbsensiController extends Controller
{
    public function index()
    {
        $title = "Lokasi Absensi";
        return view('KelolaAbsensi.HasilAbsensi.LokasiAbsensi.index', compact('title'));
    }
}
