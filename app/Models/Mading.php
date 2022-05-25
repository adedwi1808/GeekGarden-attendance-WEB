<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    protected $table = 'mading';
    use HasFactory;

    public $timestamps = false;


    protected $fillable = [
        'judul_mading',
        'body_mading',
        'foto_mading',
        'created_at'
    ];

    protected $hidden = [
    ];

    protected $dateFormat ='U';

}
