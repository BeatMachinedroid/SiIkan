<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'gambar'
    ];

    public function ikan()
    {
        return $this->hasMany(Ikan::class, 'id_cate', 'id');
    }
}
