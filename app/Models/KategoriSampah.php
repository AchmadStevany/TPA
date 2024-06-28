<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriSampah extends Model
{
    use HasFactory;

    public $table = 'kategori_sampah';
    protected $fillable = [
        'nama_kategori_sampah',
    ];
}
