<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggal_Libur extends Model
{
    use HasFactory;
    protected $table = 'tanggal_libur';
    protected $primaryKey = "id_tanggal_libur";
    public $timestamps = false;

    protected $fillable = [
        'id_tanggal_libur',
        'id_admin',
        'tanggal',
        'tanggal_dibuat'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'id_admin','id_admin');
    }

    protected $hidden = [
    ];

    protected $dateFormat ='U';

}
