<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    protected $table = 'izin';
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'id_pegawai',
        'jenis_izin',
        'tanggal_mulai_izin',
        'tanggal_akhir_izin',
        'alasan_izin',
        'surat_izin'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class,'id_pegawai','id_pegawai');
    }

    protected $hidden = [
    ];

    protected $dateFormat ='U';
}
