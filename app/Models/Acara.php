<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acara extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pertandingan',
        'tanggal',
        'waktu_mulai',
        'waktu_selesai',
        'id_stadion',
        'image',
    ];
    public function stadion()
    {
        return $this->belongsTo(Stadion::class, 'id_stadion');
    }

    public function tiket()
    {
        return $this->hasMany(Tiket::class, 'id_acara');
    }

}
