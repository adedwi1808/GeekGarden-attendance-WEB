<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mading extends Model
{
    protected $table = 'mading';
    use HasFactory;
    protected $primaryKey = "id_mading";
    public $timestamps = false;


    protected $fillable = [
        'id_admin',
        'judul',
        'informasi',
        'foto',
        'created_at'
    ];

    public function admin()
    {
        return $this->belongsTo(Admin::class,'id_admin','id_admin');
    }

    protected $hidden = [
    ];

    protected $dateFormat ='U';

}
