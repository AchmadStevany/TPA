<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_transaksi',
        'id_sampah',
        'quantity',
    ];

    protected $casts = [
        'id_transaksi' => 'integer',
        'id_sampah' => 'integer',
        'quantity' => 'integer',
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class, 'id_sampah');
    }
}
