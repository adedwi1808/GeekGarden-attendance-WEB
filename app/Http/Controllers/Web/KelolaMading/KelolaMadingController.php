<?php

namespace App\Http\Controllers\Web\KelolaMading;

use App\Http\Controllers\Controller;
use App\Models\Mading;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelolaMadingController extends Controller
{
    public function index()
    {
        $title = 'Mading';
        $data_mading = Mading::all();
        return view('KelolaMading.index', compact('data_mading', 'title'));
    }

    public function cariMading(Request $request)
    {
        $data_mading = Mading::where('judul', 'LIKE', "%". $request->cari_mading. "%")
            ->orWhere('informasi','LIKE','%'.$request->cari_mading.'%')
            ->get();
        $title = 'Mading';
        return view('KelolaMading.index', compact('data_mading', 'title'));
    }
}
