<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul_mading',
        'body_mading',
        'foto_mading',
        'tanggal_mading'
    ];

    protected $hidden = [
//        'id',
    ];
}
