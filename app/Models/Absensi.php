<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'tempat_absensi',
        'status_absensi',
        'longitude',
        'latitude',
        'foto_absensi',
        'tanggal_absensi'
    ];

    protected $hidden = [
        'id'
    ];

    protected $dateFormat ='U';
}
