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
        'lama_lembur',
        'tanggal_dibuat'
    ];


    public function absensi(){
        return $this->belongsTo(Absensi::class, 'id_absensi', 'id_absensi');
    }

}
