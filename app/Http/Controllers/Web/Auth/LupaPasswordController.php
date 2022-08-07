<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LupaPasswordController extends Controller
{
    public function index()
    {
        return view('Auth.LupaPassword.index',
            ['title' => 'Lupa Password Page'
            ]);
    }
}
