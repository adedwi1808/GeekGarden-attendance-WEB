<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan_Absensi extends Model
{
    use HasFactory;
    protected $table='laporan_absensi';
    protected $primaryKey = 'id_laporan_absensi';
    const UPDATED_AT = null;
    public $timestamps = false;


    protected $fillable = [
        'id_pegawai',
        'id_admin',
        'tanggal_absen',
        'keterangan_laporan',
        'tanggal_laporan',
        'status_laporan'
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
