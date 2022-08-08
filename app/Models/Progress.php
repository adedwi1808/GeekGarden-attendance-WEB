<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
    use HasFactory;
    protected $table='progress';
    protected $primaryKey = 'id_progress';
    const UPDATED_AT = null;
    public $timestamps = false;


    protected $fillable = [
        'id_progress',
        'id_absensi',
        'progress_pekerjaan'
    ];

    public function absensi()
    {
        $this->belongsTo(Absensi::class, 'id_absensi', 'id_absensi');
    }
}
