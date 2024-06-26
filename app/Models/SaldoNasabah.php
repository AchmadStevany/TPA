<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaldoNasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_nasabah',
    ];

    protected $casts = [
        'id_nasabah' => 'integer',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'id_nasabah');
    }
}
