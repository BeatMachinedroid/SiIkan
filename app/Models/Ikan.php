<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    use HasFactory;

    protected $table = 'ikans';

    protected $fillable = [
        'id_cate',
        'nama',
        'deskripsi',
        'stock',
        'min_pembelian',
        'harga',
        'gambar',
    ];


    public function carts()
    {
        return $this->hasMany(Cart::class, 'product_id', 'id');
    }

    public function pembelians()
    {
        return $this->hasMany(Pembelian::class, 'ikan_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'id_cate');
    }
}
