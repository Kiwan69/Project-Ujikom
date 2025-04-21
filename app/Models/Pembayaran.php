<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pemesanan',
        'metode_pembayaran',
        'status_pembayaran',
        'tanggal_pembayaran',
        'jumlah_bayar',
    ];
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'id_pemesanan');
    }

}
