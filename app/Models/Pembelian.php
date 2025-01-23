<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelians';

    protected $fillable = [
        'id_user',
        'id_ikan',
        'kode_order',
        'jumlah',
        'total_harga',
        'alamat',
        'no_telpon',
        'metode_pembayaran',
        'ongkir',
        'batas_pembayaran',
        'status_order',
        'status_pembayaran',
    ];

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class, 'id_pembelian', 'id');
    }

    public function ikan()
    {
        return $this->belongsTo(Ikan::class, 'id_ikan', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

}
