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
        'nomor_hp',
        'password',
        'foto_profile'
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

//    public function absensi()
//    {
//        return $this->hasMany(Absensi::class, 'id', 'id');
//    }

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
