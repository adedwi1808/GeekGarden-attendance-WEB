<?php

namespace App\Http\Controllers\Api\Mading;

use App\Http\Controllers\Controller;
use App\Models\Mading;
use Illuminate\Http\Request;

class MadingController extends Controller
{
    public function selectAllMading(Request $request)
    {
        $madings = Mading::all();
        if ($madings) {
            return $this->success($madings, '' );
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
