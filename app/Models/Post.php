<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'tanggal',
        'kategori',
        'deskripsi',
        'tag',
        'komen',
    ];

    public function kategoriPost()
    {
        return $this->belongsTo(kategoriPost::class, 'kategori','id');
    }
}
