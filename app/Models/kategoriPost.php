<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kategoriPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'slug',
        'index_menu',
        'beranda',
        'type_halaman',
        'deskripsi'
    ];

    public function post()
    {
        return $this->hasMany(Post::class, 'kategori','id');
    }
}
