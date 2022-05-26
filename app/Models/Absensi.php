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
        'id',
        'id_user',
        'tempat_absensi_datang',
        'status_absensi_datang',
        'longitude_datang',
        'latitude_datang',
        'foto_absensi_datang',
        'tanggal_jam_absensi_datang',
        'tempat_absensi_pulang',
        'status_absensi_pulang',
        'longitude_pulang',
        'latitude_pulang',
        'foto_absensi_pulang',
        'tanggal_jam_absensi_pulang'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $hidden = [
    ];

    protected $dateFormat ='U';
}
