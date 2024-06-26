<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_nasabah',
        'kode_transaksi',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'id_nasabah' => 'integer',
    ];

    public function Nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah');
    }
}
