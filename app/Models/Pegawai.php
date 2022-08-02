<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pegawai extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    const UPDATED_AT = null;
    protected $table = 'pegawai';
    protected $primaryKey = 'id_pegawai';

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'email',
        'jabatan',
        'nomor_hp',
        'password',
        'foto_profile'
    ];

    protected $hidden = [
        'password',
    ];

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_pegawai', 'id_pegawai');
    }

    public function pengajuan_izin()
    {
        return $this->hasMany(Pengajuan_izin::class,'id_pegawai','id_pegawai');
    }

    public function laporanabsensi()
    {
        return $this->hasMany(Laporan_Absensi::class,'id_pegawai','id_pegawai');
    }

    public function getJWTIdentifier(){
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [
            'data' => [
                'id_pegawai' => $this->id_pegawai,
                'nama' => $this->nama,
                'email' => $this->email,
            ],
        ];
    }
}
