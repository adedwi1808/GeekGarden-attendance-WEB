<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan_izin extends Model
{
    use HasFactory;
    protected $table='pengajuan_izin';
    protected $primaryKey = 'id_pengajuan_izin';
    const UPDATED_AT = null;
    public $timestamps = false;


    protected $fillable = [
        'id_pegawai',
        'id_admin',
        'alasan_izin',
        'jenis_izin',
        'tanggal_mulai_izin',
        'tanggal_selesai_izin',
        'surat_izin',
        'status_izin',
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function admin(){
        return $this->belongsTo(Admin::class ,'id_admin','id_admin');
    }

}
