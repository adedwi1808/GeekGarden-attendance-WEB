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
        'tempat_absensi',
        'status_absensi',
        'longitude',
        'latitude',
        'foto_absensi',
        'tanggal_jam_absensi',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $hidden = [
    ];

    protected $dateFormat ='U';
}
