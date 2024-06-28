<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sampah extends Model
{
    use HasFactory;

    public $table = "sampah";

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
