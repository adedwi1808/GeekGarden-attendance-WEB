<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    const UPDATED_AT = null;
    protected $table = 'admin';
    protected $primaryKey = 'id_admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'password',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */


    public function mading()
    {
        return $this->hasMany(Mading::class, 'id_mading', 'id_mading');
    }

    public function pengajuan_izin()
    {
        return $this->hasMany(Pengajuan_izin::class,'id_pengajuan_izin','id_pengajuan_izin');
    }

    public function LaporanAbsensi()
    {
        return $this->hasMany(Laporan_Absensi::class, 'id_admin', 'id_admin');
    }
}
