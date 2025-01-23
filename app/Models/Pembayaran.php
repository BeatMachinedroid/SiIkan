<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';


    protected $fillable = [
        'kode_order',
        'bukti_pembayaran',
        'tanggal_pembayaran',
        'tanggal_order',
        'status',
    ];
}
