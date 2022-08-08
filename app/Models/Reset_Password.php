<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reset_Password extends Model
{
    use HasFactory;
    protected $table='reset_password';
    const UPDATED_AT = null;
    public $timestamps = false;


    protected $fillable = [
        'email',
        'token',
        'tanggal_dibuat'
    ];
}
