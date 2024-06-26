<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nokk',
        'nik',
        'alamat',
        'handphone',
        'email',
        'password',
        'role',
    ];
}
