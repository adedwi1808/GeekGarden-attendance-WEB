<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan_Absensi extends Model
{
    use HasFactory;
    protected $table='pengaduan_absensi';
    protected $primaryKey = 'id_laporan_absensi';
    const UPDATED_AT = null;
    public $timestamps = false;


    protected $fillable = [
        'id_pegawai',
        'id_admin',
        'tanggal_absen',
        'keterangan_pengaduan',
        'tanggal_pengaduan',
        'status_pengaduan'
    ];

    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'id_pegawai', 'id_pegawai');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}
