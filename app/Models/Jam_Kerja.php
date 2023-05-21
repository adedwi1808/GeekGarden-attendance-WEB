<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam_Kerja extends Model
{
    use HasFactory;
    protected $table = 'jam_kerja';
    protected $primaryKey = "id_jam_kerja";
    public $timestamps = false;

    protected $fillable = [
        'id_jam_kerja',
        'id_admin',
        'jam_mulai',
        'jam_selesai',
        'tanggal_dibuat'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'id_admin','id_admin');
    }
}
