<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanNasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_nasabah',
        'nominal',
        'tanggal_penarikan',
        'status_penarikan',
    ];

    protected $casts = [
        'id_nasabah' => 'integer',
        'nominal' => 'integer',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah');
    }
}
