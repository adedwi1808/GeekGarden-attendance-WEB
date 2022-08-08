<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    use HasFactory;
protected $primaryKey = "id_absensi";
    public $timestamps = false;


    protected $fillable = [
        'id_pegawai',
        'tempat',
        'status',
        'longitude',
        'latitude',
        'foto',
        'tanggal',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'id_pegawai','id_pegawai');
    }

    public function lembur()
    {
        return $this->hasMany(Lembur::class, 'id_absensi', 'id_absensi');
    }

    protected $hidden = [
    ];

    protected $dateFormat ='U';
}
