<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_kategori_sampah',
        'sampah',
        'satuan',
        'harga_satuan',
    ];

    protected $casts = [
        'id_kategori_sampah' => 'integer',
        'harga_satuan' => 'integer',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriSampah::class, 'id_kategori_sampah');
    }
}
