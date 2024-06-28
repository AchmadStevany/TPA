<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSaldoNasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_nasabah',
        'id_transaksi',
        'id_penarikan_nasabah',
        'type_trans',
        'nominal',
    ];

    protected $casts = [
        'id_nasabah' => 'integer',
        'id_transaksi' => 'integer',
        'nominal' => 'integer',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
