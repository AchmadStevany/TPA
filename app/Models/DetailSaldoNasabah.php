<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSaldoNasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_saldo_nasabah',
        'id_transaksi',
        'id_penarikan_nasabah',
        'type_trans',
        'nominal',
    ];

    protected $casts = [
        'id_saldo_nasabah' => 'integer',
        'id_transaksi' => 'integer',
        'id_penarikan_nasabah' => 'integer',
        'nominal' => 'integer',
    ];

    public function saldo_nasabah()
    {
        return $this->belongsTo(SaldoNasabah::class, 'id_saldo_nasabah');
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }

    public function penarikan_nasabah()
    {
        return $this->belongsTo(PenarikanNasabah::class, 'id_penarikan_nasabah');
    }
}
