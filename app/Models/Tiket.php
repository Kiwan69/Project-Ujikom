<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $fillable = [
        'stok',
        'harga',
        'kategori',
        'status',
        'id_acara',
    ];
    public function acara()
    {
        return $this->belongsTo(Acara::class, 'id_acara');
    }

}
