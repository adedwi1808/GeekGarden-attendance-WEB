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
        'judul',
        'informasi',
        'foto',
        'created_at'
    ];

    protected $hidden = [
    ];

    protected $dateFormat ='U';

}
