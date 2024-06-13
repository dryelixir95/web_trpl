<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Akreditasi extends Model
{
    use HasFactory;

    protected $primaryKey = 'akreditasi_id';

    protected $fillable = [
        'judul',
        'file_akreditasi',
        'tgl_akreditasi',
    ];
}