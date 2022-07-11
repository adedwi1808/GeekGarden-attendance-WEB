<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    use HasFactory;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $hidden = [
    ];

    protected $dateFormat ='U';
}
