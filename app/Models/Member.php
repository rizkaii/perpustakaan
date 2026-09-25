<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
        'nama',
        'no_anggota',
        'email',
        'no_telp',
        'alamat',
        'foto',
    ];
}
