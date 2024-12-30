<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    use HasFactory;

    protected $table = 'ikans';
    protected $fillable = ['nama_ikan', 'jenis_ikan', 'gambar','berat_ikan','harga'];

}
