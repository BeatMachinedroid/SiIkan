<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    use HasFactory;

    protected  $fillable = [
        'nama_toko',
            'alamat_toko',
            'latitude',
            'longitude',
            'no_telp_toko',
            'email_toko' ,
            'gambar',
            'deskripsi'
    ];
}
