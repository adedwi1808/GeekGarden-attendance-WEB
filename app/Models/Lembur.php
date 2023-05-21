<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembur extends Model
{
    use HasFactory;
    protected $table='lembur';
    protected $primaryKey = 'id_lembur';
    const UPDATED_AT = null;
    public $timestamps = false;


    protected $fillable = [
        'id_lembur',
        'id_absensi',
        'id_admin',
        'status_lembur',
        'tanggal_dibuat',
        'tanggal_konfirm',
    ];


    public function absensi(){
        return $this->belongsTo(Absensi::class, 'id_absensi', 'id_absensi');
    }

    public function admin(){
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }

}
